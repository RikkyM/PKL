<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReturController;
use App\Http\Middleware\Login;
use App\Http\Middleware\Permission1;
use App\Http\Middleware\Permission2;
use App\Livewire\Barang;
use App\Livewire\Dashboard;
use App\Livewire\Faktur;
use App\Livewire\ListFaktur;
use App\Livewire\ListRetur;
use App\Livewire\Mobil;
use App\Livewire\Profile;
use App\Livewire\Retur;
use App\Livewire\Sopir;
use App\Livewire\Toko;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::middleware([Login::class])->group(function() {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth', Permission1::class])->group(function() {
    Route::redirect('/','/dashboard');
    Route::get('/dashboard', Dashboard::class);
    Route::get('/barang', Barang::class);
    Route::get('/faktur', Faktur::class)->name('faktur');
    Route::get('/retur', Retur::class)->name('retur');
    Route::get('/sopir', Sopir::class);
    Route::get('/toko', Toko::class);
    Route::get('/mobil', Mobil::class);
    Route::get('/list-retur', ListRetur::class)->name('list-retur');
    Route::get('/print-retur/{id}', [ReturController::class, 'index']);
});
Route::middleware([Permission2::class])->group(function() {
    Route::get('/profil', Profile::class)->name('profil');
    Route::get('/list-faktur', ListFaktur::class)->name('list-faktur');
    Route::get('/print-faktur/{id}', [InvoiceController::class, 'index']);
});


Route::middleware(['auth'])->group(function() {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});