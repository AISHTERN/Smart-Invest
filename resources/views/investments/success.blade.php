@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[70vh] px-6 py-12 bg-[#0f0f23]">
    <div class="w-full max-w-md p-8 text-center rounded-xl shadow-lg bg-gradient-to-br from-[#151531] via-[#1a1a3a] to-[#2d2d5f] border border-cyan-300/20 backdrop-blur-lg">
        <img src="{{ asset('success-check.png') }}" alt="Success" class="w-20 mx-auto mb-5 drop-shadow-[0_0_10px_rgba(100,255,218,0.5)]">

        <h2 class="mb-2 text-xl font-bold text-[#64ffda] drop-shadow-[0_0_5px_rgba(100,255,218,0.8)]">
            Investasi Berhasil!
        </h2>

        <p class="mb-6 text-gray-300">
            Terima kasih telah berinvestasi di <strong class="text-white">{{ $investment->title }}</strong>.
        </p>

        <div class="p-4 mb-6 text-sm text-left bg-[#1c1c3a]/60 border border-cyan-300/10 text-gray-200 rounded-md space-y-1">
            <p><span class="font-semibold text-cyan-300">Nama Investasi:</span> {{ $investment->title }}</p>
            <p><span class="font-semibold text-cyan-300">Kategori:</span> {{ $investment->category->name }}</p>
            <p><span class="font-semibold text-cyan-300">Harga per slot:</span> Rp{{ number_format($investment->market_price, 0, ',', '.') }}</p>
        </div>

        <div class="flex justify-center gap-4">
            <a href="{{ route('home') }}" class="px-5 py-2 rounded-full bg-[#64ffda] text-[#0f0f23] font-semibold shadow hover:shadow-xl transition hover:-translate-y-0.5">
                ← Kembali ke Home
            </a>
        </div>
    </div>
</div>
@endsection
