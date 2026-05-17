<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Appointment;

class CheckoutController extends Controller
{
    public function showPayment($token)
    {
        $quote = Quote::where('token', $token)->firstOrFail();

        // Check if token expired
        if ($quote->token_expires_at < now()) {
            return view('portal.payment-standalone', [
                'quote' => $quote,
                'token' => $token,
                'is_expired' => true
            ]);
        }

        // Check if already paid or partially paid
        if (in_array($quote->status, ['Paid', 'Partially Paid'])) {
            return view('portal.payment-standalone', [
                'quote' => $quote,
                'token' => $token,
                'already_paid' => true
            ]);
        }

        return view('portal.payment-standalone', compact('quote', 'token'));
    }

    public function paymongoRedirect(Request $request, $token)
    {
        $quote = Quote::where('token', $token)->firstOrFail();

        if ($quote->token_expires_at < now() || in_array($quote->status, ['Paid', 'Partially Paid'])) {
            return redirect('/quotes/' . $token . '/pay')->withErrors(['payment' => 'Invalid or expired payment link.']);
        }

        $paymentType = 'full'; // Demo defaults to full for the direct link
        $amountPaid = $quote->price_quote;
        $amountInCentavos = intval(round($amountPaid * 100));
        $lineItemName = 'Full Payment - ' . $quote->service_type;

        $secretKey = config('services.paymongo.secret_key');
        
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'authorization' => 'Basic ' . base64_encode($secretKey . ':')
        ])->post('https://api.paymongo.com/v1/checkout_sessions', [
            'data' => [
                'attributes' => [
                    'billing' => [
                        'name' => $quote->name,
                        'email' => $quote->email,
                        'phone' => $quote->phone ?? ''
                    ],
                    'send_email_receipt' => true,
                    'show_description' => true,
                    'show_line_items' => true,
                    'cancel_url' => url('/quotes/' . $token . '/pay'),
                    'success_url' => url('/quotes/' . $token . '/payment-success?session_id={CHECKOUT_SESSION_ID}&type=' . $paymentType),
                    'line_items' => [
                        [
                            'currency' => 'PHP',
                            'amount' => $amountInCentavos,
                            'name' => $lineItemName,
                            'quantity' => 1
                        ]
                    ],
                    'payment_method_types' => [
                        'card', 'gcash', 'paymaya', 'grab_pay'
                    ],
                    'reference_number' => 'QT-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT)
                ]
            ]
        ]);

        if ($response->successful()) {
            return redirect($response->json('data.attributes.checkout_url'));
        }

        return redirect('/quotes/' . $token . '/pay')->withErrors(['payment' => 'Failed to initialize PayMongo checkout.']);
    }

    public function processPayment(Request $request, $token)
    {
        $quote = Quote::where('token', $token)->firstOrFail();

        if ($quote->token_expires_at < now() || in_array($quote->status, ['Paid', 'Partially Paid'])) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired payment link.'], 403);
        }

        $paymentType = $request->input('payment_type', 'full'); // 'deposit' or 'full'
        $depositPct = $quote->deposit_percentage ?? 50.00;
        
        $amountPaid = $paymentType === 'deposit' 
            ? ($quote->price_quote * ($depositPct / 100)) 
            : $quote->price_quote;

        $newStatus = $paymentType === 'deposit' ? 'Partially Paid' : 'Paid';

        // Simulate successful payment processing
        $quote->update([
            'status' => $newStatus,
            'amount_paid' => $amountPaid,
            'payment_type' => $paymentType,
            'paid_at' => now(),
            // touch updated_at so silent polling catches it
            'updated_at' => now()
        ]);

        // Auto-create a confirmed appointment for the client
        $appointment = Appointment::create([
            'name' => $quote->name,
            'email' => $quote->email,
            'date' => now()->addDays(7)->format('Y-m-d'), // Placeholder
            'time' => '10:00:00', // Placeholder
            'notes' => 'Auto-generated from ' . ($paymentType === 'deposit' ? 'Deposit Paid' : 'Paid') . ' Quote: ' . $quote->service_type,
            'status' => 'Confirmed'
        ]);

        $reference = 'RC-QTE-' . str_pad($quote->id, 5, '0', STR_PAD_LEFT);
        
        $dateStr = now()->format('M d, Y h:i A');

        return response()->json([
            'success' => true,
            'message' => 'Payment processed successfully',
            'reference' => $reference,
            'amount_paid' => number_format($amountPaid, 2),
            'is_deposit' => $paymentType === 'deposit',
            'balance' => number_format($quote->price_quote - $amountPaid, 2),
            'method' => $request->input('payment_method', 'Credit Card'),
            'date_str' => $dateStr
        ]);
    }

    public function successCallback(Request $request, $token)
    {
        $quote = Quote::where('token', $token)->firstOrFail();
        
        // Prevent double processing
        if (in_array($quote->status, ['Paid', 'Partially Paid'])) {
            return view('portal.payment-success', compact('quote'));
        }

        $sessionId = $request->query('session_id');
        $paymentType = $request->query('type', 'full');

        if (!$sessionId) {
            abort(400, 'Missing session ID');
        }

        $secretKey = config('services.paymongo.secret_key');
        
        // Verify payment session
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'accept' => 'application/json',
            'authorization' => 'Basic ' . base64_encode($secretKey . ':')
        ])->get('https://api.paymongo.com/v1/checkout_sessions/' . $sessionId);

        if ($response->successful() && collect($response->json('data.attributes.payments'))->count() > 0) {
            
            $depositPct = $quote->deposit_percentage ?? 50.00;
            $amountPaid = $paymentType === 'deposit' 
                ? ($quote->price_quote * ($depositPct / 100)) 
                : $quote->price_quote;

            $newStatus = $paymentType === 'deposit' ? 'Partially Paid' : 'Paid';

            $quote->update([
                'status' => $newStatus,
                'amount_paid' => $amountPaid,
                'payment_type' => $paymentType,
                'paid_at' => now(),
                'updated_at' => now() // For polling
            ]);

            // Auto-create confirmed appointment
            Appointment::create([
                'name' => $quote->name,
                'email' => $quote->email,
                'date' => now()->addDays(7)->format('Y-m-d'),
                'time' => '10:00:00',
                'notes' => 'Auto-generated from ' . ($paymentType === 'deposit' ? 'Deposit Paid' : 'Paid') . ' Quote: ' . $quote->service_type,
                'status' => 'Confirmed'
            ]);

            return view('portal.payment-success', compact('quote'));
        }

        return redirect('/quotes/' . $token . '/pay')->withErrors(['payment' => 'Payment verification failed. Please contact support.']);
    }
}
