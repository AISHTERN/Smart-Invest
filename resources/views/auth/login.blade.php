<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex w-full max-w-6xl h-[520px] rounded-xl overflow-hidden shadow-md">

            {{-- Kiri: Form --}}
            <div class="flex flex-col justify-center w-1/2 py-12 bg-indigo-200 px-14">
                <h2 class="mb-8 text-xl font-semibold text-center text-stone-900">Welcome Back!</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Username --}}
                    <div class="mb-5 rounded-xl">
                        <label for="email" class="block mb-1 text-sm font-medium text-gray-800">Email</label>
                        <input id="email" type="email" name="email" required autofocus
                            class="w-full px-5 py-2 border border-[#928DFF] rounded-full bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-[#C1BCF9]" />
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <label for="password" class="block mb-1 text-sm font-medium text-gray-800">Password:</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-5 py-2 border border-[#928DFF] rounded-full bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-[#C1BCF9]" />
                    </div>

                    {{-- Tombol Login --}}
                    <button type="submit"
                        class="w-full py-2 bg-[#6D75EB] text-white font-semibold rounded-full hover:bg-[#5a64c7] transition-all">
                        Login
                    </button>
                </form>

                {{-- Register --}}
                <p class="mt-6 text-sm text-center text-gray-800">
                    Dont have an account? <a href="{{ route('register') }}" class="font-bold hover:underline">Register</a>
                </p>
            </div>

            {{-- Kanan: Ilustrasi --}}
            <div class="w-1/2 bg-[#C1BCF9] flex items-center justify-center relative">
                <img src="{{ asset('laptop.png') }}" alt="Laptop Image" class="w-3/4 drop-shadow-lg">
            </div>
        </div>
    </div>
</x-guest-layout>
