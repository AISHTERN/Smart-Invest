@extends('layouts.app')

@section('content')
<div class="max-w-lg p-6 mx-auto mt-10 bg-[#1e293b] text-white rounded-xl shadow-xl border border-[#334155]">
    <h2 class="mb-6 text-2xl font-bold text-[#64ffda]">💰 Top Up Saldo</h2>

    {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('admin.users') }}"
           class="inline-flex items-center px-4 py-2 text-sm bg-[rgba(100,255,218,0.1)] border border-[rgba(100,255,218,0.3)] rounded hover:bg-[rgba(100,255,218,0.2)] transition">
            ← Kembali
        </a>
    </div>


    <form method="POST" action="{{ route('admin.users.topup', $user->id) }}" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-300">Nama User</label>
            <input type="text" value="{{ $user->full_name ?? $user->name }}"
                   class="w-full px-4 py-2 bg-[#0f172a] text-gray-300 border border-[#334155] rounded focus:outline-none" disabled>
        </div>

        <div>
            <label for="amount" class="block mb-1 text-sm font-medium text-gray-300">Jumlah Top Up (Rp)</label>
            <input type="number" name="amount" id="amount" min="1000" required
                   class="w-full px-4 py-2 bg-[#0f172a] text-white border border-[#334155] rounded focus:ring-2 focus:ring-[#64ffda]"
                   placeholder="Contoh: 10000">
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit"
                class="px-6 py-2 font-semibold text-black bg-[#64ffda] rounded hover:bg-[#4dd0c6] transition">
                🚀 Top Up Sekarang
            </button>
        </div>
    </form>
</div>
@endsection
