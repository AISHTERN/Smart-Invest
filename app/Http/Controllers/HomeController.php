<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Investment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
public function index(Request $request)
{
    $categories = Category::all();
    $selectedCategory = $request->query('category');
    $searchKeyword = $request->query('search');

    $query = Investment::query();

    // Filter kategori (jika ada)
    if ($selectedCategory) {
        $query->where('category_id', $selectedCategory);
    }

    // Filter search keyword (jika ada)
    if ($searchKeyword) {
        $query->where(function ($q) use ($searchKeyword) {
            $q->where('title', 'like', '%' . $searchKeyword . '%')
              ->orWhere('description', 'like', '%' . $searchKeyword . '%');
        });
    }

    // Jika tidak ada kategori atau search, tampilkan trending
    if (!$selectedCategory && !$searchKeyword) {
        $query->where('badge', 'LIKE', '%Trending%');
    }

    $investments = $query->latest()->get();

    return view('home', compact('categories', 'investments', 'selectedCategory', 'searchKeyword'));
}


    public function show($id)
    {
        $investment = Investment::with('category')->findOrFail($id);

        return view('investments.show', compact('investment'));
    }


}
