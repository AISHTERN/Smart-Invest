@extends('layouts.app')

@section('content')
<div class="max-w-2xl px-6 py-8 mx-auto mt-10 bg-white shadow-lg rounded-xl">
    <h1 class="mb-6 text-3xl font-semibold text-indigo-700">Edit Profil</h1>

    @if (session('success'))
        <div class="px-4 py-3 mb-6 text-sm text-green-800 bg-green-100 border border-green-300 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Nama -->
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                class="w-full px-4 py-2 transition duration-150 ease-in-out border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                class="w-full px-4 py-2 transition duration-150 ease-in-out border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <!-- Tombol Simpan -->
        <div class="text-right">
            <button type="submit"
                class="inline-flex items-center px-6 py-2 text-white transition bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
