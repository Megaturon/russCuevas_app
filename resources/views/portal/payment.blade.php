@extends('layouts.portal')

@section('title', 'Secure Checkout')

@section('content')
<div class="portal-header">
    <i class="fas fa-lock text-gray-400"></i> Secure Checkout
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    
    <!-- Payment Form -->
    <div class="md:col-span-2">
        <div class="portal-card p-8">
            <h3 class="font-serif text-2xl italic mb-6">Payment Details</h3>
            
            <form action="{{ route('portal.quote.process_payment', $quote->id) }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Cardholder Name</label>
                    <input type="text" required value="{{ auth()->user()->name }}" class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:border-black transition-colors" placeholder="Name on card">
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Card Number</label>
                    <div class="relative">
                        <input type="text" required class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:border-black transition-colors" placeholder="0000 0000 0000 0000">
                        <div class="absolute right-3 top-3 text-gray-400 text-lg">
                            <i class="fab fa-cc-visa mx-1"></i>
                            <i class="fab fa-cc-mastercard mx-1"></i>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Expiry Date</label>
                        <input type="text" required class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:border-black transition-colors" placeholder="MM/YY">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">CVC</label>
                        <input type="text" required class="w-full border border-gray-300 p-3 rounded focus:outline-none focus:border-black transition-colors" placeholder="123">
                    </div>
                </div>

                <hr class="border-gray-200 mb-8">

                <button type="submit" class="w-full bg-black text-white p-4 uppercase tracking-widest text-sm font-medium hover:bg-gray-800 transition-colors flex items-center justify-center gap-2">
                    <i class="fas fa-lock"></i> Pay ₱{{ number_format($quote->price_quote, 2) }}
                </button>
                <p class="text-center text-xs text-gray-400 mt-4"><i class="fas fa-shield-alt"></i> Payments are secure and encrypted.</p>
            </form>
        </div>
    </div>

    <!-- Order Summary -->
    <div class="md:col-span-1">
        <div class="portal-card p-6 bg-gray-50 border border-gray-100">
            <h3 class="font-medium text-sm text-gray-500 uppercase tracking-widest mb-4 border-b border-gray-200 pb-2">Order Summary</h3>
            
            <div class="mb-4">
                <div class="text-sm font-bold text-gray-800">{{ $quote->service_type }}</div>
                <div class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $quote->details }}</div>
            </div>

            <div class="flex justify-between items-center mb-4 text-sm">
                <span class="text-gray-500">Service Fee</span>
                <span>₱{{ number_format($quote->price_quote, 2) }}</span>
            </div>
            
            <div class="flex justify-between items-center mb-6 text-sm">
                <span class="text-gray-500">Processing Fee</span>
                <span>₱0.00</span>
            </div>

            <div class="border-t border-gray-200 pt-4 flex justify-between items-center">
                <span class="font-bold text-gray-800 uppercase text-xs tracking-wider">Total</span>
                <span class="font-bold text-lg text-black">₱{{ number_format($quote->price_quote, 2) }}</span>
            </div>
        </div>
        
        <div class="mt-6 text-xs text-gray-400 leading-relaxed">
            By completing this payment, you agree to our <a href="/terms" class="underline hover:text-gray-600">Terms & Conditions</a> regarding bespoke services. All payments are considered final and confirm your reservation.
        </div>
    </div>

</div>
@endsection
