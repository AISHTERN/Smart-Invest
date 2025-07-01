@extends('layouts.app')

@section('content')
<div class="max-w-xl p-6 mx-auto mt-10 bg-[#1e293b] text-white border border-[#334155] rounded-xl shadow-xl">
    <h2 class="mb-6 text-2xl font-bold text-[#64ffda]">✏️ Edit User</h2>

        {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('admin.users') }}"
           class="inline-flex items-center px-4 py-2 text-sm bg-[rgba(100,255,218,0.1)] border border-[rgba(100,255,218,0.3)] rounded hover:bg-[rgba(100,255,218,0.2)] transition">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="full_name" class="block mb-1 text-sm font-medium text-gray-300">Full Name</label>
            <input type="text" name="full_name" id="full_name"
                   value="{{ old('full_name', $user->full_name) }}"
                   class="w-full px-4 py-2 bg-[#0f172a] border border-[#334155] rounded text-white focus:outline-none focus:ring-2 focus:ring-[#64ffda]">
        </div>

        <div>
            <label for="email" class="block mb-1 text-sm font-medium text-gray-300">Email</label>
            <input type="email" name="email" id="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full px-4 py-2 bg-[#0f172a] border border-[#334155] rounded text-white focus:outline-none focus:ring-2 focus:ring-[#64ffda]">
        </div>

        <div>
            <label for="role" class="block mb-1 text-sm font-medium text-gray-300">Role</label>
            <select name="role" id="role"
                    class="w-full px-4 py-2 bg-[#0f172a] border border-[#334155] rounded text-white focus:outline-none focus:ring-2 focus:ring-[#64ffda]">
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div class="flex justify-end pt-4 space-x-3">
            <a href="{{ route('admin.users') }}"
               class="px-4 py-2 text-sm text-gray-300 transition bg-gray-700 border border-gray-600 rounded hover:bg-gray-600">Cancel</a>
            <button type="submit"
                    class="px-6 py-2 text-sm font-medium text-black bg-[#64ffda] rounded hover:bg-[#4dd0c6] transition">Update</button>
        </div>
    </form>
</div>
@endsection
