@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * {
        font-family: 'Inter', sans-serif;
    }

    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .floating {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .glow-effect {
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
        transition: all 0.3s ease;
    }

    .glow-effect:hover {
        box-shadow: 0 0 30px rgba(102, 126, 234, 0.5);
        transform: translateY(-2px);
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .neon-border {
        border: 2px solid transparent;
        background: linear-gradient(45deg, #667eea, #764ba2) border-box;
        border-radius: 12px;
    }

    .pulse {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(102, 126, 234, 0); }
        100% { box-shadow: 0 0 0 0 rgba(102, 126, 234, 0); }
    }

    .bg-dark-futuristic {
        background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
    }

    .bg-card-dark {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .text-neon {
        color: #00d4ff;
        text-shadow: 0 0 10px #00d4ff;
    }

    .btn-futuristic {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .btn-futuristic::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-futuristic:hover::before {
        left: 100%;
    }

    .stats-glow {
        background: rgba(0, 212, 255, 0.1);
        border: 1px solid rgba(0, 212, 255, 0.3);
        box-shadow: 0 0 20px rgba(0, 212, 255, 0.2);
    }
</style>

<main class="font-sans text-white bg-dark-futuristic">
    <!-- Hero Section -->
    <section class="relative px-4 py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900/20 via-blue-900/20 to-indigo-900/20"></div>
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute w-64 h-64 bg-blue-500 rounded-full top-1/4 left-1/4 blur-3xl"></div>
            <div class="absolute bg-purple-500 rounded-full bottom-1/4 right-1/4 w-96 h-96 blur-3xl"></div>
        </div>

        <div class="relative flex flex-col items-center justify-between gap-12 mx-auto max-w-7xl md:flex-row">
            <div class="text-left md:w-1/2">
                <h1 class="text-4xl font-bold leading-tight md:text-6xl">
                    <span class="gradient-text">Invest in founders</span><br>
                    <span class="text-white">Building the future</span>
                </h1>
                <p class="mt-6 text-xl leading-relaxed text-gray-300">
                    Increase your money by investing with us in the next generation of innovative startups
                </p>
                <a href="{{ route('register') }}" class="inline-block px-8 py-4 mt-8 text-lg font-semibold text-white btn-futuristic rounded-xl glow-effect">
                    Start Investing Now
                </a>
            </div>
            <div class="flex justify-center md:w-1/2 md:justify-end">
                <div class="floating">
                    <img src="{{ asset('illustration.png') }}" alt="Hero Illustration" class="max-w-xs md:max-w-md lg:max-w-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="relative py-20 text-center">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-blue-900/10 to-transparent"></div>
        <div class="relative">
            <h2 class="mb-4 text-3xl font-bold md:text-4xl">The benefits you will get</h2>
            <p class="mb-16 text-xl text-gray-300">by investing with us</p>

            <div class="grid max-w-6xl grid-cols-1 gap-10 px-4 mx-auto md:grid-cols-3">
                <div class="p-8 bg-card-dark rounded-2xl card-hover">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl">
                        <img src="{{ asset('icon1.png') }}" class="w-8 h-8" alt="Reliable">
                    </div>
                    <h3 class="mb-4 text-xl font-semibold text-neon">Reliable Guarantee</h3>
                    <p class="leading-relaxed text-gray-300">We have been verified as trusted and provide 100% guarantee for all investments</p>
                </div>

                <div class="p-8 bg-card-dark rounded-2xl card-hover">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl">
                        <img src="{{ asset('icon2.png') }}" class="w-8 h-8" alt="Authentic">
                    </div>
                    <h3 class="mb-4 text-xl font-semibold text-neon">Authentic Products</h3>
                    <p class="leading-relaxed text-gray-300">Our investment products are reliable, safe, and thoroughly vetted</p>
                </div>

                <div class="p-8 bg-card-dark rounded-2xl card-hover">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 bg-gradient-to-r from-green-500 to-blue-500 rounded-2xl">
                        <img src="{{ asset('icon3.png') }}" class="w-8 h-8" alt="Famous">
                    </div>
                    <h3 class="mb-4 text-xl font-semibold text-neon">Famous Founders</h3>
                    <p class="leading-relaxed text-gray-300">We provide access to products from high-quality, renowned founders</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Safety Section -->
    <section class="relative py-20">
        <div class="absolute inset-0 bg-gradient-to-l from-blue-900/20 to-purple-900/20"></div>
        <div class="relative flex flex-col items-center max-w-6xl px-4 mx-auto md:flex-row">
            <div class="mb-10 md:w-1/2 md:mb-0">
                <div class="floating">
                    <img src="{{ asset('safety.png') }}" alt="Data Safety Illustration" class="rounded-2xl">
                </div>
            </div>
            <div class="md:w-1/2 md:pl-12">
                <h2 class="mb-6 text-3xl font-bold md:text-4xl">
                    <span class="gradient-text">Keeping private data</span><br>
                    <span class="text-white">safe & secure</span>
                </h2>
                <p class="mb-8 text-lg leading-relaxed text-gray-300">
                    Advanced encryption and security protocols ensure your personal information and investment data remain completely protected at all times.
                </p>
                <a href="#" class="inline-block px-8 py-4 font-semibold text-white btn-futuristic rounded-xl glow-effect">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="relative py-20">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-900/20 to-blue-900/20"></div>
        <div class="relative flex flex-col justify-between max-w-6xl gap-10 px-4 mx-auto md:flex-row md:items-center">
            <div class="md:w-2/5">
                <h2 class="mb-4 text-3xl font-bold md:text-4xl">
                    <span class="gradient-text">Participate</span> with us
                </h2>
                <p class="text-lg text-gray-300">We reached here with our hard work, dedication, and trusted community</p>
            </div>

            <div class="grid grid-cols-2 gap-6 ml-auto md:w-3/5">
                <div class="p-6 stats-glow rounded-2xl card-hover">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl">
                            <img src="{{ asset('iconperson.png') }}" class="w-6 h-6" alt="Person Icon">
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-neon">{{ number_format($totalUsers, 0, ',', '.') }}</div>
                            <div class="text-sm text-gray-400">Active Users</div>
                        </div>
                    </div>
                </div>

                <div class="p-6 stats-glow rounded-2xl card-hover">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl">
                            <img src="{{ asset('iconfounders.png') }}" class="w-6 h-6" alt="Founder Icon">
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-neon">46,328</div>
                            <div class="text-sm text-gray-400">Founders</div>
                        </div>
                    </div>
                </div>

                <div class="p-6 stats-glow rounded-2xl card-hover">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-green-500 to-blue-500 rounded-xl">
                            <img src="{{ asset('iconinvest.png') }}" class="w-6 h-6" alt="Investment Icon">
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-neon">{{ number_format($totalInvest, 0, ',', '.') }}</div>
                            <div class="text-sm text-gray-400">Investments</div>
                        </div>
                    </div>
                </div>

                <div class="p-6 stats-glow rounded-2xl card-hover">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl">
                            <img src="{{ asset('iconpayment.png') }}" class="w-6 h-6" alt="Payment Icon">
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-neon">1,926,436</div>
                            <div class="text-sm text-gray-400">Payments</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 text-center">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/30 via-purple-900/30 to-pink-900/30"></div>
        <div class="relative">
            <h2 class="mb-8 text-4xl font-bold md:text-5xl">
                <span class="gradient-text">Ready to start</span><br>
                <span class="text-white">your investment journey?</span>
            </h2>
            <a href="{{ route('register') }}" class="inline-block px-10 py-5 text-xl font-semibold text-white btn-futuristic rounded-xl glow-effect pulse">
                Join Us Now
            </a>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="relative py-16 bg-gray-900">
    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
    <div class="relative grid max-w-6xl grid-cols-1 gap-10 px-4 mx-auto md:grid-cols-4">
        <div>
            <img src="{{ asset('logo.png') }}" class="h-12 mb-6">
            <p class="mb-2 text-gray-300">&copy; 2025 Smart-Invest</p>
            <p class="mb-6 text-gray-400">All rights reserved</p>
            <div class="flex space-x-4">
                <a href="#" class="flex items-center justify-center w-10 h-10 transition-transform bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl hover:scale-110">
                    <img src="{{ asset('fb.png') }}" class="h-5">
                </a>
                <a href="#" class="flex items-center justify-center w-10 h-10 transition-transform bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl hover:scale-110">
                    <img src="{{ asset('ig.png') }}" class="h-5">
                </a>
                <a href="#" class="flex items-center justify-center w-10 h-10 transition-transform bg-gradient-to-r from-pink-500 to-red-500 rounded-xl hover:scale-110">
                    <img src="{{ asset('wa.png') }}" class="h-5">
                </a>
            </div>
        </div>

        <div>
            <h3 class="mb-4 text-lg font-semibold text-white">Company</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('about') }}" class="text-gray-400 transition-colors hover:text-white">About us</a></li>
                <li><a href="{{ route('faq') }}" class="text-gray-400 transition-colors hover:text-white">FAQ</a></li>
            </ul>
        </div>

        <div>
            <h3 class="mb-4 text-lg font-semibold text-white">Support</h3>
            <ul class="space-y-2">
                <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Help center</a></li>
                <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Terms of service</a></li>
                <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Legal</a></li>
                <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Privacy policy</a></li>
                <li><a href="#" class="text-gray-400 transition-colors hover:text-white">Status</a></li>
            </ul>
        </div>

    </div>
</footer>
@endsection
