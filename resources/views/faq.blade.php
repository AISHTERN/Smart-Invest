@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<style>
    .faq-container {
        background: linear-gradient(135deg, #0f0f23 0%, #1a1a3a 50%, #2d2d5f 100%);
        min-height: 100vh;
        padding: 3rem 1rem;
        position: relative;
        overflow: hidden;
    }

    .faq-title {
        font-size: 3rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
        background: linear-gradient(45deg, #64ffda, #bb86fc, #ffd700);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientShift 3s ease-in-out infinite;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .faq-grid {
        max-width: 800px;
        margin: 0 auto;
    }

    .faq-item {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem 2rem;
        margin-bottom: 1rem;
        transition: 0.3s ease;
        cursor: pointer;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    }

    .faq-item h3 {
        font-size: 1.2rem;
        color: #64ffda;
        margin: 0;
    }

    .faq-item p {
        margin-top: 0.5rem;
        color: #d1d5db;
        display: none;
    }

    .faq-item.active p {
        display: block;
    }
</style>

<div class="faq-container">
    <h1 class="faq-title">Pertanyaan yang Sering Diajukan</h1>

    <div class="faq-grid">
        @foreach ([
            ['Apa itu platform ini?', 'Platform ini adalah tempat Anda bisa melakukan investasi digital dengan mudah dan aman.'],
            ['Apakah dana saya aman?', 'Dana Anda disimpan dengan protokol keamanan tinggi dan diawasi oleh tim profesional.'],
            ['Bagaimana saya bisa memulai investasi?', 'Cukup daftar, verifikasi akun, lalu mulai investasi dari Rp 10.000.'],
            ['Apakah ada biaya tambahan?', 'Tidak, semua biaya telah transparan dan dijelaskan di awal transaksi.'],
            ['Bagaimana saya menarik keuntungan saya?', 'Anda bisa menarik saldo ke rekening kapan saja melalui menu penarikan.'],
        ] as $faq)
            <div class="faq-item" onclick="this.classList.toggle('active')">
                <h3>{{ $faq[0] }}</h3>
                <p>{{ $faq[1] }}</p>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Optional JS if you want one open at a time
    // document.querySelectorAll('.faq-item').forEach(item => {
    //     item.addEventListener('click', () => {
    //         document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));
    //         item.classList.add('active');
    //     });
    // });
</script>
@endsection
