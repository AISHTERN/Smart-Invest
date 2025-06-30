<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\Category;
use App\Models\InvestmentTransaction;

class UserAssetController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $selectedCategory = $request->query('category');

        // Ambil semua kategori untuk dropdown filter
        $categories = Category::all();

        // Ambil transaksi user
        $query = InvestmentTransaction::with('investment.category')
                    ->where('user_id', $userId)
                    ->latest();

        // Filter berdasarkan kategori jika ada
        if ($selectedCategory) {
            $query->whereHas('investment', function ($q) use ($selectedCategory) {
                $q->where('category_id', $selectedCategory);
            });
        }

        $transactions = $query->get();

        // Total semua investasi
        $totalInvested = $transactions->sum('amount');

        // Persiapan data untuk grafik
        $growthData = $transactions->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $dates = $growthData->keys();
        $amounts = $growthData->map(fn($items) => $items->sum('amount'))->values();

        return view('users.assets', compact(
            'transactions',
            'categories',
            'selectedCategory',
            'totalInvested',
            'dates',
            'amounts'
        ));
    }
}