@extends('public.layouts.app')

@section('title', 'Checkout - ' . $book->title)

@section('content')

@php
    $price = isset($book->price) ? $book->price : 3400000;
@endphp

<div class="min-h-screen bg-slate-50 dark:bg-slate-900 pt-24 pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <a href="{{ route('book.show', $book->slug) }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors group">
                <span class="material-symbols-outlined text-[18px] transform transition-transform group-hover:-translate-x-1">arrow_back</span>
                Back to Book
            </a>
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mt-4 font-display">Secure Checkout</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-2">Finish your order to get instant access to the publication.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            
            {{-- Form Column --}}
            <div class="lg:col-span-7 space-y-8">
                <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 md:p-8 shadow-sm border border-slate-100 dark:border-slate-700">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">person</span>
                        Your Personal Detail
                    </h2>
                    
                    <form id="checkout-form" class="space-y-5" onsubmit="event.preventDefault(); simulatePayment();">
                        <div>
                            <label for="name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">Full Name</label>
                            <input type="text" id="name" required class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-shadow" placeholder="John Doe">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-1.5">Email Address</label>
                            <input type="email" id="email" required class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-shadow" placeholder="john@example.com">
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-700 mt-6">
                            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                                Payment Method
                            </h2>
                            <select id="payment-method" required class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-shadow appearance-none cursor-pointer" onchange="toggleQris(this.value)">
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="bank">Bank Transfer (BCA, Mandiri, BNI)</option>
                                <option value="ewallet">E-Wallet (GoPay, OVO, Dana)</option>
                                <option value="qris">QRIS (Scan QR)</option>
                            </select>
                        </div>

                        {{-- QRIS Section (Hidden by default) --}}
                        <div id="qris-section" class="hidden mt-4 bg-slate-50 dark:bg-slate-900 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 flex flex-col items-center justify-center text-center">
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Scan to Pay</span>
                            <div class="w-48 h-48 bg-white p-3 rounded-xl shadow-sm mb-3 relative flex items-center justify-center overflow-hidden">
                                {{-- Dummy QR implementation --}}
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=DummyPaymentDataJarreva&bgcolor=FFFFFF&color=000000" alt="QRIS Dummy" class="w-full h-full object-contain">
                                <div class="absolute inset-0 border-4 border-primary/20 rounded-xl pointer-events-none"></div>
                            </div>
                            <img src="https://assets.website-files.com/6180df1a5477263b61fa8249/61823eb52843ef5bc4ac715f_logo-qris.svg" alt="QRIS Logo" class="h-6 opacity-70">
                            <p class="text-xs text-slate-500 mt-3 font-medium">Valid for next 15 minutes</p>
                        </div>

                        <div class="pt-6">
                            <button type="submit" id="btn-pay" class="w-full relative inline-flex items-center justify-center px-8 py-4 bg-primary text-white text-base font-bold rounded-xl overflow-hidden transition-all duration-300 shadow-[0_10px_20px_-10px_rgba(249,115,22,0.8)] hover:shadow-[0_15px_30px_-10px_rgba(249,115,22,1)] hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-orange-500/30">
                                <span class="relative z-10 flex items-center gap-2" id="btn-pay-text">
                                    <span class="material-symbols-outlined text-[20px]">lock</span>
                                    Pay Rp {{ number_format($price, 0, ',', '.') }}
                                </span>
                                <span class="absolute inset-0 flex items-center justify-center bg-primary z-20 hidden" id="btn-pay-loading">
                                    <span class="material-symbols-outlined animate-spin">progress_activity</span>
                                    <span class="ml-2">Processing...</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Summary Column --}}
            <div class="lg:col-span-5 relative">
                <div class="sticky top-24 bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-slate-100 dark:border-slate-700">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Order Summary</h2>
                    
                    <div class="flex gap-4 mb-6 pb-6 border-b border-slate-100 dark:border-slate-700">
                        <div class="w-20 md:w-24 shrink-0 rounded-lg overflow-hidden shadow-md bg-slate-100">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-auto aspect-[2/3] object-cover">
                            @else
                                <div class="w-full h-full aspect-[2/3] flex items-center justify-center bg-slate-200 dark:bg-slate-700">
                                    <span class="material-symbols-outlined text-slate-400">menu_book</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col justify-center">
                            <span class="text-[10px] uppercase font-bold tracking-widest text-primary mb-1">{{ $book->category ?? 'Premium Publication' }}</span>
                            <h3 class="text-lg md:text-xl font-bold text-slate-900 dark:text-white leading-snug line-clamp-2" style="font-family: 'Montserrat', sans-serif;">{{ $book->title }}</h3>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400 mt-1">By {{ $book->author ?? 'Jarreva Creative' }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between items-center text-slate-600 dark:text-slate-300">
                            <span class="font-medium">Subtotal</span>
                            <span class="font-bold">Rp {{ number_format($price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-slate-600 dark:text-slate-300">
                            <span class="font-medium">Tax & Fees <span class="text-[10px] bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded ml-1">Included</span></span>
                            <span class="font-bold">Rp 0</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 dark:border-slate-700 flex justify-between items-center">
                        <span class="text-lg font-bold text-slate-900 dark:text-white">Total</span>
                        <span class="text-2xl font-black text-primary">Rp {{ number_format($price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Success Overlay Modal (Hidden) --}}
<div id="success-modal" class="fixed inset-0 z-50 flex items-center justify-center px-4 bg-slate-900/40 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
    <div class="bg-white dark:bg-slate-800 rounded-3xl w-full max-w-sm p-8 text-center shadow-2xl transform scale-95 transition-transform duration-300" id="success-modal-content">
        <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
            <span class="material-symbols-outlined text-4xl text-emerald-500 font-bold">check_circle</span>
        </div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-2">Payment Successful!</h2>
        <p class="text-slate-500 dark:text-slate-400 font-medium mb-8">Thank you for your purchase. You can now access your publication immediately.</p>
        
        <a href="{{ route('book.read', $book->slug) }}" class="flex items-center justify-center w-full px-6 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl transition-colors gap-2">
            <span class="material-symbols-outlined">auto_stories</span>
            Read Book Now
        </a>
    </div>
</div>

<script>
    function toggleQris(method) {
        const qrisSection = document.getElementById('qris-section');
        if(method === 'qris') {
            qrisSection.classList.remove('hidden');
            // Small reveal animation
            qrisSection.style.opacity = '0';
            setTimeout(() => { qrisSection.style.transition = 'opacity 0.3s'; qrisSection.style.opacity = '1'; }, 10);
        } else {
            qrisSection.classList.add('hidden');
        }
    }

    function simulatePayment() {
        const btnText = document.getElementById('btn-pay-text');
        const btnLoading = document.getElementById('btn-pay-loading');
        const formObj = document.getElementById('checkout-form');
        const modal = document.getElementById('success-modal');
        const modalContent = document.getElementById('success-modal-content');
        
        if(!formObj.checkValidity()) {
            formObj.reportValidity();
            return;
        }

        // Show loading state
        btnText.classList.add('invisible');
        btnLoading.classList.remove('hidden');
        
        // Disable inputs
        const elements = formObj.elements;
        for (let i = 0; i < elements.length; i++) {
            elements[i].disabled = true;
        }

        // Simulate network API call (1.5 seconds)
        setTimeout(() => {
            // Show modal
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 1500);
    }
</script>

@endsection
