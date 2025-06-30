@php
    use App\Models\Notification;
    $notifCount = auth()->check() ? Notification::where('user_id', auth()->id())->where('is_read', false)->count() : 0;
    $notifs = auth()->check() ? Notification::where('user_id', auth()->id())->latest()->take(5)->get() : collect([]);
@endphp

<style>
    /* Futuristic Navbar Styles */
    .futuristic-nav {
        background: linear-gradient(135deg, rgba(15, 15, 35, 0.95) 0%, rgba(26, 26, 58, 0.95) 50%, rgba(45, 45, 95, 0.95) 100%);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(100, 255, 218, 0.2);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: visible;
        z-index: 1000;
    }

    .futuristic-nav::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #64ffda, transparent);
        animation: scanline 3s ease-in-out infinite;
    }

    @keyframes scanline {
        0%, 100% { opacity: 0; }
        50% { opacity: 1; }
    }

    /* Logo Styling */
    .futuristic-logo {
        display: flex;
        align-items: center;
        z-index: 10;
        position: relative;
    }

    .futuristic-logo a {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .futuristic-logo img {
        width: 2rem;
        height: 2rem;
        filter: drop-shadow(0 0 10px rgba(100, 255, 218, 0.5));
        transition: all 0.3s ease;
    }

    .futuristic-logo a:hover img {
        filter: drop-shadow(0 0 15px rgba(100, 255, 218, 0.8));
        transform: scale(1.05);
    }

    .logo-text {
        font-size: 1.25rem;
        font-weight: 700;
        background: linear-gradient(45deg, #64ffda, #bb86fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-left: 0.5rem;
        text-shadow: 0 0 20px rgba(100, 255, 218, 0.3);
    }

    /* Navigation Links */
    .nav-links {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 1.5rem;
        z-index: 10;
        position: relative;
    }

    .nav-links li {
        position: relative;
    }

    .nav-link {
        color: #e0e6ed;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        padding: 0.6rem 1.2rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        z-index: 1;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(100, 255, 218, 0.1), transparent);
        transition: left 0.5s ease;
        z-index: -1;
    }

    .nav-link:hover::before {
        left: 100%;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #64ffda;
        background: rgba(100, 255, 218, 0.1);
        border: 1px solid rgba(100, 255, 218, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(100, 255, 218, 0.2);
    }

    /* Auth Links */
    .auth-links {
        display: flex;
        align-items: center;
        gap: 1rem;
        z-index: 10;
        position: relative;
    }

    .auth-link {
        color: #e0e6ed;
        text-decoration: none;
        font-weight: 600;
        padding: 0.6rem 1.2rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        display: inline-block;
    }

    .auth-link:hover {
        color: #64ffda;
        text-shadow: 0 0 10px rgba(100, 255, 218, 0.5);
        transform: translateY(-1px);
    }

    .signup-btn {
        background: linear-gradient(45deg, #64ffda, #bb86fc);
        color: #0f0f23 !important;
        font-weight: 600;
        padding: 0.7rem 1.5rem;
        border-radius: 25px;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        display: inline-block;
    }

    .signup-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.3s ease;
        z-index: -1;
    }

    .signup-btn:hover::before {
        width: 200px;
        height: 200px;
    }

    .signup-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 255, 218, 0.3);
    }

    /* Balance Display */
    .balance-display {
        display: flex;
        align-items: center;
        padding: 0.6rem 1.2rem;
        background: rgba(100, 255, 218, 0.1);
        border: 1px solid rgba(100, 255, 218, 0.3);
        border-radius: 25px;
        color: #64ffda;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .balance-display:hover {
        background: rgba(100, 255, 218, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(100, 255, 218, 0.2);
        color: #64ffda;
    }

    .balance-icon {
        width: 1.25rem;
        height: 1.25rem;
        margin-right: 0.5rem;
        filter: drop-shadow(0 0 5px rgba(100, 255, 218, 0.5));
    }

    /* Notification Bell */
    .notif-container {
        position: relative;
        display: inline-block;
    }

    .notif-btn {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.6rem;
        border-radius: 50%;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .notif-btn:hover {
        background: rgba(100, 255, 218, 0.1);
        transform: scale(1.05);
    }

    .notif-icon {
        width: 1.5rem;
        height: 1.5rem;
        filter: drop-shadow(0 0 5px rgba(100, 255, 218, 0.5));
    }

    .notif-badge {
        position: absolute;
        top: 0.2rem;
        right: 0.2rem;
        width: 0.6rem;
        height: 0.6rem;
        background: #ff4757;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.2); opacity: 0.8; }
    }

    /* Avatar */
    .avatar-container {
        z-index: 10000;
        position: relative;
        display: inline-block;
    }

    .avatar-btn {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        border: 2px solid rgba(100, 255, 218, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
        display: block;
    }

    .avatar-btn:hover {
        border-color: #64ffda;
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(100, 255, 218, 0.3);
    }

    /* Dropdown Styles - Fixed positioning and z-index */
    .futuristic-dropdown {
        position: absolute;
        right: 0;
        top: calc(100% + 0.5rem);
        min-width: 16rem;
        background: rgba(15, 15, 35, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(100, 255, 218, 0.2);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8);
        z-index: 10001;
        overflow: hidden;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px) scale(0.95);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        pointer-events: none;
    }

    .futuristic-dropdown.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    .dropdown-header {
        padding: 0.75rem 1rem;
        font-weight: 600;
        color: #64ffda;
        border-bottom: 1px solid rgba(100, 255, 218, 0.1);
        background: rgba(100, 255, 218, 0.05);
        font-size: 0.9rem;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .dropdown-item {
        display: block;
        padding: 0.75rem 1rem;
        color: #e0e6ed;
        text-decoration: none;
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(100, 255, 218, 0.05);
        font-size: 0.9rem;
        cursor: pointer;
        background: none;
        border-left: none;
        border-right: none;
        border-top: none;
        width: 100%;
        text-align: left;
        font-family: inherit;
    }

    .dropdown-item:hover {
        background: rgba(100, 255, 218, 0.1);
        color: #64ffda;
        transform: translateX(5px);
    }

    .dropdown-item span {
        margin-right: 0.5rem;
    }

    /* Notification specific styles */
    .notif-dropdown-container {
        max-height: 16rem;
        overflow-y: auto;
        overflow-x: hidden;
        -webkit-overflow-scrolling: touch;
    }

    .notif-item {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid rgba(100, 255, 218, 0.05);
        transition: all 0.3s ease;
        cursor: pointer;
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .notif-item:hover {
        background: rgba(100, 255, 218, 0.1);
        color: #64ffda;
    }

    .notif-item:last-child {
        border-bottom: none;
    }

    .notif-title {
        font-weight: 600;
        color: #e0e6ed;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
        pointer-events: none;
    }

    .notif-message {
        color: #a0a6b0;
        font-size: 0.8rem;
        line-height: 1.4;
        pointer-events: none;
    }

    .notif-footer {
        border-top: 1px solid rgba(100, 255, 218, 0.1);
        background: rgba(100, 255, 218, 0.02);
    }

    .notif-footer .dropdown-item {
        color: #64ffda;
        font-size: 0.8rem;
        text-align: center;
        border-bottom: none;
        font-weight: 600;
        text-decoration: none;
    }

    .notif-footer .dropdown-item:hover {
        background: rgba(100, 255, 218, 0.1);
        transform: none;
        color: #64ffda;
    }

    /* Mobile Menu Button */
    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        color: #e0e6ed;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .mobile-menu-btn:hover {
        background: rgba(100, 255, 218, 0.1);
        color: #64ffda;
    }

    /* Container */
    .nav-container {
        max-width: 80rem;
        margin: 0 auto;
        padding: 0 1rem;
        position: relative;
    }

    .nav-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 4rem;
        position: relative;
        z-index: 10;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
        }

        .mobile-menu-btn {
            display: block;
        }

        .auth-links {
            gap: 0.5rem;
        }

        .auth-links > * {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }

        .futuristic-dropdown {
            min-width: 14rem;
        }
    }

    /* Scrollbar styling */
    .notif-dropdown-container::-webkit-scrollbar {
        width: 4px;
    }

    .notif-dropdown-container::-webkit-scrollbar-track {
        background: rgba(100, 255, 218, 0.1);
        border-radius: 2px;
    }

    .notif-dropdown-container::-webkit-scrollbar-thumb {
        background: rgba(100, 255, 218, 0.3);
        border-radius: 2px;
    }

    .notif-dropdown-container::-webkit-scrollbar-thumb:hover {
        background: rgba(100, 255, 218, 0.5);
    }

    /* Add overlay for better dropdown visibility */
    .dropdown-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: transparent;
        z-index: 10000;
        display: none;
    }

    .dropdown-overlay.show {
        display: block;
    }
</style>

<nav class="futuristic-nav">
    <div class="nav-container">
        <div class="nav-content">
            {{-- Logo --}}
            <div class="futuristic-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('logo.png') }}" alt="Logo">
                    <span class="logo-text">Smart-Invest</span>
                </a>
            </div>

            {{-- Navigation Links --}}
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="nav-link {{ Request::is('/') || Request::is('home') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('about') }}" class="nav-link {{ Request::is('about') ? 'active' : '' }}">About</a></li>
                <li><a href="{{ route('faq') }}" class="nav-link">FAQ</a></li>
            </ul>

            {{-- Mobile Menu Button --}}
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                ☰
            </button>

            {{-- Auth Links --}}
            <div class="flex items-center space-x-4 text-sm">
                @guest
                    <a href="{{ route('login') }}" class="font-semibold text-white hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 font-semibold text-white bg-indigo-500 rounded hover:bg-indigo-600">Sign Up</a>
                @endguest

                @auth
                    {{-- Balance Display --}}
                    <a href="{{ route('balance.index') }}" class="balance-display">
                        <svg xmlns="http://www.w3.org/2000/svg" class="balance-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a4 4 0 00-8 0v2H5a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2h-2z"/>
                        </svg>
                        Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}
                    </a>

            @auth
            {{-- Notifikasi Bell --}}
            <div class="notif-container">
                <button onclick="toggleNotif()" class="relative focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="notif-icon" viewBox="0 0 24 24">
                                <path fill="#64ffda" d="M21 19v1H3v-1l2-2v-6c0-3.1 2.03-5.83 5-6.71V4a2 2 0 0 1 2-2a2 2 0 0 1 2 2v.29c2.97.88 5 3.61 5 6.71v6zm-7 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2"></path>
                            </svg>
                    @if($notifCount > 0)
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-600 rounded-full"></span>
                    @endif
                </button>

                {{-- Dropdown isi notifikasi --}}
                <div id="notifDropdown" class="absolute right-0 z-50 hidden w-64 mt-2 overflow-y-auto border rounded shadow-lg bg-emerald-600 max-h-64">
                    <div class="bg-[rgba(15,15,35,0.98)] p-2 text-sm font-semibold text-white border-b">Notifikasi</div>
                    @forelse($notifs as $notif)
                        <div class="px-4 py-2 text-sm text-white border-b bg-[rgba(15,15,35,0.98)]">
                            <div class="font-medium">{{ $notif->title }}</div>
                            <div class="text-xs text-white">{{ $notif->message }}</div>
                        </div>
                    @empty
                        <div class="px-4 py-2 text-sm text-center text-gray-500">Tidak ada notifikasi</div>
                    @endforelse
                    <div class="px-4 py-2 text-xs text-center text-white bg-[rgba(15,15,35,0.98)]">
                        <a href="{{ route('notifications.markAllRead') }}">Baca Semua</a>
                    </div>
                </div>
            </div>

                {{-- Script dropdown --}}
                <script>
                    function toggleNotif() {
                        const dropdown = document.getElementById('notifDropdown');
                        dropdown.classList.toggle('hidden');
                    }

                    window.addEventListener('click', function (e) {
                        const button = document.querySelector('button[onclick="toggleNotif()"]');
                        const dropdown = document.getElementById('notifDropdown');
                        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                            dropdown.classList.add('hidden');
                        }
                    });
                </script>
            @endauth

                    {{-- Avatar --}}
                    <div class="avatar-container">
                        <button onclick="toggleDropdown()" class="focus:outline-none">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->full_name ?? Auth::user()->name) }}&background=64ffda&color=0f0f23"
                             class="avatar-btn" alt="Avatar" id="avatarBtn">
                        </button>

                        <div id="profileDropdown"
                             class="absolute right-0 z-50 hidden w-48 mt-2 bg-[rgba(15,15,35,0.98)] border rounded shadow-lg">
                            <a href="{{ route('user.assets') }}"
                               class="block px-4 py-2 text-white hover:bg-cyan-600">Lihat Aset</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full px-4 py-2 text-left text-white hover:bg-cyan-600">Logout</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- Script Toggle Dropdown --}}
<script>
    function toggleDropdown() {
        document.getElementById('profileDropdown').classList.toggle('hidden');
    }

    function toggleNotif() {
        document.getElementById('notifDropdown').classList.toggle('hidden');
    }

    window.addEventListener('click', function (e) {
        const profileBtn = document.querySelector('button[onclick="toggleDropdown()"]');
        const notifBtn = document.querySelector('button[onclick="toggleNotif()"]');
        const profileDropdown = document.getElementById('profileDropdown');
        const notifDropdown = document.getElementById('notifDropdown');

        if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
            profileDropdown.classList.add('hidden');
        }

        if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });
</script>
