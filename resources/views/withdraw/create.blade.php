@extends('layouts.app')

@section('content')
<div class="flex justify-center min-h-[80vh] bg-[#0f0f23] px-4 py-12">
    <div class="w-full max-w-xl p-8 rounded-2xl shadow-xl bg-[rgba(15,15,35,0.95)] backdrop-blur-lg border border-[rgba(100,255,218,0.2)]">
        <h2 class="mb-6 text-2xl font-semibold text-[#64ffda]">🧾 Form Withdraw</h2>

        {{-- Saldo Saat Ini --}}
        <div class="mb-6">
            <p class="text-sm text-gray-400">Saldo Anda Saat Ini:</p>
            <div class="text-2xl font-bold text-green-400 drop-shadow">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</div>
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

        <form method="POST" action="{{ route('withdraw.store') }}" class="space-y-5">
            @csrf

            {{-- Nominal --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">Jumlah Penarikan</label>
                <input type="number" name="amount" placeholder="Contoh: 100000" required min="10000"
                       class="w-full px-4 py-2 bg-transparent text-white border rounded-lg border-[rgba(100,255,218,0.3)] focus:ring-2 focus:ring-[#64ffda] placeholder-gray-500">
            </div>

            {{-- Jenis Metode --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">Jenis Metode</label>
                <select name="method_type" id="methodType" required onchange="toggleMethodFields()"
                    class="w-full px-4 py-2 bg-[rgba(15,15,35,0.98)] text-white border border-[rgba(100,255,218,0.3)] rounded-lg backdrop-blur-md shadow focus:outline-none focus:ring-2 focus:ring-[#64ffda] appearance-none">
                    <option value="">Pilih Jenis Metode</option>
                    <option value="bank">Transfer Bank</option>
                    <option value="ewallet">E-Wallet</option>
                </select>
            </div>

            {{-- Nama Bank --}}
            <div id="bankField" class="hidden">
                <label class="block mb-1 text-sm text-gray-300">Nama Bank</label>
                <input type="text" name="bank_name"
                       class="w-full px-4 py-2 bg-transparent text-white border rounded-lg border-[rgba(100,255,218,0.3)] focus:ring-2 focus:ring-[#64ffda] placeholder-gray-500">
            </div>

            {{-- Nama E-wallet --}}
            <div id="ewalletField" class="hidden">
                <label class="block mb-1 text-sm text-gray-300">Nama E-Wallet</label>
                <input type="text" name="ewallet_name"
                       class="w-full px-4 py-2 bg-transparent text-white border rounded-lg border-[rgba(100,255,218,0.3)] focus:ring-2 focus:ring-[#64ffda] placeholder-gray-500">
            </div>

            {{-- Nomor Rekening / Akun --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">Nomor Rekening / Akun</label>
                <input type="text" name="account_number" required
                       class="w-full px-4 py-2 bg-transparent text-white border rounded-lg border-[rgba(100,255,218,0.3)] focus:ring-2 focus:ring-[#64ffda] placeholder-gray-500">
            </div>

            {{-- Nama Pemilik --}}
            <div>
                <label class="block mb-1 text-sm text-gray-300">Nama Pemilik Rekening / Akun</label>
                <input type="text" name="account_name" required
                       class="w-full px-4 py-2 bg-transparent text-white border rounded-lg border-[rgba(100,255,218,0.3)] focus:ring-2 focus:ring-[#64ffda] placeholder-gray-500">
            </div>

            <button type="submit"
                    class="w-full px-4 py-2 font-semibold text-[#0f0f23] bg-gradient-to-r from-[#64ffda] to-[#bb86fc] rounded-lg hover:shadow-lg transition-all duration-200">
                Submit Withdraw
            </button>
        </form>
    </div>
</div>

{{-- Script toggle metode --}}
<script>
    function toggleMethodFields() {
        const type = document.getElementById('methodType').value;
        document.getElementById('bankField').classList.add('hidden');
        document.getElementById('ewalletField').classList.add('hidden');

        if (type === 'bank') {
            document.getElementById('bankField').classList.remove('hidden');
        } else if (type === 'ewallet') {
            document.getElementById('ewalletField').classList.remove('hidden');
        }
    }
</script>
@endsection
