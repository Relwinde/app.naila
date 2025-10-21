<?php

use App\Livewire\Examen\Examens;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Pharmacie\Activities;
use App\Livewire\Produit\Produits;
use App\Livewire\Agent\Agents;
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
Route::get('/produits', Produits::class)->name('produits'); 
Route::get('/examens', Examens::class)->name('examens');
Route::get('/pharmacies', Activities::class)->name('pharmacies');
Route::get('/agents', Agents::class)->name('agents');