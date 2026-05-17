<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt {{ $receiptData['reference'] }} - Russ Cuevas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', sans-serif;
            color: #111827;
        }
        .receipt-container {
            max-width: 800px;
            margin: 40px auto;
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            padding: 60px;
        }
        .controls {
            max-width: 800px;
            margin: 20px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-control {
            background: #fff;
            border: 1px solid #d1d5db;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 0.85rem;
            color: #374151;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-control:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }
        .btn-primary {
            background: #111827;
            color: #fff;
            border-color: #111827;
        }
        .btn-primary:hover {
            background: #374151;
            border-color: #374151;
        }
        
        /* Receipt Internal Styles */
        .r-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
        }
        .r-logo {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: -1px;
        }
        .r-subtitle {
            font-size: 0.75rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .r-ref {
            text-align: right;
        }
        .r-ref h2 {
            font-size: 1.5rem;
            font-weight: 300;
            color: #374151;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .r-ref-number {
            font-family: monospace;
            font-size: 1.1rem;
            color: #111827;
            font-weight: 600;
        }
        .r-date {
            font-size: 0.85rem;
            color: #6b7280;
            margin-top: 4px;
        }
        
        .r-divider {
            border-top: 2px solid #111827;
            margin: 30px 0;
        }
        .r-divider-light {
            border-top: 1px solid #e5e7eb;
            margin: 30px 0;
        }
        
        .r-section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #9ca3af;
            margin-bottom: 12px;
        }
        
        .r-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        .r-info p {
            margin-bottom: 4px;
            font-size: 0.95rem;
        }
        .r-info .strong {
            font-weight: 600;
            color: #111827;
        }
        
        .r-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .r-table th {
            text-align: left;
            padding: 12px 0;
            border-bottom: 2px solid #e5e7eb;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #6b7280;
            letter-spacing: 1px;
        }
        .r-table td {
            padding: 16px 0;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.95rem;
        }
        .r-table .right {
            text-align: right;
        }
        
        .r-totals {
            width: 300px;
            margin-left: auto;
            margin-top: 20px;
        }
        .r-total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 0.9rem;
            color: #4b5563;
        }
        .r-total-final {
            display: flex;
            justify-content: space-between;
            padding: 16px 0;
            margin-top: 8px;
            border-top: 2px solid #111827;
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
        }
        
        .r-notes {
            margin-top: 40px;
            padding: 20px;
            background: #f9fafb;
            border-left: 4px solid #d1d5db;
        }
        
        .r-footer {
            margin-top: 60px;
            text-align: center;
            font-size: 0.8rem;
            color: #6b7280;
            line-height: 1.6;
        }
        
        @media print {
            body {
                background: #fff;
                margin: 0;
                padding: 0;
            }
            .controls {
                display: none;
            }
            .receipt-container {
                box-shadow: none;
                margin: 0;
                padding: 20px;
                max-width: 100%;
            }
            .r-notes {
                background: transparent;
                border: 1px solid #e5e7eb;
            }
        }
    </style>
</head>
<body>

@if(!isset($is_pdf))
<div class="controls">
    <a href="{{ route('portal.receipts') }}" class="btn-control"><i class="fas fa-arrow-left"></i> Back to My Receipts</a>
    <div>
        <button onclick="window.print()" class="btn-control"><i class="fas fa-print"></i> Print</button>
        <a href="{{ route('receipts.download', $receiptData['reference']) }}" class="btn-control btn-primary"><i class="fas fa-download"></i> Download PDF</a>
    </div>
</div>
@endif

<div class="receipt-container">
    
    <div class="r-header">
        <div>
            <div class="r-logo">R.C.</div>
            <div class="r-subtitle">Russ Cuevas Atelier</div>
        </div>
        <div class="r-ref">
            <h2>Receipt</h2>
            <div class="r-ref-number">{{ $receiptData['reference'] }}</div>
            <div class="r-date">Issued: {{ \Carbon\Carbon::parse($receiptData['date_issued'])->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="r-divider"></div>

    <div class="r-grid">
        <div class="r-info">
            <div class="r-section-title">Billed To</div>
            <p class="strong">{{ $receiptData['client_name'] }}</p>
            <p>{{ $receiptData['client_email'] }}</p>
            @if($receiptData['client_phone'])
            <p>{{ $receiptData['client_phone'] }}</p>
            @endif
        </div>
        
        <div class="r-info">
            <div class="r-section-title">Service Details</div>
            <p class="strong">{{ $receiptData['service_type'] }}</p>
            @if($receiptData['service_date'])
            <p>Scheduled: {{ $receiptData['service_date'] }}</p>
            @endif
        </div>
    </div>

    <table class="r-table">
        <thead>
            <tr>
                <th>Description</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div style="font-weight: 500; color: #111827;">{{ $receiptData['service_type'] }}</div>
                    @if($receiptData['client_notes'])
                    <div style="font-size: 0.85rem; color: #6b7280; margin-top: 4px;">{{ Str::limit($receiptData['client_notes'], 80) }}</div>
                    @endif
                </td>
                <td class="right">
                    @if($receiptData['amount'])
                        ₱{{ number_format($receiptData['amount'], 2) }}
                    @else
                        No Charge
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <div class="r-totals">
        <div class="r-total-row">
            <span>Subtotal</span>
            <span>@if($receiptData['amount']) ₱{{ number_format($receiptData['amount'], 2) }} @else ₱0.00 @endif</span>
        </div>
        <div class="r-total-row">
            <span>Processing Fee</span>
            <span>₱0.00</span>
        </div>
        <div class="r-total-final">
            <span>Total Paid</span>
            <span>@if($receiptData['amount']) ₱{{ number_format($receiptData['amount'], 2) }} @else ₱0.00 @endif</span>
        </div>
        
        @if(isset($receiptData['balance']) && $receiptData['balance'] > 0)
        <div class="r-total-row" style="margin-top: 16px; border-top: 1px dashed #e5e7eb; padding-top: 16px; font-weight: 600; color: #d97706;">
            <span>Balance Remaining</span>
            <span>₱{{ number_format($receiptData['balance'], 2) }}</span>
        </div>
        <div style="text-align: right; font-size: 0.75rem; color: #d97706; margin-top: 4px;">
            * Due before first fitting
        </div>
        @endif
        
        @if($receiptData['amount'])
        <div style="text-align: right; font-size: 0.8rem; color: #6b7280; margin-top: 16px;">
            Paid via Secure Gateway &bull; {{ \Carbon\Carbon::parse($receiptData['date_issued'])->format('M d, Y') }}
        </div>
        @endif
    </div>

    <div class="r-divider-light"></div>

    <div class="r-footer">
        <p style="font-weight: 600; color: #111827; margin-bottom: 4px;">Russ Cuevas Atelier</p>
        <p>Manila, Philippines &bull; info@russcuevas.com</p>
        <p style="margin-top: 12px; font-style: italic;">Thank you for choosing Russ Cuevas. Please arrive 5 minutes before your scheduled fitting time.<br>Cancellations must be made at least 24 hours in advance.</p>
    </div>

</div>

</body>
</html>
