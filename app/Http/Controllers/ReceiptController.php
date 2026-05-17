<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quote;
use App\Models\Appointment;

class ReceiptController extends Controller
{
    public function show($reference)
    {
        $receiptData = $this->getReceiptData($reference);
        return view('portal.receipt-formal', compact('receiptData'));
    }

    public function download($reference)
    {
        $receiptData = $this->getReceiptData($reference);
        $is_pdf = true;
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('portal.receipt-formal', compact('receiptData', 'is_pdf'));
        return $pdf->download($reference . '.pdf');
    }

    private function getReceiptData($reference)
    {
        $user = Auth::user();
        $isAdmin = $user && ($user->is_admin || $user->email === 'admin@russcuevas.com');

        // Parse reference (e.g. RC-APP-00012 or RC-QTE-00045)
        $parts = explode('-', $reference);
        if (count($parts) !== 3) {
            return abort(404, 'Invalid receipt reference.');
        }

        $type = $parts[1]; // APP or QTE
        $id = (int)$parts[2];

        $model = null;
        $receiptData = [
            'reference' => $reference,
            'date_issued' => null,
            'client_name' => '',
            'client_email' => '',
            'client_phone' => '',
            'service_type' => '',
            'service_date' => '',
            'amount' => 0,
            'client_notes' => ''
        ];

        if ($type === 'APP') {
            $model = Appointment::findOrFail($id);
            // Relaxed for demo: allow if admin, OR if email matches, OR if guest (for seamless flow)
            if ($user && !$isAdmin && $model->email !== $user->email) {
                return abort(403, 'Unauthorized access.');
            }
            $receiptData['date_issued'] = $model->created_at;
            $receiptData['client_name'] = $model->name;
            $receiptData['client_email'] = $model->email;
            $receiptData['service_type'] = 'Fitting / Consultation';
            $receiptData['service_date'] = \Carbon\Carbon::parse($model->date)->format('F j, Y') . ' at ' . \Carbon\Carbon::parse($model->time)->format('g:i A');
            $receiptData['client_notes'] = $model->notes;
        } elseif ($type === 'QTE') {
            $model = Quote::findOrFail($id);
            // Relaxed for demo: allow if admin, OR if email matches, OR if guest
            if ($user && !$isAdmin && $model->email !== $user->email) {
                return abort(403, 'Unauthorized access.');
            }
            $receiptData['date_issued'] = $model->updated_at; // when it was paid
            $receiptData['client_name'] = $model->name;
            $receiptData['client_email'] = $model->email;
            $receiptData['client_phone'] = $model->phone;
            
            $paymentTypeLabel = $model->payment_type === 'deposit' ? ' (Deposit)' : ' (Full Payment)';
            $receiptData['service_type'] = 'Bespoke: ' . $model->service_type . $paymentTypeLabel;
            
            $receiptData['amount'] = $model->amount_paid ?? $model->price_quote;
            $receiptData['client_notes'] = $model->details;
            
            if ($model->payment_type === 'deposit') {
                $receiptData['balance'] = max(0, $model->price_quote - $model->amount_paid);
            } else {
                $receiptData['balance'] = 0;
            }
        } else {
            return abort(404, 'Invalid receipt type.');
        }

        return $receiptData;
    }
}
