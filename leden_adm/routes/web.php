<?php

use Illuminate\Support\Facades\Route;

//controllers for table resource models
use App\Http\Controllers\FamilieController;
use App\Http\Controllers\FamilielidController;
use App\Http\Controllers\SoortlidController;
use App\Http\Controllers\BoekjaarController;
use App\Http\Controllers\ContributieController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
//     return redirect(route('familie.index'));
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard', [FamilieController::class, 'search'])
->middleware(['auth', 'verified'])->name('zoek_familie');

Route::post('/contributies', [ContributieController::class, 'update_boekjaar'])
->middleware(['auth', 'verified'])->name('display_boekjaar');

Route::post('/familielid.index', [FamilielidController::class, 'search'])
->middleware(['auth', 'verified'])->name('zoek_lid');

Route::get('/contributie.staffels', function () {
    return view('contributie.staffels');
})->middleware(['auth', 'verified'])->name('staffels');

//route for tables
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('familie', FamilieController::class);
    Route::resource('familielid', FamilielidController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('boekjaar', BoekjaarController::class)->only(['index']);
    Route::resource('contributie', ContributieController::class)->only(['show', 'edit', 'update', 'destroy']);
    Route::resource('admin', AdminController::class)->only(['index', 'edit', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
