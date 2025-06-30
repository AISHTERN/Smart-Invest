<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex w-full max-w-6xl h-[620px] rounded-xl overflow-hidden shadow-md">

            {{-- Kiri: Ilustrasi --}}
            <div class="flex items-center justify-center w-1/2">
                <img src="{{ asset('iconregis.png') }}" alt="Register Illustration" class="w-[75%]">
            </div>

            {{-- Kanan: Form --}}
            <div class="flex flex-col justify-center w-1/2 py-12 bg-indigo-400 px-14">
                <h2 class="mb-6 text-base font-semibold text-center text-black">Please Fill out form to Register!</h2>

                <form method="POST" action="{{ route('register') }}">
                    @if ($errors->any())
                        <div class="mb-4 text-sm text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf

                    {{-- Full Name --}}
                    <div class="mb-4">
                        <label for="full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="full_name" id="full_name" required
                            class="w-full px-3 py-2 mt-1 border border-[#928DFF] rounded-full bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-[#C1BCF9]">
                    </div>


                    {{-- Username --}}
                    <div class="mb-4">
                        <label for="username" class="block mb-1 text-sm text-gray-800">Username:</label>
                        <input id="username" type="text" name="username" required
                            class="w-full px-5 py-2 border border-[#928DFF] rounded-full bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-[#C1BCF9]" />
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="block mb-1 text-sm text-gray-800">Email:</label>
                        <input id="email" type="email" name="email" required
                            class="w-full px-5 py-2 border border-[#928DFF] rounded-full bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-[#C1BCF9]" />
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="block mb-1 text-sm text-gray-800">Password:</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-5 py-2 border border-[#928DFF] rounded-full bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-[#C1BCF9]" />
                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-6">
                        <label for="password_confirmation" class="block mb-1 text-sm text-gray-800">Confirm Password:</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full px-5 py-2 border border-[#928DFF] rounded-full bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-[#C1BCF9]" />
                    </div>

                    {{-- Tombol Register --}}
                    <button type="submit"
                        class="w-full py-2 bg-[#6D75EB] text-white font-semibold rounded-full hover:bg-[#5a64c7] transition-all">
                        Register
                    </button>
                </form>

                {{-- Link Login --}}
                <p class="mt-6 text-sm text-center text-gray-800">
                    Yes I have an account? <a href="{{ route('login') }}" class="font-bold hover:underline">Login</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
