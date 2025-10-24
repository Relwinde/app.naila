<?php

use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\User\Users;
use App\Livewire\User\Header;
use App\Livewire\Agent\Agents;
use App\Livewire\Appro\Appros;
use App\Livewire\Examen\Examens;
use App\Livewire\Produit\Produits;
use App\Livewire\Profile\Profiles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pharmacie\Activities;
use Illuminate\Support\Facades\Session;
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
Route::get('/produits', Produits::class)->name('produits')->middleware('auth'); 
Route::get('/examens', Examens::class)->name('examens')->middleware('auth');
Route::get('/pharmacies', Activities::class)->name('pharmacies')->middleware('auth');
Route::get('/agents', Agents::class)->name('agents')->middleware('auth');
Route::get('/consultations', Consultations::class)->name('consultations')->middleware('auth');
Route::get('/prestations', Prestations::class)->name('prestations')->middleware('auth');

Route::get('/caisse', CaisseHome::class)->name('caisse')->middleware('auth');
Route::get('/utilisateurs', Users::class)->name('utilisateurs')->middleware('auth');

Route::get('/profils', Profiles::class)->name('profils')->middleware('auth');

Route::get('/approvisionnements', Appros::class)->name('approvisionnements')->middleware('auth');

Route::get('/logout', Header::class)->name('logout')->middleware('auth');