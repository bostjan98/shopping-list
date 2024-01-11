<?php

use Illuminate\Support\Facades\Route;
use App\Models\Item;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Auth\LoginRegisterController;

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

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});



Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});


Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/apiItems', [ItemController::class, 'indexApi']);

Route::get('/items/{id}/edit', [ItemController::class, 'editForm'])->name('items.edit');
Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
Route::get('/items/create', [ItemController::class, 'createForm'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
#Route::post('/items/{id}/toggle-nakupljeno', [ItemController::class, 'toggleNakupljeno'])->name('items.toggle-nakupljeno');
Route::view('/{any}', 'items.index')->where('any', '.*');
Route::post('/items/{id}/toggle-nakupljeno', [ItemController::class, 'toggleNakupljenoAjax'])->name('items.toggle-nakupljeno');
Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');


