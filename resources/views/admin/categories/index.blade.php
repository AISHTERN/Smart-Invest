@extends('layouts.app')

@section('content')
<div class="max-w-6xl px-4 py-8 mx-auto text-white">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.dashboard') }}"
               class="px-4 py-2 text-sm font-medium text-white bg-[rgba(100,255,218,0.2)] hover:bg-[rgba(100,255,218,0.3)] rounded-lg backdrop-blur-sm transition">
               ← Dashboard
            </a>
            <h1 class="text-2xl font-bold text-[#64ffda]">🗂️ Manage Categories</h1>
        </div>
        <a href="{{ route('admin.categories.create') }}"
           class="px-4 py-2 text-sm font-medium text-black bg-[#64ffda] hover:bg-[#4de5c5] rounded-lg transition">
           + Add Category
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg bg-[rgba(30,30,60,0.6)] border border-[rgba(100,255,218,0.1)] shadow">
        <table class="min-w-full text-sm text-white">
            <thead class="bg-[rgba(100,255,218,0.1)] text-[#64ffda] uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3 text-left">Icon</th>
                    <th class="px-6 py-3 text-left">Category Name</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[rgba(255,255,255,0.05)]">
                @forelse($categories as $category)
                    <tr class="hover:bg-[rgba(100,255,218,0.05)] transition">
                        <td class="px-6 py-3">
                            <img src="{{ asset('storage/' . $category->icon) }}"
                                 class="object-cover w-12 h-12 rounded-lg shadow"
                                 alt="{{ $category->name }}">
                        </td>
                        <td class="px-6 py-3 font-medium">{{ $category->name }}</td>
                        <td class="px-6 py-3 space-x-2 text-right">
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="px-3 py-1 text-sm bg-[#3b82f6] hover:bg-blue-700 rounded text-white transition">Edit</a>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 text-sm text-white transition bg-red-600 rounded hover:bg-red-800">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-400">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
