@extends('layouts.app')

@section('content')
<div class="max-w-4xl px-6 py-10 mx-auto text-white bg-[rgba(30,30,60,0.4)] rounded-xl border border-[rgba(100,255,218,0.1)] backdrop-blur-md shadow-md">

    <h2 class="mb-6 text-3xl font-bold text-[#64ffda]">➕ Tambah Investasi Baru</h2>

    <form action="{{ route('admin.investments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block mb-1 text-sm text-gray-300">Judul Investasi</label>
            <input type="text" name="title" id="title"
                   class="w-full px-4 py-2 bg-transparent border rounded-lg text-white border-[rgba(100,255,218,0.3)] focus:ring-[#64ffda]"
                   placeholder="Contoh: Proyek EcoFarm" required>
        </div>

        <div>
            <label for="category_id" class="block mb-1 text-sm text-gray-300">Kategori</label>
            <select name="category_id" id="category_id"
                    class="w-full px-4 py-2 bg-transparent text-white border rounded-lg border-[rgba(100,255,218,0.3)] focus:ring focus:ring-[#64ffda]"
                    required>
                <option class="bg-[#1e1e2e]" value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                <option class="bg-[#1e1e2e]" value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="market_price" class="block mb-1 text-sm text-gray-300">Harga Pasar (Rp)</label>
            <input type="number" name="market_price" id="market_price"
                   class="w-full px-4 py-2 bg-transparent border rounded-lg text-white border-[rgba(100,255,218,0.3)]"
                   step="0.01" placeholder="Contoh: 50000" required>
        </div>

        <div>
            <label for="badge" class="block mb-1 text-sm text-gray-300">Badge (opsional)</label>
            <input type="text" name="badge" id="badge"
                   class="w-full px-4 py-2 bg-transparent border rounded-lg text-white border-[rgba(100,255,218,0.3)]"
                   placeholder="Contoh: Trending Minggu Ini">
        </div>

        <div>
            <label for="image" class="block mb-1 text-sm text-gray-300">Gambar Investasi</label>
            <input type="file" name="image" id="image"
                   class="block w-full px-3 py-2 mt-1 text-sm text-white bg-transparent border rounded-lg border-[rgba(100,255,218,0.3)] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-[#64ffda] file:text-black hover:file:bg-[#49e5c2]">
        </div>

        <div>
            <label for="description" class="block mb-1 text-sm text-gray-300">Deskripsi</label>
            <textarea name="description" id="description"
                      class="w-full px-4 py-2 bg-transparent border rounded-lg text-white border-[rgba(100,255,218,0.3)]"
                      rows="5" placeholder="Deskripsikan peluang investasi ini..." required></textarea>
        </div>

        <div class="flex justify-end pt-4 space-x-4">
            <a href="{{ route('admin.investments.index') }}"
               class="px-5 py-2 text-sm font-medium text-gray-300 border rounded-lg border-[rgba(100,255,218,0.3)] hover:bg-[rgba(100,255,218,0.1)] transition">
               Batal
            </a>
            <button type="submit"
                    class="px-6 py-2 text-sm font-semibold text-black bg-[#64ffda] rounded-lg hover:bg-[#49e5c2] transition">
                Simpan Investasi
            </button>
        </div>
    </form>
</div>
@endsection
