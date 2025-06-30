@extends('layouts.app')

@section('content')
<div class="flex justify-center min-h-[80vh] bg-[#0f0f23] px-4 py-12">
    <div class="w-full max-w-xl p-8 rounded-2xl shadow-xl bg-[rgba(15,15,35,0.95)] backdrop-blur-lg border border-[rgba(100,255,218,0.2)]">
        <h2 class="mb-6 text-2xl font-semibold text-[#64ffda]">💰 Kelola Saldo</h2>

        <div class="mb-8">
            <p class="mb-1 text-gray-300">Saldo Anda Saat Ini:</p>
            <div class="text-3xl font-bold text-green-400 drop-shadow">Rp {{ number_format($user->balance, 0, ',', '.') }}</div>
        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="p-3 mb-4 text-green-300 border rounded shadow-sm bg-green-800/30 border-green-400/30">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-3 mb-4 text-red-300 border rounded shadow-sm bg-red-800/30 border-red-400/30">
                {{ session('error') }}
            </div>
        @endif

        {{-- Deposit --}}
        <form method="GET" action="{{ route('deposit.methods') }}" class="mb-8">
            <label class="block mb-2 font-medium text-gray-300">Deposit (min Rp 10.000):</label>
            <input type="number" name="amount" min="10000"
                   class="w-full px-4 py-2 mb-3 bg-transparent border rounded-lg text-white border-[rgba(100,255,218,0.3)] focus:ring-2 focus:ring-[#64ffda] placeholder-gray-500"
                   placeholder="Masukkan jumlah..." required>
            <button type="submit"
                    class="w-full px-4 py-2 font-semibold text-[#0f0f23] bg-gradient-to-r from-[#64ffda] to-[#bb86fc] rounded-lg hover:shadow-lg transition-all duration-200">
                Deposit
            </button>
        </form>

        {{-- Withdraw --}}
        <div>
            <label class="block mb-2 font-medium text-gray-300">Withdraw (min Rp 10.000):</label>
            <a href="{{ route('withdraw.create') }}"
               class="inline-block w-full px-4 py-2 mt-1 text-center font-semibold text-[#0f0f23] bg-yellow-300 rounded-lg hover:shadow-md transition-all duration-200">
                Ajukan Withdraw
            </a>
        </div>
    </div>
</div>
@endsection
