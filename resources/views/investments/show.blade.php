@extends('layouts.app')

@section('content')
<div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute bg-purple-500 rounded-full -top-4 -left-4 w-72 h-72 mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute rounded-full -top-4 -right-4 w-72 h-72 bg-cyan-500 mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bg-pink-500 rounded-full -bottom-8 left-20 w-72 h-72 mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Grid Pattern Overlay -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="1.5"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>

    <div class="relative z-10 px-6 py-10 mx-auto max-w-7xl">
        <!-- Futuristic Back Button -->
        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 px-6 py-3 mb-8 text-sm font-medium text-white transition-all duration-300 border rounded-full shadow-lg group bg-gradient-to-r from-slate-700 to-slate-600 border-slate-500 hover:from-slate-600 hover:to-slate-500 backdrop-blur-sm hover:shadow-xl hover:scale-105">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Home
        </a>

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-12">
            <!-- Left: Image & Info -->
            <div class="space-y-6 lg:col-span-7">
                <!-- Floating Badge -->
                <div class="animate-pulse">
                    <span class="inline-block px-4 py-2 text-xs font-semibold tracking-wider border rounded-full text-cyan-300 bg-gradient-to-r from-cyan-500/20 to-purple-500/20 border-cyan-500/30 backdrop-blur-sm">
                        INVEST IN {{ strtoupper($investment->title) }}
                    </span>
                </div>

                <!-- Glowing Title -->
                <h1 class="text-4xl font-bold text-transparent lg:text-5xl bg-gradient-to-r from-white via-cyan-200 to-purple-200 bg-clip-text animate-gradient-x drop-shadow-2xl">
                    {{ $investment->title }}
                </h1>

                @if($investment->badge)
                    <div class="inline-flex items-center gap-2 px-4 py-2 border rounded-full bg-gradient-to-r from-red-500/20 to-pink-500/20 border-red-500/30 backdrop-blur-sm">
                        <div class="w-2 h-2 bg-red-400 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium text-red-300">{{ $investment->badge }}</span>
                    </div>
                @endif

                <!-- Futuristic Image Container -->
                <div class="relative overflow-hidden shadow-2xl group rounded-2xl">
                    <div class="absolute inset-0 transition-opacity duration-500 opacity-0 bg-gradient-to-tr from-purple-500/20 to-cyan-500/20 group-hover:opacity-100"></div>
                    <img src="{{ asset('storage/' . $investment->image) }}"
                        alt="{{ $investment->title }}"
                        class="object-cover w-full h-[400px] transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 ring-1 ring-white/20 rounded-2xl"></div>
                </div>

                <!-- Floating Info Cards -->
                <div class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[200px] px-4 py-3 bg-gradient-to-r from-slate-800/80 to-slate-700/80 rounded-xl border border-slate-600/50 backdrop-blur-sm hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></div>
                            <span class="text-sm text-slate-300">Kategori</span>
                        </div>
                        <p class="font-semibold text-white">{{ $investment->category->name }}</p>
                    </div>
                    <div class="flex-1 min-w-[200px] px-4 py-3 bg-gradient-to-r from-slate-800/80 to-slate-700/80 rounded-xl border border-slate-600/50 backdrop-blur-sm hover:scale-105 transition-transform duration-300">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-sm text-slate-300">Status</span>
                        </div>
                        <p class="font-semibold text-white">Trending</p>
                    </div>
                </div>

                <!-- Overview Section -->
                <div class="p-6 border bg-gradient-to-br from-slate-800/60 to-slate-900/60 rounded-2xl border-slate-700/50 backdrop-blur-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-1 h-6 rounded-full bg-gradient-to-b from-cyan-400 to-purple-400"></div>
                        <h2 class="text-xl font-bold text-white">Overview</h2>
                    </div>
                    <div class="space-y-4 leading-relaxed text-slate-200">
                        {!! nl2br(e($investment->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Right: Investment Panel -->
            <div class="lg:col-span-5">
                <div class="sticky p-8 border shadow-2xl top-6 bg-gradient-to-br from-slate-800/90 to-slate-900/90 rounded-3xl border-slate-700/50 backdrop-blur-xl">
                    <!-- Price Section -->
                    <div class="mb-8">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-sm tracking-wider uppercase text-slate-400">Over Subscribed</span>
                        </div>
                        <div class="flex items-baseline gap-2">
                            <h2 class="text-4xl font-bold text-transparent bg-gradient-to-r from-green-400 to-emerald-300 bg-clip-text">
                                Rp{{ number_format($investment->market_price, 0, ',', '.') }}
                            </h2>
                            <div class="px-2 py-1 text-xs text-green-300 rounded-full bg-green-500/20">
                                +12.5%
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-slate-400">*Harga per 1 slot / saham / unit investasi</p>
                    </div>

                    <!-- Error Messages -->
                    @if (session('error'))
                        <div class="p-4 mb-6 text-sm text-red-300 border bg-gradient-to-r from-red-500/20 to-red-600/20 border-red-500/30 rounded-xl backdrop-blur-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="p-4 mb-6 text-sm text-red-300 border bg-gradient-to-r from-red-500/20 to-red-600/20 border-red-500/30 rounded-xl backdrop-blur-sm">
                            <ul class="pl-5 space-y-1 list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @guest
                        <div class="p-6 mb-6 text-center border bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border-blue-500/30 rounded-2xl backdrop-blur-sm">
                            <p class="mb-3 text-blue-200">Unlock Your Investment Potential</p>
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center gap-2 px-6 py-3 font-semibold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl hover:from-blue-600 hover:to-cyan-600 hover:scale-105 hover:shadow-xl">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Login to Invest
                            </a>
                        </div>
                    @else
                        <!-- Investment Form -->
                        <form class="mb-8 space-y-6" action="{{ route('investments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="investment_id" value="{{ $investment->id }}">

                            <div>
                                <label for="amountInput" class="block mb-2 text-sm font-medium text-slate-200">
                                    Investment Amount
                                </label>
                                <div class="relative">
                                    <input type="number" id="amountInput" name="amount"
                                        class="w-full px-4 py-4 text-white transition-all duration-300 border bg-slate-700/50 border-slate-600 rounded-xl placeholder-slate-400 focus:ring-2 focus:ring-cyan-500 focus:border-transparent backdrop-blur-sm"
                                        placeholder="Enter amount (min: 500,000)" min="1" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="text-sm text-slate-400">IDR</span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit"
                                onclick="return handleInvest(event)"
                                class="relative w-full px-6 py-4 overflow-hidden font-bold text-white transition-all duration-300 transform shadow-lg group bg-gradient-to-r from-teal-500 to-cyan-500 rounded-xl hover:from-teal-600 hover:to-cyan-600 hover:scale-105 hover:shadow-2xl">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    Invest Now
                                </span>
                                <div class="absolute inset-0 transition-transform duration-700 transform -translate-x-full -skew-x-12 bg-gradient-to-r from-white/0 via-white/20 to-white/0 group-hover:translate-x-full"></div>
                            </button>
                        </form>

                        @php
                            $userTransaction = auth()->user()
                                ? \App\Models\InvestmentTransaction::where('user_id', auth()->id())
                                    ->where('investment_id', $investment->id)
                                    ->first()
                                : null;
                        @endphp

                        @php
                            $marketPrice = $investment->market_price;
                            $unit = 0;
                            $totalNow = 0;

                            if ($userTransaction) {
                                $unit = $userTransaction->amount / max($userTransaction->purchase_price, 1);
                                $totalNow = $unit * $marketPrice;
                            }
                        @endphp

                        <!-- Sell Form -->
                        <form id="sellForm" action="{{ route('investments.sell') }}" method="POST" class="pt-6 space-y-6 border-t border-slate-700">
                            @csrf
                            @if($userTransaction)
                                <input type="hidden" name="transaction_id" value="{{ $userTransaction->id }}">
                            @endif

                            <div>
                                <label for="sellAmount" class="block mb-2 text-sm font-medium text-slate-200">
                                    Sell Amount (IDR)
                                </label>
                                <input type="number" id="sellAmount" name="amount"
                                    class="w-full px-4 py-4 text-white transition-all duration-300 border bg-slate-700/50 border-slate-600 rounded-xl placeholder-slate-400 focus:ring-2 focus:ring-red-500 focus:border-transparent backdrop-blur-sm"
                                    placeholder="Enter sell amount: {{ round($totalNow) }}" min="1" required>
                            </div>

                            <div class="space-y-3">
                                <button type="submit"
                                        class="w-full px-6 py-3 font-semibold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-red-500 to-pink-500 rounded-xl hover:from-red-600 hover:to-pink-600 hover:scale-105">
                                    Sell Investment
                                </button>

                                <button type="button"
                                        onclick="document.getElementById('sellAmount').value = {{ round($totalNow) }};"
                                        class="w-full px-6 py-3 font-semibold text-red-400 transition-all duration-300 bg-transparent border-2 border-red-500 rounded-xl hover:bg-red-500/10">
                                    Sell All Assets (Rp {{ number_format($totalNow, 0, ',', '.') }})
                                </button>
                            </div>
                        </form>
                    @endguest

                    <!-- Investment Info -->
                    <div class="pt-6 space-y-4 border-t border-slate-700">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="p-3 rounded-lg bg-slate-700/30">
                                <p class="mb-1 text-slate-400">Minimum</p>
                                <p class="font-semibold text-white">Rp500.000</p>
                            </div>
                            <div class="p-3 rounded-lg bg-slate-700/30">
                                <p class="mb-1 text-slate-400">Return Range</p>
                                <p class="font-semibold text-green-400">10% - 75%</p>
                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-slate-700/30">
                            <p class="mb-1 text-slate-400">Risk Profile</p>
                            <div class="flex gap-2">
                                <span class="px-2 py-1 text-xs text-yellow-300 rounded-full bg-yellow-500/20">Medium</span>
                                <span class="px-2 py-1 text-xs text-red-300 rounded-full bg-red-500/20">High</span>
                            </div>
                        </div>
                    </div>

                    <!-- Warning -->
                    <div class="p-4 mt-6 border bg-gradient-to-r from-amber-500/10 to-orange-500/10 border-amber-500/20 rounded-xl">
                        <div class="flex gap-3">
                            <div class="text-amber-400 mt-0.5">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <p class="text-xs text-amber-200">
                                Please read investment documents & terms before proceeding. Investment values may fluctuate based on startup performance.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Futuristic Modal -->
<div id="confirmModal"
     class="fixed inset-0 z-50 items-center justify-center hidden transition-all duration-500 bg-black/80 backdrop-blur-sm"
     style="display: none;">
    <div id="modalContent"
         class="w-[90%] max-w-lg p-8 bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl border border-slate-600 shadow-2xl transform scale-95 opacity-0 transition-all duration-500 ease-out relative overflow-hidden">

        <!-- Modal Background Animation -->
        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-cyan-500/10 animate-pulse"></div>

        <div class="relative z-10 text-center">
            <!-- Icon -->
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 rounded-full bg-gradient-to-r from-cyan-500 to-purple-500">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <h2 class="mb-4 text-2xl font-bold text-white">User Consent Required</h2>
            <p class="mb-3 leading-relaxed text-slate-300">
                We need your permission to collect and use certain data to enhance your experience.
            </p>
            <p class="mb-8 text-sm text-slate-400">
                By clicking "Agree", you grant us permission to use data as described above.
            </p>

            <div class="flex justify-center gap-4">
                <button onclick="closeModal()"
                        class="px-8 py-3 font-semibold text-white transition-all duration-300 transform bg-gradient-to-r from-slate-600 to-slate-700 rounded-xl hover:from-slate-700 hover:to-slate-800 hover:scale-105">
                    Decline
                </button>
                <button onclick="submitInvestment()"
                        class="px-8 py-3 font-semibold text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-teal-500 to-cyan-500 rounded-xl hover:from-teal-600 hover:to-cyan-600 hover:scale-105 hover:shadow-xl">
                    Agree & Continue
                </button>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

@keyframes gradient-x {
    0%, 100% { background-size: 200% 200%; background-position: left center; }
    50% { background-size: 200% 200%; background-position: right center; }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.animate-gradient-x {
    animation: gradient-x 3s ease infinite;
}

/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(51, 65, 85, 0.3);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #06b6d4, #8b5cf6);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(45deg, #0891b2, #7c3aed);
}
</style>

<script>
    function handleInvest(e) {
        e.preventDefault();
        const amount = document.getElementById('amountInput').value;
        if (!amount || amount < 1) {
            // Futuristic alert
            showNotification('Please enter a valid investment amount first.', 'error');
            return false;
        }

        const modal = document.getElementById('confirmModal');
        const content = document.getElementById('modalContent');

        modal.style.display = 'flex';

        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);

        return false;
    }

    function closeModal() {
        const modal = document.getElementById('confirmModal');
        const content = document.getElementById('modalContent');

        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.style.display = 'none';
        }, 500);
    }

    function submitInvestment() {
        closeModal();

        setTimeout(() => {
            showNotification('Processing your investment...', 'success');
            setTimeout(() => {
                document.querySelector('form[action="{{ route('investments.store') }}"]').submit();
            }, 1000);
        }, 500);
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 p-4 rounded-xl text-white font-medium transition-all duration-500 transform translate-x-full ${
            type === 'error' ? 'bg-gradient-to-r from-red-500 to-pink-500' :
            type === 'success' ? 'bg-gradient-to-r from-green-500 to-emerald-500' :
            'bg-gradient-to-r from-blue-500 to-cyan-500'
        }`;

        notification.innerHTML = `
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                ${message}
            </div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);

        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }

    // Add floating particles effect
    document.addEventListener('DOMContentLoaded', function() {
        createFloatingParticles();
    });

    function createFloatingParticles() {
        const particleContainer = document.createElement('div');
        particleContainer.className = 'fixed inset-0 pointer-events-none z-0';
        document.body.appendChild(particleContainer);

        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.className = 'absolute w-1 h-1 bg-cyan-400 rounded-full opacity-30';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animation = `blob ${5 + Math.random() * 10}s infinite linear`;
            particle.style.animationDelay = Math.random() * 5 + 's';
            particleContainer.appendChild(particle);
        }
    }
</script>

@endsection
