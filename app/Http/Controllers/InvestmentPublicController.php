<?php

namespace App\Http\Controllers;

use App\Models\Investment;

class InvestmentPublicController extends Controller
{
    public function show(Investment $investment)
    {
        $investment->load('category');

        return view('investments.show', compact('investment'));
    }
}
