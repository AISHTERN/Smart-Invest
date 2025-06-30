<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Investment;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Ambil semua user
        return view('admin.users.index', compact('users'));
    }

    public function investments()
    {
        return $this->belongsToMany(Investment::class, 'investment_transactions');
    }
}
