@extends('layouts.app')

@section('content')
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="p-4 mb-5 text-green-200 bg-green-800 border border-green-500 rounded-lg shadow">
            ✅ {{ session('success') }}
        </div>
    @endif



    {{-- Konten Utama --}}
    <main class="flex-1 p-8">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-white">👥 Manage Users</h1>
        </div>

            {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center px-4 py-2 text-sm bg-[rgba(100,255,218,0.1)] border border-[rgba(100,255,218,0.3)] rounded hover:bg-[rgba(100,255,218,0.2)] transition">
            ← Kembali ke Dashboard
        </a>
    </div>

        {{-- Tabel User --}}
        <div class="p-6 bg-[#1e293b] border border-[#334155] rounded-xl shadow-lg">
            <h2 class="mb-4 text-xl font-semibold text-[#64ffda]">📋 User List</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-[#0f172a] text-[#94a3b8] border-b border-[#334155]">
                        <tr>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Saldo</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300">
                        @forelse ($users as $user)
                            <tr class="border-b border-[#334155] hover:bg-[#0f172a] transition">
                                <td class="px-4 py-3">{{ $user->full_name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3 capitalize">{{ $user->role }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($user->balance, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 space-x-2 text-right">
                                    <a href="{{ route('admin.users.topup.form', $user->id) }}"
                                       class="px-3 py-1 text-xs font-medium text-black bg-green-400 rounded hover:bg-green-500">
                                        Topup
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="px-3 py-1 text-xs font-medium text-white bg-blue-400 rounded hover:bg-blue-500">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus user ini?')"
                                                class="px-3 py-1 text-xs font-medium text-white bg-red-500 rounded hover:bg-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-400">Belum ada user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
