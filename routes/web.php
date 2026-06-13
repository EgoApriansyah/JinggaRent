<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CostumeCatalog;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;

use App\Livewire\CostumeDetail;
use App\Livewire\Member\Profile;
use App\Livewire\Member\OrderHistory;
use App\Livewire\Member\OrderDetail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/katalog', CostumeCatalog::class)->name('catalog');
Route::get('/katalog/{slug}', CostumeDetail::class)->name('catalog.detail');

Route::middleware('guest')->group(function () {
    Route::get('/masuk', Login::class)->name('login');
    Route::get('/daftar', Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/profil', Profile::class)->name('member.profile');
    Route::get('/pesanan', OrderHistory::class)->name('member.order.history');
    Route::get('/pesanan/{id}', OrderDetail::class)->name('member.order.detail');
});

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::post('/midtrans/callback', [\App\Http\Controllers\MidtransWebhookController::class, 'handle']);
