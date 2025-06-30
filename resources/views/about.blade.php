@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<style>
    /* Custom Futuristic Styles */
    .futuristic-container {
        background: linear-gradient(135deg, #0f0f23 0%, #1a1a3a 50%, #2d2d5f 100%);
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    /* Animated Background */
    .bg-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .particle {
        position: absolute;
        background: rgba(100, 255, 218, 0.1);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 0.3;
        }
        50% {
            transform: translateY(-30px) rotate(180deg);
            opacity: 0.8;
        }
    }

    /* Grid Lines Background */
    .grid-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image:
            linear-gradient(rgba(100, 255, 218, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(100, 255, 218, 0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        z-index: 1;
    }

    /* Main Content Wrapper */
    .content-wrapper {
        position: relative;
        z-index: 10;
        padding: 3rem 1rem;
    }

    /* Title Styling */
    .futuristic-title {
        font-size: 3.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 1.5rem;
        background: linear-gradient(45deg, #64ffda, #bb86fc, #ffd700);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientShift 3s ease-in-out infinite;
        text-shadow: 0 0 30px rgba(100, 255, 218, 0.3);
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Subtitle */
    .futuristic-subtitle {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 4rem;
        font-size: 1.25rem;
        line-height: 1.8;
        color: #a0a6b0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Glass Cards */
    .glass-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2rem;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }

    .glass-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(100, 255, 218, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .glass-card:hover::before {
        left: 100%;
    }

    .glass-card:hover {
        transform: translateY(-10px) scale(1.02);
        border-color: rgba(100, 255, 218, 0.3);
        box-shadow:
            0 20px 60px rgba(100, 255, 218, 0.15),
            0 0 30px rgba(100, 255, 218, 0.1);
    }

    /* Card Content */
    .card-content {
        position: relative;
        z-index: 2;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #64ffda;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .card-text {
        color: #c9d1d9;
        line-height: 1.7;
        font-size: 1rem;
    }

    /* Icon Styling */
    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(45deg, #64ffda, #bb86fc);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        color: #0f0f23;
        font-weight: bold;
        box-shadow: 0 4px 20px rgba(100, 255, 218, 0.3);
    }

    /* CTA Button */
    .futuristic-btn {
        display: inline-block;
        padding: 1rem 2.5rem;
        background: linear-gradient(45deg, #64ffda, #bb86fc);
        color: #0f0f23;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(100, 255, 218, 0.3);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .futuristic-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.4s ease;
    }

    .futuristic-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .futuristic-btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 15px 35px rgba(100, 255, 218, 0.4);
        color: #0f0f23;
    }

    /* Responsive Grid */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin: 3rem 0;
    }

    /* Additional Decorative Elements */
    .floating-element {
        position: absolute;
        width: 200px;
        height: 200px;
        border: 2px solid rgba(100, 255, 218, 0.1);
        border-radius: 50%;
        animation: rotate 20s linear infinite;
    }

    .floating-element::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50%;
        height: 50%;
        border: 1px solid rgba(187, 134, 252, 0.1);
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .floating-element-1 {
        top: 10%;
        right: 5%;
        animation-duration: 25s;
    }

    .floating-element-2 {
        bottom: 15%;
        left: 8%;
        animation-duration: 30s;
        animation-direction: reverse;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .futuristic-title {
            font-size: 2.5rem;
        }

        .futuristic-subtitle {
            font-size: 1.1rem;
        }

        .cards-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .glass-card {
            padding: 1.5rem;
        }
    }

    /* Scroll Animation */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

@section('content')
<div class="futuristic-container">
    <!-- Animated Background -->
    <div class="bg-particles" id="particles"></div>
    <div class="grid-bg"></div>

    <!-- Floating Decorative Elements -->
    <div class="floating-element floating-element-1"></div>
    <div class="floating-element floating-element-2"></div>

    <div class="content-wrapper">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="fade-in">
                <h1 class="futuristic-title">Tentang Kami</h1>
                <p class="futuristic-subtitle">
                    Kami adalah platform investasi digital yang bertujuan untuk membuka akses investasi yang lebih adil dan transparan bagi semua orang. Dengan pendekatan teknologi modern, kami menghadirkan produk investasi yang mudah dipahami, aman, dan menguntungkan.
                </p>
            </div>

            <!-- Cards Grid -->
            <div class="cards-grid">
                <div class="glass-card fade-in">
                    <div class="card-content">
                        <div class="card-icon">🎯</div>
                        <h3 class="card-title">Visi Kami</h3>
                        <p class="card-text">
                            Membuka akses seluas-luasnya bagi masyarakat untuk berinvestasi secara cerdas, aman, dan transparan. Kami percaya bahwa setiap orang berhak mendapatkan kesempatan untuk membangun masa depan finansial yang lebih baik.
                        </p>
                    </div>
                </div>

                <div class="glass-card fade-in">
                    <div class="card-content">
                        <div class="card-icon">🚀</div>
                        <h3 class="card-title">Misi Kami</h3>
                        <p class="card-text">
                            Memberikan edukasi dan layanan investasi berkualitas tinggi dengan teknologi yang mudah digunakan. Kami berkomitmen untuk menyediakan platform yang inovatif dan terpercaya.
                        </p>
                    </div>
                </div>

                <div class="glass-card fade-in">
                    <div class="card-content">
                        <div class="card-icon">⭐</div>
                        <h3 class="card-title">Keunggulan Kami</h3>
                        <p class="card-text">
                            Transparansi data, kemudahan penggunaan, dan dukungan penuh bagi investor pemula hingga profesional. Dengan teknologi AI dan machine learning, kami memberikan insights yang akurat.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-16 text-center fade-in">
                <h2 style="color: #fff; font-size: 2rem; margin-bottom: 1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                    Siap Memulai Perjalanan Investasi Anda?
                </h2>
                <p style="color: #a0a6b0; margin-bottom: 2rem; font-size: 1.1rem;">
                    Bergabunglah dengan ribuan investor yang telah merasakan kemudahan platform kami
                </p>
                <a href="{{ route('home') }}" class="futuristic-btn">
                    Mulai Investasi Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Create floating particles
    function createParticles() {
        const container = document.getElementById('particles');
        const particleCount = 30;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.width = (Math.random() * 4 + 2) + 'px';
            particle.style.height = particle.style.width;
            particle.style.animationDelay = Math.random() * 8 + 's';
            particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
            container.appendChild(particle);
        }
    }

    // Scroll animation
    function animateOnScroll() {
        const elements = document.querySelectorAll('.fade-in');

        elements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add('visible');
            }, index * 200);
        });
    }

    // Mouse move parallax effect
    document.addEventListener('mousemove', function(e) {
        const particles = document.querySelectorAll('.particle');
        const floatingElements = document.querySelectorAll('.floating-element');
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;

        particles.forEach((particle, index) => {
            const speed = (index + 1) * 0.3;
            const moveX = (x - 0.5) * speed;
            const moveY = (y - 0.5) * speed;
            particle.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });

        floatingElements.forEach((element, index) => {
            const speed = (index + 1) * 0.1;
            const moveX = (x - 0.5) * speed * 10;
            const moveY = (y - 0.5) * speed * 10;
            element.style.transform = `translate(${moveX}px, ${moveY}px) rotate(${element.style.transform.match(/rotate\([^)]*\)/)?.[0] || '0deg'})`;
        });
    });

    // Initialize
    createParticles();
    animateOnScroll();
});
</script>
@endsection
