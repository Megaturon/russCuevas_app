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
        $now = Carbon::now();
        $today = $now->toDateString();
        $currentTime = $now->toTimeString();
        
        $appointments = Appointment::where(function($query) use ($today, $currentTime) {
                $query->where('date', '>', $today)
                      ->orWhere(function($q) use ($today, $currentTime) {
                          $q->where('date', $today)
                            ->where('time', '>=', $currentTime);
                      });
            })
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();
            
        $pastAppointments = Appointment::where(function($query) use ($today, $currentTime) {
                $query->where('date', '<', $today)
                      ->orWhere(function($q) use ($today, $currentTime) {
                          $q->where('date', $today)
                            ->where('time', '<', $currentTime);
                      });
            })
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        $quotes = Quote::orderBy('created_at', 'desc')->get();
        $users = User::orderBy('created_at', 'asc')->get();

        // KPI Calculations
        $totalRevenuePending = Quote::where('status', 'Quoted')
                                     ->orWhereNull('status')
                                     ->whereNotNull('price_quote')
                                     ->whereNull('paid_at')
                                     ->sum('price_quote');
        
        $totalQuotes = Quote::count();
        $totalAppointments = Appointment::count();
        $conversionRate = $totalQuotes > 0 ? round(($totalAppointments / $totalQuotes) * 100, 1) : 0;

        $mostRequestedService = Quote::select('service_type', \DB::raw('count(*) as total'))
            ->groupBy('service_type')
            ->orderBy('total', 'desc')
            ->first();

        // 7-Day Rolling Windows for accurately comparing "vs last week"
        $now = now();
        $last7DaysStart = $now->copy()->subDays(7);
        $previous7DaysStart = $now->copy()->subDays(14);

        // Revenue Growth
        $thisWeekRevenue = Quote::where('created_at', '>=', $last7DaysStart)
            ->whereNotNull('price_quote')
            ->sum('price_quote');
        $lastWeekRevenue = Quote::whereBetween('created_at', [$previous7DaysStart, $last7DaysStart])
            ->whereNotNull('price_quote')
            ->sum('price_quote');
        $revenueGrowthWeek = $lastWeekRevenue > 0 ? round((($thisWeekRevenue - $lastWeekRevenue) / $lastWeekRevenue) * 100, 1) : ($thisWeekRevenue > 0 ? 100 : 0);

        // Quotes Growth
        $thisWeekQuotes = Quote::where('created_at', '>=', $last7DaysStart)->count();
        $lastWeekQuotes = Quote::whereBetween('created_at', [$previous7DaysStart, $last7DaysStart])->count();
        $quotesGrowthWeek = $lastWeekQuotes > 0 ? round((($thisWeekQuotes - $lastWeekQuotes) / $lastWeekQuotes) * 100, 1) : ($thisWeekQuotes > 0 ? 100 : 0);

        // Appointments Growth
        $thisWeekApps = Appointment::where('created_at', '>=', $last7DaysStart)->count();
        $lastWeekApps = Appointment::whereBetween('created_at', [$previous7DaysStart, $last7DaysStart])->count();
        $appsGrowthWeek = $lastWeekApps > 0 ? round((($thisWeekApps - $lastWeekApps) / $lastWeekApps) * 100, 1) : ($thisWeekApps > 0 ? 100 : 0);

        // Conversion Rate Growth (Absolute Difference)
        $thisWeekConv = $thisWeekQuotes > 0 ? ($thisWeekApps / $thisWeekQuotes) * 100 : 0;
        $lastWeekConv = $lastWeekQuotes > 0 ? ($lastWeekApps / $lastWeekQuotes) * 100 : 0;
        $convGrowthWeek = round($thisWeekConv - $lastWeekConv, 1);

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

        $allAppointments = Appointment::all();
        $tomorrow = Carbon::tomorrow()->toDateString();
        $today_date = Carbon::today()->toDateString();

        $tomorrowAppointments = Appointment::where('date', $tomorrow)
            ->where('status', 'Confirmed')
            ->orderBy('time', 'asc')
            ->get();

        $newTodayQuotes = Quote::whereDate('created_at', $today_date)->get();
        $newTodayAppointments = Appointment::whereDate('created_at', $today_date)->get();
        $pendingAppointments = Appointment::where('status', 'Pending')->orderBy('created_at', 'desc')->get();
        $pendingAppointmentsCount = $pendingAppointments->count();
        
        $payments = Quote::whereNotNull('price_quote')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.dashboard', compact(
            'appointments', 
            'pastAppointments',
            'allAppointments',
            'tomorrowAppointments',
            'newTodayQuotes',
            'newTodayAppointments',
            'pendingAppointments',
            'pendingAppointmentsCount',
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
            'recentActivities',
            'payments'
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
            $reason = $request->reschedule_reason;
            
            $appointment->update([
                'date' => $new_date,
                'time' => $new_time,
                'status' => 'Rescheduled'
            ]);

            $details = [
                'New Schedule' => Carbon::parse($new_date)->format('F d') . ' | ' . Carbon::parse($new_time)->format('g:i A'),
                'Status' => 'Rescheduled'
            ];
            
            if (!empty($reason)) {
                $details['Reason for Reschedule'] = $reason;
            }

            $newDateObj = Carbon::parse($new_date);
            $validityHours = 24;
            if ($newDateObj->isToday()) {
                $validityHours = 2;
            } elseif ($newDateObj->isTomorrow()) {
                $validityHours = 12;
            }

            $data = [
                'title' => 'Appointment Rescheduled',
                'name' => $appointment->name,
                'intro' => 'Your appointment has been <strong>rescheduled</strong> to a new time slot.',
                'details' => $details,
                'outro' => 'We have updated our calendar. Please let us know if this new schedule works for you by clicking one of the buttons below.<br><br><span style="color: #ef4444; font-size: 0.85em;"><strong>Note:</strong> This link is valid for ' . $validityHours . ' hours. If we do not receive a response, the appointment will be cancelled to accommodate other clients.</span>',
                'actions' => [
                    [
                        'label' => 'Confirm Schedule',
                        'url' => route('appointment.confirm_reschedule', $appointment->id),
                        'color' => '#000000'
                    ],
                    [
                        'label' => 'Decline & Cancel',
                        'url' => route('appointment.cancel_reschedule', $appointment->id),
                        'color' => '#666666'
                    ]
                ]
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
            
            // Generate token and expiration
            $token = \Illuminate\Support\Str::random(64);
            $expiresAt = now()->addDays(14);
            $quoteRef = 'QT-' . now()->format('Ymd') . '-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT);

            $quote->update([
                'price_quote' => $price,
                'status' => 'Quoted',
                'token' => $token,
                'token_expires_at' => $expiresAt
            ]);

            $data = [
                'title' => 'Your Price Quotation',
                'name' => $quote->name,
                'intro' => 'Hi ' . strtok($quote->name, ' ') . ', your quote is ready.<br><br>We have carefully reviewed your inspiration and details for your <strong>' . $quote->service_type . '</strong>.' . ($messageToClient ? '<br><br><i>"' . e($messageToClient) . '"</i>' : ''),
                'details' => [
                    'Project' => $quote->service_type,
                    'Estimated Timeline' => '4 - 6 Weeks',
                    'Total Amount' => '₱ ' . number_format($price, 2)
                ],
                'actions' => [
                    [
                        'label' => 'Secure Checkout (via PayMongo)',
                        'url' => url('/quotes/' . $token . '/paymongo'),
                        'color' => '#4F46E5'
                    ],
                    [
                        'label' => 'View & Pay',
                        'url' => url('/quotes/' . $token . '/pay'),
                        'color' => '#1a1a1a'
                    ]
                ],
                'outro' => '<span style="color: #8e9194; font-size: 11px;">This link expires on ' . $expiresAt->format('M d, Y') . '. Log in to your portal to access it anytime.</span>'
            ];

            $this->sendEmail($quote->email, "Your Quote from Russ Cuevas Atelier — Ref: " . $quoteRef, $data);

            return response()->json(['message' => 'Professional quotation sent to client.']);
        }

        if ($action === 'delete') {
            $quote->delete();
            return response()->json(['message' => 'Quote request deleted.']);
        }

        return response()->json(['message' => 'Action not found.'], 400);
    }

    /**
     * Handle payment updates (e.g., adding partial physical store payments).
     */
    public function paymentAction(Request $request)
    {
        $id = $request->id;
        $quote = Quote::findOrFail($id);
        
        $amountReceived = (float) $request->amount_received;
        
        if ($amountReceived <= 0) {
            return response()->json(['message' => 'Invalid amount.'], 400);
        }

        $newTotalPaid = ($quote->amount_paid ?? 0) + $amountReceived;
        
        // Determine if it's fully paid now
        if ($newTotalPaid >= $quote->price_quote) {
            $quote->update([
                'amount_paid' => $newTotalPaid,
                'in_person_amount' => ($quote->in_person_amount ?? 0) + $amountReceived,
                'status' => 'Paid',
                'paid_at' => now(),
            ]);
            $msg = 'Payment recorded successfully. Balance is fully paid.';
        } else {
            $quote->update([
                'amount_paid' => $newTotalPaid,
                'in_person_amount' => ($quote->in_person_amount ?? 0) + $amountReceived,
                'status' => 'Pending Balance'
            ]);
            $msg = 'Payment recorded successfully. Remaining balance updated.';
        }

        return response()->json(['message' => $msg]);
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
            $formattedDate = \Carbon\Carbon::parse($row->date)->format('F d');
            $formattedTime = \Carbon\Carbon::parse($row->time)->format('g:i A');
            $icon = 'fa-comment-alt';
            $note = strtolower($row->notes);
            if(str_contains($note, 'fitting')) $icon = 'fa-scissors';
            if(str_contains($note, 'consultation') || str_contains($note, 'meeting')) $icon = 'fa-handshake';
            if(str_contains($note, 'pickup') || str_contains($note, 'claim')) $icon = 'fa-shopping-bag';

            $html .= "<tr id='appointment-row-{$row->id}'>
                <td>
                    <strong>" . e($row->name) . "</strong><br>
                    <span style='color:var(--grey-text); font-size: 0.85rem;'>" . e($row->email) . "</span>
                </td>
                <td>
                    <div style='font-weight: 600; font-family: var(--font-playfair); font-size: 1rem;'>{$formattedDate}</div>
                    <div style='color: var(--grey-text); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;'>{$formattedTime}</div>
                </td>
                <td style='max-width: 250px;'>
                    <div class='customer-context'>
                        <i class='fas {$icon}' style='margin-right: 8px; color: var(--black); font-size: 0.8rem;'></i>
                        <span style='font-size: 0.9rem; font-style: italic; color: var(--black);'>\"" . e($row->notes) . "\"</span>
                    </div>
                </td>
                <td>
                    <span class='status-pill status-" . e($row->status) . "'>" . e($row->status) . "</span>
                </td>
                <td style='overflow: visible;'>
                    <div style='display: flex; gap: 8px; align-items: center;'>";
                    
            if ($row->status !== 'Confirmed') {
                $html .= "<button class='btn btn-success' onclick='confirmAppointment({$row->id})' style='padding: 6px 12px; font-size: 0.75rem;'>Confirm</button>";
            } else {
                $html .= "<button class='btn btn-warning' onclick=\"openRescheduleModal({$row->id}, '{$row->date}', '{$row->time}')\" style='padding: 6px 12px; font-size: 0.75rem;'>Reschedule</button>";
            }

            $html .= "<div class='action-dropdown'>
                            <button class='btn btn-secondary action-dropdown-btn' onclick='toggleDropdown(event, {$row->id})' style='padding: 6px 10px;'><i class='fas fa-ellipsis-h'></i></button>
                            <div class='action-dropdown-content' id='dropdown-{$row->id}'>";
                            
            if ($row->status !== 'Confirmed') {
                $html .= "<a href='#' onclick=\"event.preventDefault(); openRescheduleModal({$row->id}, '{$row->date}', '{$row->time}')\">Reschedule</a>";
            }
                                
            $html .= "          <a href='#' onclick=\"event.preventDefault(); cancelAppointment({$row->id})\">Cancel</a>
                                <a href='#' class='danger' onclick=\"event.preventDefault(); deleteAppointment({$row->id})\">Delete</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>";
        }

        return response($html);
    }

    /**
     * Get appointments created after a given timestamp (for real-time polling).
     */
    public function latestAppointments(Request $request)
    {
        $lastAppId = $request->input('last_app_id');
        $lastQuoteId = $request->input('last_quote_id');
        $lastUpdatedStr = $request->input('last_updated'); // e.g. "2026-05-17 15:00:00"

        $result = [];

        if ($lastAppId !== null) {
            $result['appointments'] = Appointment::where('id', '>', (int)$lastAppId)->get();
        }

        if ($lastQuoteId !== null) {
            $result['quotes'] = Quote::where('id', '>', (int)$lastQuoteId)->get();
        }

        if ($lastUpdatedStr) {
            // Find quotes that were updated after the last check, but only if they are not completely new
            // (to avoid sending the same quote twice if it's both new and updated)
            $query = Quote::where('updated_at', '>', $lastUpdatedStr);
            if ($lastQuoteId !== null) {
                $query->where('id', '<=', (int)$lastQuoteId); 
            }
            $result['updated_quotes'] = $query->get();
        }

        return response()->json($result);
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
