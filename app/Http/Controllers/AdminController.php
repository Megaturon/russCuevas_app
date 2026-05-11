<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $appointments = Appointment::orderBy('date', 'asc')->orderBy('time', 'asc')->get();
        $quotes = Quote::orderBy('created_at', 'desc')->get();
        $users = User::orderBy('created_at', 'asc')->get();

        return view('admin.dashboard', compact('appointments', 'quotes', 'users'));
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
            
            $subject = "Appointment Confirmed";
            $body = "Hi {$appointment->name},<br><br>Your appointment on <b>{$appointment->date}</b> at <b>{$appointment->time}</b> has been <strong>confirmed</strong>.<br><br>Thank you!";
            
            $this->sendEmail($appointment->email, $subject, $body);

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

            $subject = "Appointment Rescheduled";
            $body = "Hi {$appointment->name},<br><br>Your appointment has been <strong>rescheduled</strong> to <b>$new_date</b> at <b>$new_time</b>.<br><br>Thank you!";
            
            $this->sendEmail($appointment->email, $subject, $body);

            return response()->json(['message' => "Appointment rescheduled and email sent.", 'status' => 'Rescheduled']);
        }

        if ($action === 'cancel') {
            $appointment->update(['status' => 'Cancelled']);

            $subject = "Appointment Cancelled";
            $body = "Hi {$appointment->name},<br><br>Your appointment on <b>{$appointment->date}</b> at <b>{$appointment->time}</b> has been <strong>cancelled</strong>.<br><br>If this is a mistake, feel free to rebook.";
            
            $this->sendEmail($appointment->email, $subject, $body);

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

<<<<<<< Updated upstream
            $subject = "Your Price Quote from Russ Cuevas Couture";
            $body = "
                Hi {$quote->name},<br><br>
                Thank you for your quote request.<br>
                We are pleased to provide you with a price quote of: <strong>₱ " . number_format($price, 2) . "</strong>.<br><br>
                Please reply if you have any questions or would like to proceed.<br><br>
                Best regards,<br>
                Russ Cuevas Couture
            ";

            $this->sendEmail($quote->email, $subject, $body);
=======
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
>>>>>>> Stashed changes

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
            $status_class = 'row-status-' . $row->status;
            $html .= "<tr id='appointment-row-{$row->id}' class='{$status_class}'>
                <td>" . e($row->name) . "</td>
                <td>" . e($row->email) . "</td>
                <td>" . e($row->date) . "</td>
                <td>" . e($row->time) . "</td>
                <td>" . e($row->notes) . "</td>
                <td>" . e($row->status) . "</td>
                <td>
                    <input type='date' id='date-{$row->id}'>
                    <input type='time' id='time-{$row->id}'>
                    <button class='btn btn-reschedule' onclick='reschedule({$row->id})'>Reschedule</button>
                    <button class='btn btn-confirm' onclick='confirmAppointment({$row->id})'>Confirm</button>
                    <button class='btn btn-cancel' onclick='cancelAppointment({$row->id})'>Cancel</button>
                    <button class='btn btn-delete' onclick='deleteAppointment({$row->id})'>Delete</button>
                </td>
            </tr>";
        }

        return response($html);
    }

    /**
     * Private helper to send email using Laravel Mail.
     */
    private function sendEmail($to, $subject, $body)
    {
        Mail::html($body, function ($message) use ($to, $subject) {
            $message->to($to)
                    ->subject($subject);
        });
    }
}
