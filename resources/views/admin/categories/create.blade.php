@extends('layouts.app')

@section('content')
<div class="max-w-2xl p-6 mx-auto mt-12 text-white bg-[rgba(30,30,60,0.6)] rounded-xl border border-[rgba(100,255,218,0.1)] shadow-lg backdrop-blur-md">
    <h2 class="mb-6 text-2xl font-bold text-[#64ffda]">➕ Tambah Kategori Baru</h2>

    <!-- Error Handling -->
    @if ($errors->any())
        <div class="p-4 mb-6 text-sm text-red-300 bg-[rgba(255,0,0,0.05)] border border-red-500/30 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Category Name -->
        <div>
            <label for="name" class="block mb-1 text-sm text-gray-300">Nama Kategori</label>
            <input type="text" name="name" id="name"
                   class="w-full px-4 py-2 bg-transparent border rounded-lg border-[rgba(100,255,218,0.3)] text-white focus:ring-2 focus:ring-[#64ffda]"
                   placeholder="Contoh: Properti, Startup, dll" required>
        </div>

        <!-- Category Icon -->
        <div>
            <label for="icon" class="block mb-1 text-sm text-gray-300">Icon Kategori</label>
            <input type="file" name="icon" id="icon"
                   class="block w-full px-4 py-2 text-sm text-white border rounded-lg cursor-pointer bg-[rgba(255,255,255,0.05)] border-[rgba(100,255,218,0.3)] file:bg-[#64ffda] file:text-black file:border-0 file:py-1 file:px-3 file:rounded file:cursor-pointer"
                   required>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end pt-4 space-x-3">
            <a href="{{ route('admin.categories.index') }}"
               class="px-5 py-2 text-sm text-white bg-[rgba(100,255,218,0.2)] rounded-lg hover:bg-[rgba(100,255,218,0.3)] transition">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2 text-sm font-semibold text-black bg-[#64ffda] rounded-lg hover:bg-[#4de5c5] transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
