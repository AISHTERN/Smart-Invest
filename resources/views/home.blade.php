@extends('layouts.app')

@section('content')
<div class="relative min-h-screen overflow-hidden font-sans bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="floating-particles"></div>
            <div class="grid-bg"></div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="relative z-10 px-6 py-20">
        <div class="mx-auto text-center max-w-7xl">
            <div class="hero-content">
                <h1 class="mb-6 text-6xl font-bold text-transparent md:text-8xl bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 bg-clip-text animate-glow">
                    Future Invest
                </h1>
                <p class="max-w-3xl mx-auto mb-8 text-xl leading-relaxed text-gray-300 md:text-2xl">
                    Berinvestasi dalam para founder yang membangun masa depan teknologi dan inovasi
                </p>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="relative z-10 px-6 py-16">
        <div class="mx-auto max-w-7xl">
            <h2 class="mb-12 text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400">
                Kategori Investasi
            </h2>
            <div class="category-scroll">
                <div class="category-container">
                    @foreach ($categories as $category)
                        <a href="{{ route('home', ['category' => $category->id]) }}"
                           class="category-item {{ request('category') == $category->id ? 'active' : '' }}">
                            <div class="category-icon-wrapper">
                                <img src="{{ asset('storage/' . $category->icon) }}"
                                     class="category-icon"
                                     alt="{{ $category->name }}">
                                <div class="category-glow"></div>
                            </div>
                            <span class="category-name">{{ $category->name }}</span>
                            <div class="category-hover-effect"></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="relative z-10 px-6 py-8">
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('home') }}" method="GET" class="search-form">
                <div class="search-wrapper">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari investasi masa depan..."
                           class="search-input">
                    <button type="submit" class="search-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                    <div class="search-glow"></div>
                </div>
            </form>
        </div>
    </div>

    <!-- Investment Cards Grid -->
    <div class="relative z-10 px-6 py-16">
        <div class="mx-auto max-w-7xl">
            <h2 class="mb-12 text-3xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-400">
                Peluang Investasi Terbaik
            </h2>
            <div class="investment-grid">
                @foreach ($investments as $inv)
                    <a href="{{ route('investment.show', $inv->id) }}" class="investment-card">
                        <div class="card-image-wrapper">
                            <img src="{{ asset('storage/' . $inv->image) }}"
                                 alt="{{ $inv->title }}"
                                 class="card-image">
                            <div class="image-overlay"></div>
                            @if ($inv->badge)
                                <span class="investment-badge">{{ $inv->badge }}</span>
                            @endif
                        </div>

                        <div class="card-content">
                            <div class="card-header">
                                <h4 class="card-title">{{ $inv->title }}</h4>
                                <p class="card-category">
                                    {{ is_object($inv->category) ? $inv->category->name : $inv->category ?? 'Uncategorized' }}
                                </p>
                            </div>

                            <p class="card-description">
                                {{ \Illuminate\Support\Str::limit($inv->description, 100) }}
                            </p>

                            <div class="card-footer">
                                <span class="invest-now">Investasi Sekarang</span>
                                <svg class="arrow-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="card-glow"></div>
                        <div class="card-border"></div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    /* Animated Background */
    .grid-bg {
        background-image:
            linear-gradient(rgba(100, 255, 218, 0.1) 1px, transparent 1px),
            linear-gradient(90deg, rgba(100, 255, 218, 0.1) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: grid-move 20s linear infinite;
    }

    @keyframes grid-move {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }

    .floating-particles::before,
    .floating-particles::after {
        content: '';
        position: absolute;
        width: 4px;
        height: 4px;
        background: #64ffda;
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .floating-particles::before {
        top: 20%;
        left: 20%;
        animation-delay: 0s;
    }

    .floating-particles::after {
        top: 60%;
        right: 30%;
        animation-delay: 3s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 1; }
        50% { transform: translateY(-20px) rotate(180deg); opacity: 0.5; }
    }

    /* Hero Section */
    .hero-content {
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes glow {
        0%, 100% { text-shadow: 0 0 20px rgba(100, 255, 218, 0.5); }
        50% { text-shadow: 0 0 30px rgba(100, 255, 218, 0.8), 0 0 40px rgba(187, 134, 252, 0.6); }
    }

    .animate-glow {
        animation: glow 3s ease-in-out infinite;
    }

    /* Futuristic Buttons */
    .futuristic-btn {
        position: relative;
        padding: 1rem 2rem;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .primary-btn {
        background: linear-gradient(45deg, #64ffda, #bb86fc);
        color: #0f0f23;
        box-shadow: 0 8px 32px rgba(100, 255, 218, 0.3);
    }

    .secondary-btn {
        background: rgba(100, 255, 218, 0.1);
        color: #64ffda;
        border: 1px solid rgba(100, 255, 218, 0.3);
    }

    .futuristic-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(100, 255, 218, 0.4);
    }

    .btn-glow {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .futuristic-btn:hover .btn-glow {
        left: 100%;
    }

    /* Categories */
    .category-scroll {
        overflow-x: auto;
        padding: 1rem 0;
    }

    .category-container {
        display: flex;
        gap: 2rem;
        min-width: max-content;
        padding: 0 1rem;
    }

    .category-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem;
        border-radius: 20px;
        background: rgba(15, 15, 35, 0.5);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(100, 255, 218, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        min-width: 120px;
        text-decoration: none;
    }

    .category-item:hover,
    .category-item.active {
        transform: translateY(-5px);
        background: rgba(100, 255, 218, 0.1);
        border-color: rgba(100, 255, 218, 0.3);
        box-shadow: 0 10px 30px rgba(100, 255, 218, 0.2);
    }

    .category-icon-wrapper {
        position: relative;
        margin-bottom: 1rem;
    }

    .category-icon {
        width: 3rem;
        height: 3rem;
        filter: drop-shadow(0 0 10px rgba(100, 255, 218, 0.5));
        transition: all 0.3s ease;
    }

    .category-item:hover .category-icon {
        transform: scale(1.1);
        filter: drop-shadow(0 0 15px rgba(100, 255, 218, 0.8));
    }

    .category-name {
        color: #e0e6ed;
        font-size: 0.9rem;
        font-weight: 500;
        text-align: center;
        transition: color 0.3s ease;
    }

    .category-item:hover .category-name,
    .category-item.active .category-name {
        color: #64ffda;
    }

    .category-glow {
        position: absolute;
        inset: -2px;
        background: linear-gradient(45deg, #64ffda, #bb86fc);
        border-radius: 20px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .category-item:hover .category-glow,
    .category-item.active .category-glow {
        opacity: 0.1;
    }

    /* Search */
    .search-wrapper {
        position: relative;
        max-width: 100%;
    }

    .search-input {
        width: 100%;
        padding: 1rem 1.5rem;
        padding-right: 4rem;
        background: rgba(15, 15, 35, 0.5);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(100, 255, 218, 0.2);
        border-radius: 50px;
        color: #e0e6ed;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: rgba(100, 255, 218, 0.5);
        box-shadow: 0 0 20px rgba(100, 255, 218, 0.2);
    }

    .search-input::placeholder {
        color: #a0a6b0;
    }

    .search-btn {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(45deg, #64ffda, #bb86fc);
        color: #0f0f23;
        border: none;
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 5px 15px rgba(100, 255, 218, 0.3);
    }

    /* Investment Cards */
    .investment-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2rem;
        padding: 1rem 0;
    }

    .investment-card {
        position: relative;
        display: flex;
        flex-direction: column;
        background: rgba(15, 15, 35, 0.5);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(100, 255, 218, 0.1);
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        height: 480px;
    }

    .investment-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(100, 255, 218, 0.2);
        border-color: rgba(100, 255, 218, 0.3);
    }

    .card-image-wrapper {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .investment-card:hover .card-image {
        transform: scale(1.1);
    }

    .image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 15, 35, 0.8), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .investment-card:hover .image-overlay {
        opacity: 1;
    }

    .investment-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: linear-gradient(45deg, #ff4757, #ff6b7a);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(255, 71, 87, 0.3);
    }

    .card-content {
        flex: 1;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        color: #e0e6ed;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .card-category {
        color: #64ffda;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .card-description {
        color: #a0a6b0;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid rgba(100, 255, 218, 0.1);
    }

    .invest-now {
        color: #64ffda;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .arrow-icon {
        width: 1.5rem;
        height: 1.5rem;
        color: #64ffda;
        transition: transform 0.3s ease;
    }

    .investment-card:hover .arrow-icon {
        transform: translateX(5px);
    }

    .card-glow {
        position: absolute;
        inset: -1px;
        background: linear-gradient(45deg, #64ffda, #bb86fc, #64ffda);
        border-radius: 24px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .investment-card:hover .card-glow {
        opacity: 0.1;
    }

    .card-border {
        position: absolute;
        inset: 0;
        border-radius: 24px;
        background: linear-gradient(45deg, transparent, rgba(100, 255, 218, 0.1), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .investment-card:hover .card-border {
        opacity: 1;
    }

    /* Scrollbar Styling */
    .category-scroll::-webkit-scrollbar {
        height: 6px;
    }

    .category-scroll::-webkit-scrollbar-track {
        background: rgba(100, 255, 218, 0.1);
        border-radius: 10px;
    }

    .category-scroll::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #64ffda, #bb86fc);
        border-radius: 10px;
    }

    .category-scroll::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #bb86fc, #64ffda);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .text-6xl { font-size: 3rem; }
        .text-8xl { font-size: 4rem; }
        .investment-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        .category-container {
            gap: 1rem;
        }
        .category-item {
            min-width: 100px;
            padding: 1rem;
        }
    }

    @media (max-width: 640px) {
        .futuristic-btn {
            padding: 0.8rem 1.5rem;
            font-size: 0.9rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add intersection observer for animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        // Observe investment cards
        document.querySelectorAll('.investment-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });

        // Add smooth hover effects
        document.querySelectorAll('.investment-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    });
</script>
@endsection
