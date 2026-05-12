<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $today = Carbon::today()->toDateString();
        
        $appointments = Appointment::where('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();
            
        $pastAppointments = Appointment::where('date', '<', $today)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'asc')
            ->get();

        $quotes = Quote::orderBy('created_at', 'desc')->get();
        $users = User::orderBy('created_at', 'asc')->get();

        // KPI Calculations
        $totalRevenuePending = Quote::whereNotNull('price_quote')->sum('price_quote');
        
        $totalQuotes = Quote::count();
        $totalAppointments = Appointment::count();
        $conversionRate = $totalQuotes > 0 ? round(($totalAppointments / $totalQuotes) * 100, 1) : 0;

        $mostRequestedService = Quote::select('service_type', \DB::raw('count(*) as total'))
            ->groupBy('service_type')
            ->orderBy('total', 'desc')
            ->first();

        // New Metrics for Business Overview Overhaul
        $thisWeekStart = now()->startOfWeek();
        $lastWeekStart = now()->subWeek()->startOfWeek();
        $lastWeekEnd = now()->subWeek()->endOfWeek();

        // Revenue
        $thisWeekRevenue = Quote::where('created_at', '>=', $thisWeekStart)
            ->whereNotNull('price_quote')
            ->sum('price_quote');
        $lastWeekRevenue = Quote::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->whereNotNull('price_quote')
            ->sum('price_quote');
        $revenueGrowthWeek = $lastWeekRevenue > 0 ? round((($thisWeekRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100, 1) : 100;

        // Quotes
        $thisWeekQuotes = Quote::where('created_at', '>=', $thisWeekStart)->count();
        $lastWeekQuotes = Quote::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count();
        $quotesGrowthWeek = $lastWeekQuotes > 0 ? round((($thisWeekQuotes - $lastWeekQuotes) / $lastWeekQuotes) * 100, 1) : 100;

        // Appointments
        $thisWeekApps = Appointment::where('created_at', '>=', $thisWeekStart)->count();
        $lastWeekApps = Appointment::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count();
        $appsGrowthWeek = $lastWeekApps > 0 ? round((($thisWeekApps - $lastWeekApps) / $lastWeekApps) * 100, 1) : 100;

        // Conversion Rate Comparison
        $thisWeekConv = $thisWeekQuotes > 0 ? ($thisWeekApps / $thisWeekQuotes) * 100 : 0;
        $lastWeekConv = $lastWeekQuotes > 0 ? ($lastWeekApps / $lastWeekQuotes) * 100 : 0;
        $convGrowthWeek = $lastWeekConv > 0 ? round($thisWeekConv - $lastWeekConv, 1) : $thisWeekConv;

        // Service Distribution (Ranked)
        $serviceDistribution = Quote::select('service_type', \DB::raw('count(*) as total'))
            ->groupBy('service_type')
            ->orderBy('total', 'desc')
            ->get();

        // Sparkline data (Last 7 days daily counts)
        $sparklineData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $sparklineData[] = Quote::whereDate('created_at', $date)->count();
        }

        // Appointment Status Breakdown
        $statusBreakdown = Appointment::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Recent Activity Feed
        $recentActivities = Quote::latest()->take(5)->get()->map(function($item) {
                $item->activity_type = 'Quote';
                return $item;
            })->concat(
                Appointment::latest()->take(5)->get()->map(function($item) {
                    $item->activity_type = 'Appointment';
                    return $item;
                })
            )->sortByDesc('created_at')->take(5);

        // Traffic Data (Last 7 days)
        $trafficData = Quote::select(\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date')->toArray();

        return view('admin.dashboard', compact(
            'appointments', 
            'pastAppointments',
            'quotes', 
            'users', 
            'totalRevenuePending', 
            'conversionRate', 
            'mostRequestedService',
            'trafficData',
            'revenueGrowthWeek',
            'quotesGrowthWeek',
            'appsGrowthWeek',
            'convGrowthWeek',
            'serviceDistribution',
            'sparklineData',
            'statusBreakdown',
            'recentActivities'
        ));
    }

    /**
     * Handle appointment actions (confirm, reschedule, cancel, delete).
     */
    public function appointmentAction(Request $request)
    {
        $id = $request->id;
        $action = $request->appointment_action;
        $appointment = Appointment::findOrFail($id);

        if ($action === 'confirm') {
            $appointment->update(['status' => 'Confirmed']);
            
            $data = [
                'title' => 'Appointment Confirmed',
                'name' => $appointment->name,
                'intro' => 'Your appointment has been <strong>successfully confirmed</strong>. We look forward to seeing you.',
                'details' => [
                    'Schedule' => Carbon::parse($appointment->date)->format('F d') . ' | ' . Carbon::parse($appointment->time)->format('g:i A'),
                    'Status' => 'Confirmed'
                ],
                'outro' => 'If you need to make any changes, please contact us at least 24 hours in advance.'
            ];
            
            $this->sendEmail($appointment->email, "Appointment Confirmed - Russ Cuevas", $data);

            return response()->json(['message' => "Appointment confirmed and email sent.", 'status' => 'Confirmed']);
        } 
        
        if ($action === 'reschedule') {
            $new_date = $request->new_date;
            $new_time = $request->new_time;
            $appointment->update([
                'date' => $new_date,
                'time' => $new_time,
                'status' => 'Rescheduled'
            ]);

            $data = [
                'title' => 'Appointment Rescheduled',
                'name' => $appointment->name,
                'intro' => 'Your appointment has been <strong>rescheduled</strong> to a new time slot.',
                'details' => [
                    'New Schedule' => Carbon::parse($new_date)->format('F d') . ' | ' . Carbon::parse($new_time)->format('g:i A'),
                    'Status' => 'Rescheduled'
                ],
                'outro' => 'We have updated our calendar. See you soon!'
            ];
            
            $this->sendEmail($appointment->email, "Appointment Rescheduled - Russ Cuevas", $data);

            return response()->json(['message' => "Appointment rescheduled and email sent.", 'status' => 'Rescheduled']);
        }

        if ($action === 'cancel') {
            $appointment->update(['status' => 'Cancelled']);

            $data = [
                'title' => 'Appointment Cancelled',
                'name' => $appointment->name,
                'intro' => 'Your appointment on ' . $appointment->date . ' has been <strong>cancelled</strong>.',
                'details' => [
                    'Date' => Carbon::parse($appointment->date)->format('F d') . ' | ' . Carbon::parse($appointment->time)->format('g:i A'),
                    'Status' => 'Cancelled'
                ],
                'outro' => 'If this was a mistake, you can always book a new appointment on our website.'
            ];
            
            $this->sendEmail($appointment->email, "Appointment Cancelled - Russ Cuevas", $data);

            return response()->json(['message' => "Appointment cancelled and email sent.", 'status' => 'Cancelled']);
        }

        if ($action === 'delete') {
            $appointment->delete();
            return response()->json(['message' => "Appointment deleted.", 'status' => 'Deleted']);
        }

        return response()->json(['message' => 'Action not found.'], 400);
    }

    /**
     * Handle quote actions (send_quote, delete).
     */
    public function quoteAction(Request $request)
    {
        $id = $request->id;
        $action = $request->quote_action;
        $quote = Quote::findOrFail($id);

        if ($action === 'send_quote') {
            $price = $request->price_quote;
            $messageToClient = $request->message_to_client;
            $quote->update(['price_quote' => $price]);

            $data = [
                'title' => 'Your Price Quotation',
                'name' => $quote->name,
                'intro' => 'We have carefully reviewed your inspiration and details for your <strong>' . $quote->service_type . '</strong>. ' . ($messageToClient ? '<br><br><i>"' . e($messageToClient) . '"</i>' : ''),
                'details' => [
                    'Project' => $quote->service_type,
                    'Sizing' => $quote->size === 'custom' ? 'Bespoke Measurements' : 'Standard ' . strtoupper($quote->size),
                    'Quotation' => '₱ ' . number_format($price, 2),
                    'Validity' => 'Valid for 30 Days'
                ],
                'outro' => 'If you are ready to proceed with this design, you can schedule your first fitting or initial consultation through our website.'
            ];

            $this->sendEmail($quote->email, "Quotation for your " . $quote->service_type . " - Russ Cuevas Atelier", $data);


            return response()->json(['message' => 'Professional quotation sent to client.']);
        }

        if ($action === 'delete') {
            $quote->delete();
            return response()->json(['message' => 'Quote request deleted.']);
        }

        return response()->json(['message' => 'Action not found.'], 400);
    }

    /**
     * Handle user actions (delete).
     */
    public function userAction(Request $request)
    {
        $id = $request->user_id;
        $action = $request->user_action;
        $user = User::findOrFail($id);

        if ($action === 'delete') {
            $user->delete();
            return response()->json(['message' => 'User account deleted.']);
        }

        return response()->json(['message' => 'Action not found.'], 400);
    }

    /**
     * Filter appointments by date.
     */
    public function filterAppointments(Request $request)
    {
        $start_date = $request->filter_start_date;
        $end_date = $request->filter_end_date;

        $appointments = Appointment::whereBetween('date', [$start_date, $end_date])
            ->orderBy('date', 'asc')
            ->get();

        // Render rows for AJAX
        $html = "";
        foreach ($appointments as $row) {
            $html .= "<tr id='appointment-row-{$row->id}'>
                <td><strong>" . e($row->name) . "</strong></td>
                <td>" . e($row->email) . "</td>
                <td>
                    <div>" . e($row->date) . "</div>
                    <div style='color: var(--grey-text); font-size: 0.8rem;'>" . e($row->time) . "</div>
                </td>
                <td>" . e(\Str::limit($row->notes, 30)) . "</td>
                <td>
                    <span class='status-pill status-" . e($row->status) . "'>" . e($row->status) . "</span>
                </td>
                <td>
                    <div style='margin-bottom: 6px;'>
                        <input type='date' id='date-{$row->id}'>
                        <input type='time' id='time-{$row->id}'>
                    </div>
                    <div class='table-actions'>
                        <button class='btn btn-warning' onclick='reschedule({$row->id})'>Reschedule</button>
                        <button class='btn btn-success' onclick='confirmAppointment({$row->id})'>Confirm</button>
                        <button class='btn btn-secondary' onclick='cancelAppointment({$row->id})'>Cancel</button>
                        <button class='btn btn-danger' onclick='deleteAppointment({$row->id})'>Delete</button>
                    </div>
                </td>
            </tr>";
        }

        return response($html);
    }

    /**
     * Private helper to send email using the custom Blade template.
     */
    private function sendEmail($to, $subject, $data)
    {
        Mail::send('emails.notification', $data, function ($message) use ($to, $subject) {
            $message->to($to)
                    ->subject($subject);
        });
    }
}
