<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Quote;

class ClientPortalController extends Controller
{
    public function appointments()
    {
        $user = Auth::user();
        $appointments = Appointment::where('email', $user->email)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();
            
        return view('portal.appointments', compact('appointments'));
    }

    public function quotes()
    {
        $user = Auth::user();
        $quotes = Quote::where('email', $user->email)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('portal.quotes', compact('quotes'));
    }

    public function receipts()
    {
        $user = Auth::user();
        
        // Fetch confirmed appointments to act as receipts
        $appointmentReceipts = Appointment::where('email', $user->email)
            ->where('status', 'Confirmed')
            ->get()
            ->map(function ($app) {
                return (object)[
                    'id' => $app->id,
                    'type' => 'appointment',
                    'reference' => 'RC-APP-' . str_pad($app->id, 5, '0', STR_PAD_LEFT),
                    'service' => 'Fitting / Consultation',
                    'date_issued' => $app->created_at,
                    'amount' => null // Appointments might be free
                ];
            });

        // Fetch paid quotes to act as receipts
        $quoteReceipts = Quote::where('email', $user->email)
            ->whereIn('status', ['Paid', 'Partially Paid', 'Accepted'])
            ->get()
            ->map(function ($quote) {
                $paymentTypeLabel = $quote->payment_type === 'deposit' ? ' (Deposit)' : ' (Full Payment)';
                return (object)[
                    'id' => $quote->id,
                    'type' => 'quote',
                    'reference' => 'RC-QTE-' . str_pad($quote->id, 5, '0', STR_PAD_LEFT),
                    'service' => 'Bespoke: ' . $quote->service_type . $paymentTypeLabel,
                    'date_issued' => $quote->paid_at ?? $quote->updated_at,
                    'amount' => $quote->amount_paid ?? $quote->price_quote
                ];
            });

        // Merge and sort by date desc
        $receipts = $appointmentReceipts->concat($quoteReceipts)->sortByDesc('date_issued');

        return view('portal.receipts', compact('receipts'));
    }

    public function showPaymentForm($id)
    {
        $user = Auth::user();
        $quote = Quote::where('email', $user->email)->findOrFail($id);

        if ($quote->status !== 'Quoted') {
            return redirect()->route('portal.quotes')->with('error', 'This quote is not available for payment.');
        }

        return view('portal.payment', compact('quote'));
    }

    public function processPayment(Request $request, $id)
    {
        $user = Auth::user();
        $quote = Quote::where('email', $user->email)->findOrFail($id);

        if ($quote->status !== 'Quoted') {
            return redirect()->route('portal.quotes')->with('error', 'This quote cannot be paid.');
        }

        // Simulate payment success
        $quote->update(['status' => 'Accepted']);

        return redirect()->route('portal.receipts')->with('success', 'Payment successful! Your receipt is now available.');
    }

    public function settings()
    {
        $user = Auth::user();
        return view('portal.settings', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:1000'
        ]);

        $user->update([
            'name' => $request->name,
            'contact' => $request->contact,
            'address' => $request->address
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'The provided current password does not match our records.');
        }

        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        return back()->with('success', 'Password changed successfully.');
    }
}
