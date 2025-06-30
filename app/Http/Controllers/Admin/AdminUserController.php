<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:user,admin',
        ]);

        $user->update($request->only('full_name', 'email', 'role'));

        return redirect()->route('admin.users')->with('success', 'User updated!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted!');
    }

public function topupForm($id)
{
    $user = \App\Models\User::findOrFail($id);
    return view('admin.users.topup', compact('user'));
}

public function topup(Request $request, $id)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
    ]);

    $user = \App\Models\User::findOrFail($id);
    $user->balance += $request->amount;
    $user->save();

    // Opsional: Tambah notifikasi
    \App\Models\Notification::create([
        'user_id' => $user->id,
        'title' => 'Saldo Ditambahkan',
        'message' => 'Saldo Anda telah ditambah sebesar Rp ' . number_format($request->amount, 0, ',', '.'),
    ]);

    return redirect()->route('admin.users')->with('success', 'Saldo user berhasil ditambahkan.');
}

}
