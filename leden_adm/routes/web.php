<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LedenController;
use App\Http\Controllers\AdresController;
use App\Http\Controllers\GfGController;

//controllers for table resource models
use App\Http\Controllers\FamilieController;
use App\Http\Controllers\FamilielidController;
use App\Http\Controllers\SoortlidController;
use App\Http\Controllers\BoekjaarController;
use App\Http\Controllers\ContributieController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;

use App\Http\Controllers\Famdisplay;
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

Route::get('/helo', [GFGController::class, 'isPenny']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/test', function () {
    return view('test');
})->middleware(['auth', 'verified'])->name('test');

// route for official app
Route::get('/leden', [MainController::class, 'info'])
->middleware(['auth', 'verified'])->name('ledendash');

Route::post('/leden', [MainController::class, 'search'])
->middleware(['auth', 'verified'])->name('ledendash');

Route::post('/contributies', [ContributieController::class, 'update_boekjaar'])
->middleware(['auth', 'verified'])->name('jaar');

Route::post('/familie.index', [FamilielidController::class, 'search'])
->middleware(['auth', 'verified'])->name('zoek_lid');

Route::get('/contributie.staffels', function () {
    return view('contributie.staffels');
})
->middleware(['auth', 'verified'])->name('staffels');

// routes for table resource models
// Route::resource('familie', FamilieController::class)
// ->middleware(['auth', 'verified']);

// Route::resource('familielid', FamilielidController::class)
// ->middleware(['auth', 'verified']);

// Route::resource('soortlid', SoortlidController::class)
// ->middleware(['auth', 'verified']);

// Route::resource('boekjaar', BoekjaarController::class)
// ->middleware(['auth', 'verified']);

// Route::resource('contributie', ContributieController::class)
// ->middleware(['auth', 'verified']);

Route::resource('admin', AdminController::class)
->middleware(['auth', 'verified']);


// multiroute
Route::resources([
    'familie' => FamilieController::class,
    'familielid' => FamilielidController::class,
    'soortlid' => SoortlidController::class,
    'contributie' =>  ContributieController::class,
    'boekjaar' => BoekjaarController::class,
//     'admin' => AdminController::class,
    ]);

require __DIR__.'/auth.php';
