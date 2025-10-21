<?php

use App\Livewire\Home;
use App\Livewire\Login;
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

Route::get('/', Home::class)->name('home')->middleware('auth');

Route::get('/login', Login::class)->name('login');
Route::get('/produits', App\Livewire\Produit\Produits::class)->name('produits'); 
Route::get('/examens', App\Livewire\Examen\Examens::class)->name('examens');
Route::get('/pharmacies', App\Livewire\Pharmacie\Activities::class)->name('pharmacies');