<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('appointments');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'nullable|string',
        ]);

        Appointment::create($validated);

        return redirect()->route('quote.index')->with('appointment_success', 'Your appointment has been booked successfully! Please fill out the order form.');
    }
    public function confirmReschedule($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        if ($appointment->status !== 'Rescheduled') {
            return view('emails.response_success', [
                'title' => 'Link Invalid',
                'message' => 'This link is no longer valid or the appointment has already been processed.'
            ]);
        }

        $newDateObj = \Carbon\Carbon::parse($appointment->date);
        $validityHours = 24;
        if ($newDateObj->isToday()) {
            $validityHours = 2;
        } elseif ($newDateObj->isTomorrow()) {
            $validityHours = 12;
        }

        // Check if the validity window has passed since the reschedule was sent (updated_at)
        if (now()->diffInHours($appointment->updated_at) >= $validityHours) {
            $appointment->update(['status' => 'Cancelled']);
            return view('emails.response_success', [
                'title' => 'Link Expired',
                'message' => 'The ' . $validityHours . '-hour window to confirm this rescheduled appointment has expired. The appointment has been automatically cancelled to free up the slot.'
            ]);
        }

        $appointment->update(['status' => 'Confirmed']);

        // Notify Admin
        $adminEmail = 'admin@russcuevas.com';
        $data = [
            'title' => 'Schedule Confirmed by Client',
            'name' => 'Administrator',
            'intro' => "Client <strong>{$appointment->name}</strong> has confirmed the rescheduled appointment.",
            'details' => [
                'Client' => $appointment->name,
                'Email' => $appointment->email,
                'Date' => \Carbon\Carbon::parse($appointment->date)->format('F d, Y'),
                'Time' => \Carbon\Carbon::parse($appointment->time)->format('g:i A'),
                'Status' => 'CONFIRMED'
            ],
            'outro' => 'The appointment has been moved back to the confirmed schedule.'
        ];
        
        $this->sendEmail($adminEmail, "Client Confirmed Reschedule - {$appointment->name}", $data);

        return view('emails.response_success', [
            'title' => 'Appointment Confirmed',
            'message' => 'Thank you for confirming your new schedule. We look forward to seeing you!'
        ]);
    }

    public function cancelReschedule($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        if ($appointment->status !== 'Rescheduled') {
            return view('emails.response_success', [
                'title' => 'Link Invalid',
                'message' => 'This link is no longer valid or the appointment has already been processed.'
            ]);
        }

        $newDateObj = \Carbon\Carbon::parse($appointment->date);
        $validityHours = 24;
        if ($newDateObj->isToday()) {
            $validityHours = 2;
        } elseif ($newDateObj->isTomorrow()) {
            $validityHours = 12;
        }

        // Check if the validity window has passed since the reschedule was sent (updated_at)
        if (now()->diffInHours($appointment->updated_at) >= $validityHours) {
            $appointment->update(['status' => 'Cancelled']);
            return view('emails.response_success', [
                'title' => 'Link Expired',
                'message' => 'The ' . $validityHours . '-hour window to respond to this rescheduled appointment has expired. The appointment has been automatically cancelled.'
            ]);
        }

        $appointment->update(['status' => 'Cancelled']);

        // Notify Admin
        $adminEmail = 'admin@russcuevas.com';
        $data = [
            'title' => 'Reschedule Declined by Client',
            'name' => 'Administrator',
            'intro' => "Client <strong>{$appointment->name}</strong> has declined the rescheduling offer and cancelled their appointment.",
            'details' => [
                'Client' => $appointment->name,
                'Email' => $appointment->email,
                'Date' => \Carbon\Carbon::parse($appointment->date)->format('F d, Y'),
                'Time' => \Carbon\Carbon::parse($appointment->time)->format('g:i A'),
                'Status' => 'CANCELLED'
            ],
            'outro' => 'Please review your records. The slot is now available.'
        ];
        
        $this->sendEmail($adminEmail, "Client Declined Reschedule - {$appointment->name}", $data);

        return view('emails.response_success', [
            'title' => 'Appointment Cancelled',
            'message' => 'Your appointment has been cancelled as requested. If you change your mind, feel free to book a new session.'
        ]);
    }

    /**
     * Private helper to send email using the custom Blade template.
     */
    private function sendEmail($to, $subject, $data)
    {
        \Illuminate\Support\Facades\Mail::send('emails.notification', $data, function ($message) use ($to, $subject) {
            $message->to($to)
                    ->subject($subject);
        });
    }
}