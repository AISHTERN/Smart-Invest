@extends('layouts.app')

@section('content')
<div class="max-w-3xl p-6 mx-auto mt-10 bg-white rounded-lg shadow">
    <h1 class="mb-6 text-2xl font-bold text-indigo-700">Profil Saya</h1>

    <div class="flex items-center mb-6 space-x-4">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" class="w-20 h-20 rounded-full" alt="Avatar">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
            <p class="text-gray-600">{{ $user->email }}</p>
            <p class="text-gray-600">Saldo: <strong>Rp {{ number_format($user->balance, 0, ',', '.') }}</strong></p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" value="{{ $user->name }}" readonly class="w-full p-2 mt-1 bg-gray-100 border rounded">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="text" value="{{ $user->email }}" readonly class="w-full p-2 mt-1 bg-gray-100 border rounded">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Bergabung</label>
            <input type="text" value="{{ $user->created_at->format('d M Y') }}" readonly class="w-full p-2 mt-1 bg-gray-100 border rounded">
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('profile.edit') }}" class="inline-block px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">
            Edit Profil
        </a>
    </div>
</div>
@endsection
