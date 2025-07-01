@extends('layouts.app')

@section('content')
<div class="max-w-3xl p-8 mx-auto mt-10 rounded-xl shadow-xl bg-gradient-to-b from-[#0f172a] to-[#1e293b] border border-[#334155] text-gray-200">

    {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('balance.index') }}"
           class="inline-flex items-center px-4 py-2 text-sm font-medium text-[#64ffda] border border-[#64ffda] rounded hover:bg-[#64ffda]/10 transition-all duration-200">
            ← Kembali ke Saldo
        </a>
    </div>

    <h2 class="mb-6 text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-green-400 drop-shadow">
        🪙 Deposit - Pilih Metode Pembayaran
    </h2>

    <!-- Konfirmasi Jumlah -->
    <div class="mb-8">
        <p class="text-[#94a3b8]">Jumlah Deposit:</p>
        <div class="text-4xl font-bold text-[#64ffda]">
            Rp {{ number_format($amount, 0, ',', '.') }}
        </div>
    </div>

    <!-- Pilihan Metode Pembayaran -->
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
        <button onclick="showPayment('bca')" class="p-4 text-center bg-[#0f172a] border border-[#334155] rounded-lg hover:bg-[#1e293b] transition">
            <img src="{{ asset('seabank.png') }}" class="h-10 mx-auto mb-2" alt="SEABANK">
            <p class="font-semibold text-[#64ffda]">SEABANK</p>
        </button>
        <button onclick="showPayment('bni')" class="p-4 text-center bg-[#0f172a] border border-[#334155] rounded-lg hover:bg-[#1e293b] transition">
            <img src="{{ asset('bni.png') }}" class="h-10 mx-auto mb-2" alt="BNI">
            <p class="font-semibold text-[#f59e0b]">BNI</p>
        </button>
        <button onclick="showPayment('qris')" class="p-4 text-center bg-[#0f172a] border border-[#334155] rounded-lg hover:bg-[#1e293b] transition">
            <img src="{{ asset('qris.png') }}" class="h-10 mx-auto mb-2" alt="QRIS">
            <p class="font-semibold text-[#34d399]">QRIS</p>
        </button>
    </div>

    <!-- Detail & Upload Bukti -->
    <form action="{{ route('balance.deposit.proof') }}" method="POST" enctype="multipart/form-data" class="hidden mt-8" id="paymentForm">
        @csrf
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="method" id="methodField">

        <div id="bcaDetail" class="hidden mb-4">
            <h3 class="mb-2 text-lg font-bold text-[#64ffda]">Transfer ke SEABANK</h3>
            <p class="text-gray-300">No Rek: <span class="font-semibold text-white">901176781575</span><br>a.n Amrullah Valentino Caesar Putra</p>
        </div>

        <div id="bniDetail" class="hidden mb-4">
            <h3 class="mb-2 text-lg font-bold text-[#f59e0b]">Transfer ke BNI</h3>
            <p class="text-gray-300">No Rek: <span class="font-semibold text-white">1556925120</span><br>a.n Amrullah Valentino Caesar Putra</p>
        </div>

        <div id="qrisDetail" class="hidden mb-4 text-center">
            <h3 class="mb-2 text-lg font-bold text-[#34d399]">Bayar dengan QRIS</h3>
            <img src="{{ asset('images/qris-code.png') }}" alt="QR Code" class="h-56 mx-auto rounded-lg shadow-lg">
            <p class="mt-2 text-sm text-gray-400">Scan QR ini dengan e-wallet Anda</p>
        </div>

        <!-- Upload Bukti -->
        <div class="mb-4">
            <label for="proof" class="block mb-2 font-medium text-[#94a3b8]">Upload Bukti Transfer:</label>
            <input type="file" name="proof" id="proof" required
                   class="w-full px-4 py-2 bg-[#0f172a] border border-[#334155] rounded text-white file:bg-[#64ffda] file:text-black file:border-none file:px-4 file:py-2 file:rounded cursor-pointer">
            <p class="mt-1 text-sm text-gray-500">Format JPG/PNG, maksimal 2MB.</p>
        </div>

        <!-- Submit -->
        <div class="text-right">
            <button type="submit"
                    class="px-6 py-2 text-sm font-semibold text-black transition rounded bg-[#64ffda] hover:bg-[#3ceabb]">
                Kirim Bukti Pembayaran
            </button>
        </div>
    </form>
</div>

<script>
    function showPayment(method) {
        document.getElementById('paymentForm').classList.remove('hidden');
        document.getElementById('methodField').value = method;

        ['bcaDetail', 'bniDetail', 'qrisDetail'].forEach(id => {
            document.getElementById(id).classList.add('hidden');
        });

        document.getElementById(method + 'Detail').classList.remove('hidden');
    }
</script>
@endsection
