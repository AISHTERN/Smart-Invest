@extends('layouts.app')

@section('content')
<div class="max-w-6xl px-4 py-10 mx-auto text-white">

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center px-4 py-2 text-sm bg-[rgba(100,255,218,0.1)] border border-[rgba(100,255,218,0.3)] rounded hover:bg-[rgba(100,255,218,0.2)] transition">
            ← Kembali ke Dashboard
        </a>
    </div>

    <!-- Heading and Add Button -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-[#64ffda]">📈 Data Investasi</h1>
        <a href="{{ route('admin.investments.create') }}"
           class="px-4 py-2 text-sm font-semibold text-black bg-[#64ffda] rounded hover:bg-[#49e5c2] transition">
           + Tambah Investasi
        </a>
    </div>

    <!-- Success Notification -->
    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-300 border rounded-lg bg-green-900/20 border-green-500/30">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter -->
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.investments.index') }}" class="flex items-center gap-3">
            <label for="category" class="text-sm text-gray-300">Filter Kategori:</label>
            <select name="category" id="category"
                    class="px-4 py-2 text-white bg-transparent border rounded-lg border-[rgba(100,255,218,0.3)] focus:ring focus:ring-[#64ffda]">
                <option value="" class="bg-[rgba(15,15,35,0.98)]">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }} class="bg-[rgba(15,15,35,0.98)]">
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-black bg-[#64ffda] rounded hover:bg-[#49e5c2] transition">
                Terapkan
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-[rgba(30,30,60,0.5)] rounded-xl border border-[rgba(100,255,218,0.1)] backdrop-blur-md shadow">
        <table class="min-w-full text-sm text-white divide-y divide-[rgba(100,255,218,0.1)]">
            <thead class="text-left bg-[rgba(255,255,255,0.05)] text-[#64ffda]">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Gambar</th>
                    <th class="px-6 py-3">Judul</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Harga</th>
                    <th class="px-6 py-3">Investor</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($investments as $index => $investment)
                    <tr class="hover:bg-[rgba(100,255,218,0.05)] transition">
                        <td class="px-6 py-3">{{ $index + 1 }}</td>
                        <td class="px-6 py-3">
                            <img src="{{ asset('storage/' . $investment->image) }}"
                                 class="object-cover w-12 h-12 rounded-lg shadow" alt="">
                        </td>
                        <td class="px-6 py-3">{{ $investment->title }}</td>
                        <td class="px-6 py-3">{{ $investment->category->name }}</td>
                        <td class="px-6 py-3">Rp{{ number_format($investment->market_price, 0, ',', '.') }}</td>
                        <td>{{ $investment->investors_count }}</td>
                        <td class="px-6 py-3 space-x-2 text-right">
                            <a href="{{ route('admin.investments.edit', $investment->id) }}"
                               class="text-[#64ffda] hover:underline">Edit</a>
                            <form action="{{ route('admin.investments.destroy', $investment->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus investasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-400">Tidak ada data investasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
