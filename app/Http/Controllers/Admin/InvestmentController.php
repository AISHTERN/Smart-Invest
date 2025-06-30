<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class InvestmentController extends Controller
{

    public function index(Request $request)
    {
        $query = Investment::with('category', 'users')->latest();

        // Cek apakah ada filter kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $investments = $query->get();
        $categories = \App\Models\Category::all();

        return view('admin.investments.index', compact('investments', 'categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.investments.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'badge' => 'nullable|string|max:255',
            'market_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('investments', 'public');
        }

        Investment::create($data);

        return redirect()->route('admin.investments.index')->with('success', 'Investment created successfully.');
    }

    public function edit(Investment $investment)
    {
        $categories = Category::all();
        return view('admin.investments.edit', compact('investment', 'categories'));
    }

    public function update(Request $request, Investment $investment)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'badge' => 'nullable|string|max:255',
            'market_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             'minimum_amount' => 'required|numeric|min:1000',
        ]);

        // Jika upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($investment->image && Storage::disk('public')->exists($investment->image)) {
                Storage::disk('public')->delete($investment->image);
            }

            $data['image'] = $request->file('image')->store('investments', 'public');
        }


        $investment->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'badge' => $request->badge,
            'market_price' => $request->market_price, // ✅ Tambahkan ini
            'image' => $data['image'] ?? $investment->image,
        ]);


        return redirect()->route('admin.investments.index')->with('success', 'Investment updated successfully.');
    }

    public function destroy(Investment $investment)
    {
        // Hapus gambar dari storage
        if ($investment->image && Storage::disk('public')->exists($investment->image)) {
            Storage::disk('public')->delete($investment->image);
        }

        $investment->delete();

        return redirect()->back()->with('success', 'Investment deleted successfully.');
    }

    public function show(Investment $investment)
    {
        $investment->load('category');
        return view('investments.show', compact('investment'));
    }
}
