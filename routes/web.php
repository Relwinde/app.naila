<?php

use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\User\Users;
use App\Livewire\Agent\Agents;
use App\Livewire\Examen\Examens;
use App\Livewire\Produit\Produits;
use App\Livewire\Profile\Profiles;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pharmacie\Activities;
use App\Livewire\Prestation\Prestations;
use App\Livewire\Caisse\Home as CaisseHome;
use App\Livewire\Consultation\Consultations;

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

Route::get('/caisse', CaisseHome::class)->name('caisse');
Route::get('/utilisateurs', Users::class)->name('utilisateurs');

Route::get('/profils', Profiles::class)->name('profils');