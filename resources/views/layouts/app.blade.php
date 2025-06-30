<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="bg-[#0f0f23] text-white min-h-screen antialiased">
        @include('layouts.navigation')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Session Success (default style) -->
        {{-- @if (session('success'))
            <div class="relative px-4 py-3 mx-4 mt-4 text-green-700 bg-green-100 border border-green-400 rounded">
                {{ session('success') }}
            </div>
        @endif --}}

        <!-- Toast Notifikasi Penjualan -->
        @if (session('sell_success'))
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    showToast("{{ session('sell_success') }}");
                });

                function showToast(message) {
                    const toast = document.createElement('div');
                    toast.innerText = message;
                    toast.className = 'fixed top-6 right-6 bg-green-600 text-white font-semibold px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-down';
                    document.body.appendChild(toast);

                    setTimeout(() => {
                        toast.classList.add('animate-fade-out-up');
                        setTimeout(() => toast.remove(), 700);
                    }, 3000);
                }
            </script>

            <style>
                @keyframes fade-in-down {
                    0% { opacity: 0; transform: translateY(-10px); }
                    100% { opacity: 1; transform: translateY(0); }
                }
                @keyframes fade-out-up {
                    0% { opacity: 1; transform: translateY(0); }
                    100% { opacity: 0; transform: translateY(-10px); }
                }
                .animate-fade-in-down {
                    animation: fade-in-down 0.3s ease-out forwards;
                }
                .animate-fade-out-up {
                    animation: fade-out-up 0.4s ease-in forwards;
                }
            </style>
        @endif

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
