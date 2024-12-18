<?php

use App\Http\Controllers\LogoutController;
use App\Http\Livewire\Dashboard\DaftarDepot\Index as DaftarDepotIndex;
use App\Http\Livewire\Dashboard\Depot\Index as DepotIndex;
use App\Http\Livewire\Dashboard\Index as DashboardIndex;
use App\Http\Livewire\Dashboard\Profil\Index as ProfilIndex;
use App\Http\Livewire\Dashboard\User\Index as UserIndex;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Index;
use App\Http\Livewire\Login;
use App\Http\Livewire\ShowDepot;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Index::class);

Route::get('/depot/{depot:id_depot}/show', ShowDepot::class);

Route::get('/login', Login::class)->name('login')->middleware('guest');

Route::controller(LogoutController::class)->group(function () {
    Route::post('/logout', 'logout')->middleware('auth');
});


Route::get('/dashboard', DashboardIndex::class)->middleware('auth');

// owner
Route::get('/dashboard/depot', DepotIndex::class)->middleware('owner');

// admin
Route::get('/dashboard/daftar-depot', DaftarDepotIndex::class)->middleware('admin');
Route::get('/dashboard/admin', UserIndex::class)->middleware('admin');

Route::get('/dashboard/profil', ProfilIndex::class)->middleware('auth');