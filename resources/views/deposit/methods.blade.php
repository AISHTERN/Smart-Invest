@extends('layouts.app')

@section('content')
<div class="max-w-2xl p-6 mx-auto mt-10 bg-white rounded shadow">
    <h2 class="mb-6 text-2xl font-bold text-gray-800">🪙 Deposit - Pilih Metode Pembayaran</h2>

    <!-- Konfirmasi Jumlah -->
    <div class="mb-6">
        <p class="text-gray-600">Jumlah Deposit:</p>
        <div class="text-3xl font-bold text-indigo-600">
            Rp {{ number_format($amount, 0, ',', '.') }}
        </div>
    </div>

    <!-- Pilihan Metode Pembayaran -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <button onclick="showPayment('bca')" class="p-4 text-center border rounded hover:bg-gray-100">
            <img src="{{ asset('images/bca.png') }}" class="h-10 mx-auto mb-2" alt="SEABANK">
            <p class="font-semibold text-gray-700">SEABANK</p>
        </button>
        <button onclick="showPayment('bni')" class="p-4 text-center border rounded hover:bg-gray-100">
            <img src="{{ asset('images/bni.png') }}" class="h-10 mx-auto mb-2" alt="BNI">
            <p class="font-semibold text-gray-700">BNI</p>
        </button>
        <button onclick="showPayment('qris')" class="p-4 text-center border rounded hover:bg-gray-100">
            <img src="{{ asset('qris.png') }}" class="h-10 mx-auto mb-2" alt="QRIS">
            <p class="font-semibold text-gray-700">QRIS</p>
        </button>
    </div>

    <!-- Detail & Upload Bukti -->
    <form action="{{ route('balance.deposit.proof') }}" method="POST" enctype="multipart/form-data" class="hidden mt-8" id="paymentForm">
        @csrf
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="method" id="methodField">

        <div id="bcaDetail" class="hidden mb-4">
            <h3 class="mb-2 text-lg font-bold text-indigo-600">Transfer ke SEABANK</h3>
            <p>Nomor Rekening: <span class="font-semibold">901176781575</span> a.n Amrullah Valentino Caesar Putra</p>
        </div>

        <div id="bniDetail" class="hidden mb-4">
            <h3 class="mb-2 text-lg font-bold text-orange-600">Transfer ke BNI</h3>
            <p>Nomor Rekening: <span class="font-semibold">1556925120</span> a.n Sdr Amrullah Valentino Caesar Putra</p>
        </div>

        <div id="qrisDetail" class="hidden mb-4 text-center">
            <h3 class="mb-2 text-lg font-bold text-green-600">Bayar dengan QRIS</h3>
            <img src="{{ asset('images/qris-code.png') }}" alt="QR Code" class="h-56 mx-auto">
            <p class="mt-2 text-sm text-gray-600">Scan QR ini menggunakan aplikasi e-wallet Anda</p>
        </div>

        <!-- Upload Bukti -->
        <div class="mb-4">
            <label for="proof" class="block mb-2 font-medium text-gray-700">Upload Bukti Transfer:</label>
            <input type="file" name="proof" id="proof" required
                   class="w-full px-4 py-2 border rounded file:border-none file:bg-indigo-600 file:text-white file:px-4 file:py-2">
            <p class="mt-1 text-sm text-gray-500">Format JPG/PNG, maksimal 2MB.</p>
        </div>

        <!-- Submit -->
        <div class="text-right">
            <button type="submit" class="px-6 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">
                Kirim Bukti Pembayaran
            </button>
        </div>
    </form>
</div>

<script>
    function showPayment(method) {
        // Tampilkan form
        document.getElementById('paymentForm').classList.remove('hidden');
        document.getElementById('methodField').value = method;

        // Sembunyikan semua detail
        ['bcaDetail', 'bniDetail', 'qrisDetail'].forEach(id => {
            document.getElementById(id).classList.add('hidden');
        });

        // Tampilkan detail sesuai metode
        document.getElementById(method + 'Detail').classList.remove('hidden');
    }
</script>
@endsection
