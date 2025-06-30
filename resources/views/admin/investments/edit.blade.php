@extends('layouts.app')

@section('content')
<div class="max-w-4xl px-6 py-10 mx-auto text-white bg-[rgba(30,30,60,0.4)] rounded-xl border border-[rgba(100,255,218,0.1)] backdrop-blur-md shadow-md">

    <h2 class="mb-6 text-3xl font-bold text-[#64ffda]">🛠️ Edit Investasi</h2>

    <form action="{{ route('admin.investments.update', $investment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block mb-1 text-sm text-gray-300">Judul Investasi</label>
            <input type="text" name="title" id="title"
                   class="w-full px-4 py-2 bg-transparent border rounded-lg text-white border-[rgba(100,255,218,0.3)] focus:ring-[#64ffda] focus:ring"
                   value="{{ old('title', $investment->title) }}" required>
        </div>

        <div>
            <label for="category_id" class="block mb-1 text-sm text-gray-300">Kategori</label>
            <select name="category_id" id="category_id"
                    class="w-full px-4 py-2 bg-transparent text-white border rounded-lg border-[rgba(100,255,218,0.3)] focus:ring focus:ring-[#64ffda]"
                    required>
                @foreach($categories as $category)
                    <option class="bg-[#1e1e2e]" value="{{ $category->id }}" @selected($investment->category_id == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="market_price" class="block mb-1 text-sm text-gray-300">Harga Pasar (Rp)</label>
            <input type="number" name="market_price" id="market_price"
                   class="w-full px-4 py-2 bg-transparent border rounded-lg text-white border-[rgba(100,255,218,0.3)]"
                   step="0.01"
                   value="{{ old('market_price', $investment->market_price ?? '') }}" required>
        </div>

        <div>
            <label for="badge" class="block mb-1 text-sm text-gray-300">Badge (opsional)</label>
            <input type="text" name="badge" id="badge"
                   class="w-full px-4 py-2 bg-transparent border rounded-lg text-white border-[rgba(100,255,218,0.3)]"
                   value="{{ old('badge', $investment->badge) }}">
        </div>

        <div>
            <label for="image" class="block mb-1 text-sm text-gray-300">Gambar Investasi</label>
            @if($investment->image)
                <img src="{{ asset('storage/' . $investment->image) }}" class="mb-2 rounded-lg shadow w-28" alt="Image">
            @endif
            <input type="file" name="image" id="image"
                   class="block w-full px-3 py-2 mt-1 text-sm text-white bg-transparent border rounded-lg border-[rgba(100,255,218,0.3)] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-[#64ffda] file:text-black hover:file:bg-[#49e5c2]">
        </div>

        <div>
            <label for="description" class="block mb-1 text-sm text-gray-300">Deskripsi</label>
            <textarea name="description" id="description"
                      class="w-full px-4 py-2 bg-transparent border rounded-lg text-white border-[rgba(100,255,218,0.3)]"
                      rows="5" required>{{ old('description', $investment->description) }}</textarea>
        </div>

        <div>
            <label for="minimum_amount" class="block mb-1 text-sm text-gray-300">Minimal Investasi (Rp)</label>
            <input type="number" name="minimum_amount" id="minimum_amount"
                   class="w-full px-4 py-2 bg-transparent border rounded-lg text-white border-[rgba(100,255,218,0.3)]"
                   value="{{ old('minimum_amount', $investment->minimum_amount ?? 10000) }}"
                   placeholder="Contoh: 10000" min="1000" required>
        </div>

        <div class="flex justify-end mt-8 space-x-4">
            <a href="{{ route('admin.investments.index') }}"
               class="px-5 py-2 text-sm font-medium text-gray-300 border rounded-lg border-[rgba(100,255,218,0.3)] hover:bg-[rgba(100,255,218,0.1)] transition">
               Batal
            </a>
            <button type="submit"
                    class="px-6 py-2 text-sm font-semibold text-black bg-[#64ffda] rounded-lg hover:bg-[#49e5c2] transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
