@extends('layouts.app')

@section('content')
<div class="max-w-xl p-6 mx-auto mt-12 text-white bg-[rgba(30,30,60,0.6)] rounded-xl border border-[rgba(100,255,218,0.1)] shadow-lg backdrop-blur-md">
    <h2 class="mb-6 text-2xl font-bold text-[#64ffda]">✏️ Edit Kategori</h2>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Nama Kategori -->
        <div>
            <label for="name" class="block mb-1 text-sm text-gray-300">Nama Kategori</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}"
                   class="w-full px-4 py-2 bg-transparent border rounded-lg border-[rgba(100,255,218,0.3)] text-white focus:ring-2 focus:ring-[#64ffda]"
                   required>
        </div>

        <!-- Icon -->
        <div>
            <label for="icon" class="block mb-1 text-sm text-gray-300">Icon (opsional)</label>
            <input type="file" name="icon" id="icon"
                   class="block w-full px-4 py-2 text-sm text-white border rounded-lg cursor-pointer bg-[rgba(255,255,255,0.05)] border-[rgba(100,255,218,0.3)] file:bg-[#64ffda] file:text-black file:border-0 file:py-1 file:px-3 file:rounded file:cursor-pointer">

            @if ($category->icon)
                <div class="mt-3">
                    <p class="text-xs text-gray-400">Icon saat ini:</p>
                    <img src="{{ asset('storage/icons/' . $category->icon) }}" class="h-10 mt-1 rounded" alt="Current Icon">
                </div>
            @endif
        </div>

        <!-- Tombol -->
        <div class="flex justify-end pt-4 space-x-3">
            <a href="{{ route('admin.categories.index') }}"
               class="px-5 py-2 text-sm text-white bg-[rgba(100,255,218,0.2)] rounded-lg hover:bg-[rgba(100,255,218,0.3)] transition">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2 text-sm font-semibold text-black bg-[#64ffda] rounded-lg hover:bg-[#4de5c5] transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
