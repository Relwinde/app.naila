<?php

use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Agent\Agents;
use App\Livewire\Examen\Examens;
use App\Livewire\Produit\Produits;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pharmacie\Activities;
use App\Livewire\Consultation\Consultations;
use App\Livewire\Prestation\Prestations;

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
Route::get('/consultations', Consultations::class)->name('consultations');
Route::get('/prestations', Prestations::class)->name('prestations');