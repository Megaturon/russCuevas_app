<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="{{ asset('images/RC_logo.jpg') }}" type="image/jpeg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout - Russ Cuevas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Inter', sans-serif;
            color: #111827;
        }
        .checkout-container {
            max-width: 680px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            overflow: hidden;
            position: relative;
        }
        .rc-brand {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-style: italic;
            text-align: center;
            padding: 40px 20px 10px 20px;
        }
        .ref-number {
            font-family: monospace;
            text-align: center;
            color: #6b7280;
            font-size: 0.85rem;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .validity-text {
            text-align: center;
            font-size: 0.8rem;
            color: #6b7280;
            margin-bottom: 30px;
        }
        .validity-text.expiring {
            color: #d97706; /* amber */
            font-weight: 500;
        }
        .summary-block {
            background: #f9fafb;
            padding: 30px 40px;
            border-top: 1px solid #f3f4f6;
            border-bottom: 1px solid #f3f4f6;
        }
        .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #9ca3af;
            margin-bottom: 16px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.95rem;
        }
        .summary-divider {
            border-top: 1px dashed #d1d5db;
            margin: 16px 0;
        }
        .summary-total {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 1.5rem;
            margin-top: 20px;
        }
        
        .payment-options {
            padding: 30px 40px 10px 40px;
            display: flex;
            gap: 20px;
        }
        @media (max-width: 600px) {
            .payment-options {
                flex-direction: column;
            }
        }
        .option-card {
            flex: 1;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 24px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }
        .option-card:hover {
            border-color: #9ca3af;
            background: #f9fafb;
        }
        .option-card.selected {
            border: 2px solid #111827;
            background: #fff;
        }
        .option-card.selected .check-icon {
            display: flex;
        }
        .check-icon {
            display: none;
            position: absolute;
            top: 12px;
            right: 12px;
            background: #111827;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
        }
        .option-label {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .option-amount {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .option-sub {
            font-size: 0.85rem;
            color: #4b5563;
            line-height: 1.4;
            margin-bottom: 12px;
        }
        .option-note {
            font-size: 0.75rem;
            color: #9ca3af;
            font-style: italic;
        }
        .option-badge {
            display: inline-block;
            background: #fef3c7;
            color: #d97706;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 12px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .payment-block {
            padding: 20px 40px 40px 40px;
        }
        .payment-method-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
        }
        .pm-tab {
            flex: 1;
            text-align: center;
            padding: 12px 0;
            border: 1px solid #d1d5db;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
            background: #fff;
        }
        .pm-tab.active {
            border-color: #111827;
            background: #111827;
            color: #fff;
        }
        .pm-tab:hover:not(.active) {
            background: #f3f4f6;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 14px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: border-color 0.2s;
            font-family: inherit;
        }
        .form-control:focus {
            outline: none;
            border-color: #111827;
            box-shadow: 0 0 0 1px #111827;
        }
        
        .btn-pay {
            width: 100%;
            background: #111827;
            color: #fff;
            padding: 18px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 1.05rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-pay:hover:not(:disabled) {
            background: #374151;
        }
        .btn-pay:disabled {
            background: #d1d5db;
            cursor: not-allowed;
            color: #9ca3af;
        }
        
        .secure-badge {
            text-align: center;
            margin-top: 24px;
            font-size: 0.75rem;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .error-banner {
            display: none;
            background: #fef2f2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            text-align: center;
            margin-top: 16px;
            border: 1px solid #fecaca;
        }

        /* Success Animation State */
        .success-overlay {
            display: none;
            background: #fff;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-align: center;
            min-height: 450px;
        }
        .checkmark-svg {
            width: 80px;
            height: 80px;
            margin-bottom: 24px;
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
            stroke-width: 3;
            stroke: #10b981;
            fill: none;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.6s forwards;
        }
        @keyframes stroke {
            100% { stroke-dashoffset: 0; }
        }
        .success-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            margin-bottom: 12px;
            opacity: 0;
            animation: fadeIn 0.5s ease 0.8s forwards;
        }
        .success-desc {
            color: #4b5563;
            font-size: 0.95rem;
            margin-bottom: 30px;
            line-height: 1.5;
            opacity: 0;
            animation: fadeIn 0.5s ease 1s forwards;
        }
        .success-details {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            text-align: left;
            margin-bottom: 30px;
            opacity: 0;
            animation: fadeIn 0.5s ease 1.2s forwards;
        }
        .success-details div {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-bottom: 8px;
            color: #4b5563;
        }
        .success-actions {
            width: 100%;
            opacity: 0;
            animation: fadeIn 0.5s ease 1.4s forwards;
        }
        @keyframes fadeIn {
            100% { opacity: 1; }
        }

        /* Generic Message Page (Expired/Already Paid) */
        .message-page {
            text-align: center;
            padding: 60px 40px;
        }
        .message-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            margin-bottom: 16px;
        }
        .message-desc {
            color: #6b7280;
            margin-bottom: 40px;
            line-height: 1.6;
        }
        .btn-outline {
            display: inline-block;
            border: 1px solid #d1d5db;
            padding: 12px 24px;
            border-radius: 40px;
            color: #111827;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn-outline:hover { background: #f9fafb; border-color: #9ca3af; }
        .btn-solid {
            display: inline-block;
            background: #111827;
            padding: 12px 24px;
            border-radius: 40px;
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn-solid:hover { background: #374151; }
    </style>
</head>
<body>

<div class="checkout-container">
    
    @if(isset($is_expired) && $is_expired)
        <div class="message-page">
            <div class="rc-brand" style="padding-top:0;">Russ Cuevas</div>
            <h2 class="message-title">Link Expired</h2>
            <p class="message-desc">This quote link has expired. Please log in to your portal to access your quote, or contact us to request a new link.</p>
            <div style="display: flex; gap: 12px; justify-content: center;">
                <a href="{{ route('login') }}" class="btn-solid">Log in to portal</a>
                <a href="mailto:info@russcuevas.com" class="btn-outline">Contact us</a>
            </div>
        </div>
    @elseif(isset($already_paid) && $already_paid)
        <div class="message-page">
            <div class="rc-brand" style="padding-top:0;">Russ Cuevas</div>
            <h2 class="message-title">Already Paid</h2>
            <p class="message-desc">You've already paid for this quote. View your receipt below.</p>
            @php
                $ref = 'RC-QTE-' . str_pad($quote->id, 5, '0', STR_PAD_LEFT);
            @endphp
            <a href="{{ route('receipts.show', $ref) }}" class="btn-solid">View Receipt</a>
        </div>
    @else
        <div id="payment-content">
            <div class="rc-brand">Russ Cuevas</div>
            @php
                $ref = 'QT-' . $quote->created_at->format('Ymd') . '-' . str_pad($quote->id, 4, '0', STR_PAD_LEFT);
                $daysLeft = now()->diffInDays($quote->token_expires_at, false);
                $isExpiringSoon = $daysLeft <= 3 && $daysLeft >= 0;
            @endphp
            <div class="ref-number">Ref: {{ $ref }}</div>
            
            <div class="validity-text {{ $isExpiringSoon ? 'expiring' : '' }}">
                @if($isExpiringSoon)
                    <i class="far fa-clock"></i> Expiring soon — {{ floor($daysLeft) }} days left
                @else
                    This quote expires on {{ $quote->token_expires_at->format('M d, Y') }}
                @endif
            </div>

            <div class="summary-block">
                <div class="section-label">Your Quote Summary</div>
                <div style="font-weight: 600; margin-bottom: 4px; font-size: 1.1rem;">{{ $quote->name }}</div>
                <div class="summary-row" style="margin-bottom: 24px;">
                    <span style="color: #6b7280;">{{ $quote->service_type }} &bull; {{ $quote->size === 'custom' ? 'Bespoke' : 'Standard' }}</span>
                    <span style="color: #6b7280;">4–6 Weeks</span>
                </div>
                
                <div class="summary-row">
                    <span>{{ $quote->service_type }} — design & fitting</span>
                    <span>₱{{ number_format($quote->price_quote, 2) }}</span>
                </div>
                
                <div class="summary-divider"></div>
                
                <div class="summary-total">
                    <span>Total Amount</span>
                    <span>₱{{ number_format($quote->price_quote, 2) }}</span>
                </div>
            </div>

            @php
                $depositPct = $quote->deposit_percentage ?? 50.00;
                $depositAmount = $quote->price_quote * ($depositPct / 100);
                $balanceAmount = $quote->price_quote - $depositAmount;
            @endphp

            <div class="payment-options">
                <div class="option-card" id="opt-deposit" onclick="selectOption('deposit', {{ $depositAmount }})">
                    <div class="check-icon"><i class="fas fa-check"></i></div>
                    <div class="option-label">Pay Deposit</div>
                    <div class="option-amount">₱{{ number_format($depositAmount, 2) }}</div>
                    <div class="option-sub">Reserve your slot now. Pay the remaining ₱{{ number_format($balanceAmount, 2) }} before your first fitting.</div>
                    <div class="option-note">Deposit is non-refundable after 48 hours.</div>
                </div>
                
                <div class="option-card" id="opt-full" onclick="selectOption('full', {{ $quote->price_quote }})">
                    <div class="check-icon"><i class="fas fa-check"></i></div>
                    <div class="option-badge">Recommended</div>
                    <div class="option-label">Pay In Full</div>
                    <div class="option-amount">₱{{ number_format($quote->price_quote, 2) }}</div>
                    <div class="option-sub">Complete your payment now and skip the balance step entirely.</div>
                </div>
            </div>

            <div class="payment-block">
                <div class="section-label" style="margin-bottom: 20px;">Payment Method</div>
                
                <div class="payment-method-tabs">
                    <div class="pm-tab" onclick="selectMethod('gcash')" id="method-gcash">GCash</div>
                    <div class="pm-tab" onclick="selectMethod('maya')" id="method-maya">Maya</div>
                    <div class="pm-tab active" onclick="selectMethod('card')" id="method-card">Credit / Debit</div>
                </div>

                <form id="checkout-form" onsubmit="processPayment(event)">
                    @csrf
                    <input type="hidden" name="payment_type" id="input-payment-type" value="">
                    <input type="hidden" name="payment_method" id="input-payment-method" value="Credit Card">
                    <div id="card-fields">
                        <div class="form-group">
                            <label>Cardholder Name</label>
                            <input type="text" class="form-control" placeholder="e.g. Emily Rose" id="card-name" name="card_name">
                        </div>
                        
                        <div class="form-group">
                            <label>Card Number</label>
                            <div style="position: relative;">
                                <input type="text" class="form-control" placeholder="1234 5678 9012 3456" id="card-number" name="card_number" maxlength="19" onkeyup="detectCardBrand(this)">
                                <i id="card-brand-icon" class="far fa-credit-card" style="position: absolute; right: 14px; top: 16px; color: #9ca3af; font-size: 1.1rem;"></i>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 16px;">
                            <div class="form-group" style="flex: 1;">
                                <label>Expiry Date</label>
                                <input type="text" class="form-control" placeholder="MM / YY" id="card-expiry" name="card_expiry" maxlength="5" onkeyup="formatExpiry(this)">
                            </div>
                            <div class="form-group" style="flex: 1;">
                                <label>CVV</label>
                                <input type="text" class="form-control" placeholder="123" id="card-cvv" name="card_cvv" maxlength="4">
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 8px; margin-top: 8px;">
                            <input type="checkbox" id="save-card" style="width: 16px; height: 16px; accent-color: #111827;">
                            <label for="save-card" style="font-size: 0.8rem; color: #4b5563; margin-bottom: 0; text-transform: none; letter-spacing: 0;">Save card for future payments</label>
                        </div>
                    </div>

                    <div id="ewallet-message" style="display: none; text-align: center; padding: 20px; background: #f9fafb; border-radius: 6px; border: 1px solid #e5e7eb; color: #4b5563; font-size: 0.9rem; margin-bottom: 20px;">
                        You will be redirected to <span id="ewallet-name">GCash</span> to complete your payment securely. You will return to this page after.
                    </div>

                    <div class="error-banner" id="error-banner"></div>

                    <button type="submit" class="btn-pay" id="btn-submit" disabled>
                        Select a payment option
                    </button>
                    
                    <div class="secure-badge">
                        <i class="fas fa-lock"></i> Secured by PayMongo — your payment is encrypted and safe
                    </div>
                    <div style="text-align: center; margin-top: 16px; font-size: 0.75rem; color: #9ca3af;">
                        Having trouble? Contact us at info@russcuevas.com
                    </div>
                    <div style="text-align: center; margin-top: 8px; font-size: 0.7rem; color: #9ca3af;">
                        By completing payment you agree to our cancellation and refund policy.
                    </div>
                </form>
            </div>
        </div>

        <!-- Inline Success State -->
        <div class="success-overlay" id="success-overlay">
            <svg class="checkmark-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
            <h2 class="success-title">Payment received.</h2>
            <p class="success-desc">Thank you, {{ explode(' ', trim($quote->name))[0] }}. <br><span id="success-message"></span></p>
            
            <div class="success-details">
                <div><span>Amount Paid:</span> <strong id="success-amount" style="color:#111827;"></strong></div>
                <div><span>Method:</span> <strong id="success-method" style="color:#111827;"></strong></div>
                <div><span>Date:</span> <strong id="success-date" style="color:#111827;"></strong></div>
                <div><span>Reference:</span> <strong id="success-ref" style="color:#111827; font-family: monospace;"></strong></div>
            </div>
            
            <div class="success-actions" style="display: flex; gap: 12px; justify-content: center; width: 100%;">
                <a href="#" id="btn-view-receipt" class="btn-solid" style="flex:1;">View Receipt</a>
                <a href="{{ route('portal.quotes') }}" class="btn-outline" style="flex:1;">Go to My Portal</a>
            </div>
        </div>

        <script>
            let selectedType = null;
            let selectedAmount = 0;
            let currentMethod = 'card';

            function selectOption(type, amount) {
                document.querySelectorAll('.option-card').forEach(el => el.classList.remove('selected'));
                document.getElementById('opt-' + type).classList.add('selected');
                
                selectedType = type;
                selectedAmount = amount;
                document.getElementById('input-payment-type').value = type;
                
                updateButtonState();
            }

            function selectMethod(method) {
                document.querySelectorAll('.pm-tab').forEach(el => el.classList.remove('active'));
                document.getElementById('method-' + method).classList.add('active');
                
                currentMethod = method;
                document.getElementById('input-payment-method').value = method === 'card' ? 'Credit Card' : method.charAt(0).toUpperCase() + method.slice(1);
                
                const cardFields = document.getElementById('card-fields');
                const ewalletMsg = document.getElementById('ewallet-message');
                
                if (method === 'card') {
                    cardFields.style.display = 'block';
                    ewalletMsg.style.display = 'none';
                } else {
                    cardFields.style.display = 'none';
                    ewalletMsg.style.display = 'block';
                    document.getElementById('ewallet-name').textContent = method === 'gcash' ? 'GCash' : 'Maya';
                }
                updateButtonState();
            }

            function updateButtonState() {
                const btn = document.getElementById('btn-submit');
                if (!selectedType) {
                    btn.disabled = true;
                    btn.innerHTML = 'Select a payment option';
                    return;
                }
                
                // Form validation for cards
                if (currentMethod === 'card') {
                    const name = document.getElementById('card-name').value.trim();
                    const num = document.getElementById('card-number').value.replace(/\s/g, '');
                    const exp = document.getElementById('card-expiry').value;
                    const cvv = document.getElementById('card-cvv').value;
                    
                    if (name.length < 3 || num.length < 15 || exp.length < 5 || cvv.length < 3) {
                        btn.disabled = true;
                        btn.textContent = 'Fill in card details to Pay ₱' + selectedAmount.toLocaleString('en-US', {minimumFractionDigits: 2});
                        return;
                    }
                }

                btn.disabled = false;
                btn.innerHTML = `<i class="fas fa-lock" style="font-size: 0.85rem;"></i> Pay ₱${selectedAmount.toLocaleString('en-US', {minimumFractionDigits: 2})}`;
            }

            // Real-time validation listeners
            ['card-name', 'card-number', 'card-expiry', 'card-cvv'].forEach(id => {
                document.getElementById(id).addEventListener('input', updateButtonState);
            });

            function formatExpiry(input) {
                let val = input.value.replace(/\D/g, '');
                if (val.length >= 2) {
                    val = val.substring(0,2) + ' / ' + val.substring(2,4);
                }
                input.value = val;
            }

            function detectCardBrand(input) {
                let val = input.value.replace(/\D/g, '');
                let formatted = '';
                for (let i = 0; i < val.length; i++) {
                    if (i > 0 && i % 4 === 0) formatted += ' ';
                    formatted += val[i];
                }
                input.value = formatted;
                
                const icon = document.getElementById('card-brand-icon');
                if (val.startsWith('4')) {
                    icon.className = 'fab fa-cc-visa';
                    icon.style.color = '#1a1f71';
                } else if (val.startsWith('5')) {
                    icon.className = 'fab fa-cc-mastercard';
                    icon.style.color = '#eb001b';
                } else {
                    icon.className = 'far fa-credit-card';
                    icon.style.color = '#9ca3af';
                }
            }

            async function processPayment(e) {
                e.preventDefault();
                if (!selectedType) return;
                
                const btn = document.getElementById('btn-submit');
                const errBanner = document.getElementById('error-banner');
                
                if (currentMethod === 'card') {
                    if (!document.getElementById('card-number').value || !document.getElementById('card-expiry').value || !document.getElementById('card-cvv').value) {
                        errBanner.textContent = 'Please fill out all card details.';
                        errBanner.style.display = 'block';
                        return;
                    }
                }
                
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Processing...';
                errBanner.style.display = 'none';

                try {
                    const formData = new FormData(document.getElementById('checkout-form'));
                    
                    const response = await fetch("{{ route('checkout.process_payment', $token) }}", {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        // Populate success overlay
                        document.getElementById('success-amount').textContent = '₱' + data.amount_paid;
                        document.getElementById('success-method').textContent = data.method;
                        document.getElementById('success-date').textContent = data.date_str;
                        document.getElementById('success-ref').textContent = data.reference;
                        
                        const msg = data.is_deposit 
                            ? `Your slot is confirmed. Your remaining balance of ₱${data.balance} is due before your first fitting.`
                            : `Your appointment is fully confirmed. We look forward to working with you.`;
                        document.getElementById('success-message').textContent = msg;
                        
                        document.getElementById('btn-view-receipt').href = '/receipts/' + data.reference;
                        
                        // Animate transition
                        const content = document.getElementById('payment-content');
                        if (content) {
                            content.style.transition = 'opacity 0.4s';
                            content.style.opacity = '0';
                            
                            setTimeout(() => {
                                content.style.display = 'none';
                                const overlay = document.getElementById('success-overlay');
                                overlay.style.display = 'flex';
                            }, 400);
                        } else {
                            // fallback if payment-content id missing
                            document.querySelector('.payment-card').style.opacity = '0';
                            setTimeout(() => {
                                document.querySelector('.payment-card').style.display = 'none';
                                const overlay = document.getElementById('success-overlay');
                                overlay.style.display = 'flex';
                            }, 400);
                        }

                    } else {
                        errBanner.textContent = data.message || 'Payment failed. Please check your details.';
                        errBanner.style.display = 'block';
                        updateButtonState();
                    }
                } catch (error) {
                    errBanner.textContent = 'A network error occurred. Please try again.';
                    errBanner.style.display = 'block';
                    updateButtonState();
                }
            }
        </script>
    @endif
</div>

</body>
</html>

