@extends('layouts.app')

@section('content')
<div class="px-6 py-10 mx-auto text-white max-w-7xl">
    <div class="flex flex-col items-start justify-between gap-4 mb-8 md:flex-row md:items-center">
        <h1 class="text-3xl font-bold text-teal-400">📊 Aset Investasi Saya</h1>

        <!-- Dropdown Filter -->
        <form method="GET" class="w-full md:w-auto">
            <select name="category" onchange="this.form.submit()"
                    class="px-4 py-2 text-white bg-[rgba(15,15,35,0.98)] border border-[rgba(100,255,218,0.3)] rounded-lg backdrop-blur-md shadow appearance-none focus:outline-none focus:ring-2 focus:ring-[#64ffda]">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Statistik Total Investasi -->
    <div class="mb-10">
        <div class="p-6 text-center border border-[rgba(100,255,218,0.3)] rounded-xl bg-[rgba(25,25,45,0.7)] backdrop-blur-md shadow-md">
            <p class="text-sm font-medium text-teal-300">Total Investasi (Modal)</p>
            <h2 class="text-3xl font-bold text-[#64ffda]">Rp{{ number_format($totalInvested, 0, ',', '.') }}</h2>
        </div>
    </div>

    <!-- Kartu Aset -->
    @if($transactions->isEmpty())
        <div class="p-6 text-yellow-300 bg-[rgba(60,60,0,0.3)] border border-yellow-600 rounded-lg shadow">
            Anda belum memiliki investasi aktif. Yuk, mulai investasikan dan kembangkan asetmu! 🚀
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($transactions as $transaction)
                @php
                    $purchasePrice = $transaction->purchase_price;
                    $currentPrice  = $transaction->investment->market_price;

                    $totalUnits    = $purchasePrice > 0 ? $transaction->amount / $purchasePrice : 0;
                    $currentValue  = $totalUnits * $currentPrice;

                    $growth        = $currentValue - $transaction->amount;
                    $growthPercent = $transaction->amount > 0 ? ($growth / $transaction->amount) * 100 : 0;
                @endphp

                <a href="{{ route('investment.show', $transaction->investment->id) }}"
                   class="block transition duration-300 border border-[rgba(100,255,218,0.2)] bg-[rgba(15,15,30,0.85)] rounded-2xl shadow hover:shadow-lg hover:border-[#64ffda]">
                    <img src="{{ asset('storage/' . $transaction->investment->image) }}" alt="Gambar Investasi"
                         class="object-cover w-full h-40 rounded-t-2xl">

                    <div class="p-5 space-y-2">
                        <h2 class="text-lg font-semibold text-white">{{ $transaction->investment->title }}</h2>
                        <p class="text-sm text-gray-400">Kategori:
                            <span class="font-medium text-[#64ffda]">{{ $transaction->investment->category->name }}</span>
                        </p>
                        <p class="text-sm text-gray-500">Tanggal: {{ $transaction->created_at->format('d M Y') }}</p>

                        <div class="mt-3">
                            <div class="flex items-center justify-between text-sm text-gray-400">
                                <span>Harga Beli:</span>
                                <span class="font-medium text-white">Rp{{ number_format($purchasePrice, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-400">
                                <span>Harga Saat Ini:</span>
                                <span class="font-medium text-white">Rp{{ number_format($currentPrice, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-400">
                                <span>Pertumbuhan:</span>
                                <span class="font-bold {{ $growth >= 0 ? 'text-green-400' : 'text-red-500' }}">
                                    {{ $growth >= 0 ? '+' : '-' }}{{ number_format(abs($growthPercent), 2) }}%
                                </span>
                            </div>
                        </div>

                        <div class="mt-4 space-y-1">
                            <div class="text-xs text-gray-500">Total Modal</div>
                            <div class="text-lg font-bold text-blue-400">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</div>

                            <div class="text-xs text-gray-500">Nilai Saat Ini</div>
                            <div class="text-lg font-bold text-green-400">Rp{{ number_format($currentValue, 0, ',', '.') }}</div>

                            <div class="text-xs text-gray-500">Keuntungan / Rugi</div>
                            <div class="text-sm font-semibold {{ $growth >= 0 ? 'text-green-400' : 'text-red-400' }}">
                                {{ $growth >= 0 ? '+' : '-' }}Rp{{ number_format(abs($growth), 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
