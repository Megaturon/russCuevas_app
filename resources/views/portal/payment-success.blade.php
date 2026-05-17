<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful — Russ Cuevas</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --black: #111827;
            --white: #ffffff;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Inter', sans-serif;
        }
        body {
            font-family: var(--font-sans);
            background-color: #f9fafb;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .success-card {
            background: var(--white);
            max-width: 500px;
            width: 100%;
            padding: 50px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            text-align: center;
        }
        
        .checkmark-svg {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #10b981;
            stroke-miterlimit: 10;
            margin: 0 auto 20px auto;
            box-shadow: inset 0px 0px 0px #10b981;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        }

        .checkmark-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke-miterlimit: 10;
            stroke: #10b981;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark-check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
            100% { stroke-dashoffset: 0; }
        }
        @keyframes scale {
            0%, 100% { transform: none; }
            50% { transform: scale3d(1.1, 1.1, 1); }
        }
        @keyframes fill {
            100% { box-shadow: inset 0px 0px 0px 50px #d1fae5; }
        }
        
        h1 {
            font-family: var(--font-serif);
            color: var(--black);
            margin: 0 0 10px 0;
            font-size: 2rem;
        }
        p {
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .details-box {
            background: #f3f4f6;
            border-radius: 8px;
            padding: 20px;
            text-align: left;
            margin-bottom: 30px;
        }
        .details-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.9rem;
        }
        .details-row:last-child {
            margin-bottom: 0;
        }
        .details-label {
            color: #6b7280;
        }
        .details-value {
            font-weight: 600;
            color: var(--black);
        }
        
        .btn-group {
            display: flex;
            gap: 15px;
        }
        .btn {
            flex: 1;
            padding: 14px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .btn-primary {
            background: var(--black);
            color: var(--white);
            border: 1px solid var(--black);
        }
        .btn-primary:hover {
            background: #374151;
        }
        .btn-outline {
            background: transparent;
            color: var(--black);
            border: 1px solid #d1d5db;
        }
        .btn-outline:hover {
            background: #f3f4f6;
        }
    </style>
</head>
<body>

<div class="success-card">
    <svg class="checkmark-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
    </svg>
    
    <h1>Payment Successful</h1>
    <p>
        Thank you, {{ explode(' ', trim($quote->name))[0] }}. 
        @if($quote->payment_type === 'deposit')
            Your deposit has secured your spot. The remaining balance will be due before your first fitting.
        @else
            Your payment in full has been received.
        @endif
    </p>
    
    <div class="details-box">
        <div class="details-row">
            <span class="details-label">Amount Paid</span>
            <span class="details-value">₱{{ number_format($quote->amount_paid, 2) }}</span>
        </div>
        <div class="details-row">
            <span class="details-label">Reference No.</span>
            <span class="details-value" style="font-family: monospace;">RC-QTE-{{ str_pad($quote->id, 5, '0', STR_PAD_LEFT) }}</span>
        </div>
        <div class="details-row">
            <span class="details-label">Date</span>
            <span class="details-value">{{ $quote->paid_at ? $quote->paid_at->format('M d, Y h:i A') : now()->format('M d, Y h:i A') }}</span>
        </div>
    </div>
    
    <div class="btn-group">
        <a href="/receipts/RC-QTE-{{ str_pad($quote->id, 5, '0', STR_PAD_LEFT) }}" class="btn btn-primary" target="_blank">View Receipt</a>
        <a href="{{ route('portal.quotes') }}" class="btn btn-outline">My Portal</a>
    </div>
</div>

</body>
</html>
