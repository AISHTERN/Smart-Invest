<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InvestmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\InvestmentTransactionController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\Admin\DepositRequestController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\UserAssetController;

/*
|--------------------------------------------------------------------------
| Public Routes (Tidak butuh login)
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/investment/{investment}', [HomeController::class, 'show'])->name('investment.show');
Route::get('/investments/{investment}/success', [InvestmentTransactionController::class, 'success'])->name('investments.success');
Route::post('/investments', [InvestmentTransactionController::class, 'store'])->name('investments.store');
Route::post('/investments/sell', [InvestmentTransactionController::class, 'sell'])->name('investments.sell');

Route::get('/redirect', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('home');
})->middleware('auth');

Route::get('/force-logout', function () {
    Auth::logout();
    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Balance
    Route::get('/balance', [BalanceController::class, 'index'])->name('balance.index');
    Route::post('/balance/deposit', [BalanceController::class, 'deposit'])->name('balance.deposit');
    Route::post('/balance/deposit/proof', [BalanceController::class, 'submitProof'])->name('balance.deposit.proof');
    Route::post('/balance/withdraw', [BalanceController::class, 'withdraw'])->name('balance.withdraw');

    // Deposit
    Route::get('/deposit/methods', [DepositController::class, 'showMethods'])->name('deposit.methods');
    Route::post('/deposit', [DepositController::class, 'store'])->name('deposit.store');
    Route::get('/deposit/history', [DepositController::class, 'history'])->name('deposit.history');

    // Withdraw
    Route::get('/withdraw', [WithdrawController::class, 'create'])->name('withdraw.create');
    Route::post('/withdraw', [WithdrawController::class, 'store'])->name('withdraw.store');

    // User Assets
    Route::get('/my-assets', [UserAssetController::class, 'index'])->name('user.assets');

    // Notifikasi
    Route::get('/notifications/mark-all-read', function () {
        \App\Models\Notification::where('user_id', auth()->id())->update(['is_read' => true]);
        return back();
    })->name('notifications.markAllRead');

    // Test notifikasi
    Route::get('/test-notif', function () {
        \App\Models\Notification::create([
            'user_id' => auth()->id(),
            'title' => 'Tes Notifikasi',
            'message' => 'Ini notifikasi tes deposit',
        ]);
        return redirect()->back()->with('success', 'Notifikasi dikirim.');
    })->name('test.notif');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Categories & Investments
    Route::resource('/categories', CategoryController::class);
    Route::resource('/investments', InvestmentController::class);

    // Users
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}/topup', [AdminUserController::class, 'topupForm'])->name('users.topup.form');
    Route::post('/users/{user}/topup', [AdminUserController::class, 'topup'])->name('users.topup');

    // Deposit Request
    Route::get('/deposit-requests', [DepositRequestController::class, 'index'])->name('deposit.requests');
    Route::post('/deposit-requests/{id}/approve', [DepositRequestController::class, 'approve'])->name('deposit.approve');
    Route::post('/deposit-requests/{id}/reject', [DepositRequestController::class, 'reject'])->name('deposit.reject');

    // Withdraw Requests
    Route::get('/withdraw/requests', [AdminController::class, 'withdrawRequests'])->name('withdraw.requests');
    Route::post('/withdraw/approve/{id}', [AdminController::class, 'approveWithdraw'])->name('withdraw.approve');
    Route::post('/withdraw/update-status/{id}/{status}', [WithdrawController::class, 'updateStatus'])->name('withdraw.updateStatus');
});


Route::get('/about', function () {
    return view('about');
})->name('about');


Route::view('/faq', 'faq')->name('faq');

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze, Fortify, etc)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';