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
use App\Http\Controllers\UserController;

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


// Route::get('/gfg', [GFGController::class, 'article']);


Route::get('/helo', [GFGController::class, 'isPenny']);

// Route::get('/panel', [GFGController::class, 'roles'])
// ->middleware(['auth', 'verified'])->name('panel');


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
Route::get('/leden', function () {
    return view('ledendash');
})->middleware(['auth', 'verified'])->name('ledendash');


Route::resource('/ledens', LedenController::class);


Route::resource('adres', AdresController::class)

->only(['index', 'store'])

->middleware(['auth', 'verified']);


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
