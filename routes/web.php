<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::get('/', [HomeController::class, 'getHome'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('catalog')->group(function(){
        Route::get('/', [CatalogController::class, 'getIndex'])->name('catalog');
        Route::get('/show/{id}', [CatalogController::class, 'getShow'])->name('show')->where(["id" => "[0-9]+"]);
        Route::get('/create', [CatalogController::class, 'getCreate'])->name('create');
        Route::get('/edit/{id}', [CatalogController::class, 'getEdit'])->name('edit')->where(["id" => "[0-9]+"]);
        Route::post('/create', [CatalogController::class, 'postMovie'])->name('createMovie');
        Route::put('/edit/{id}', [CatalogController::class, 'putEdit'])->name('putEdit');
        Route::put('/rent/{id}', [CatalogController::class, 'putRent'])->name('putReturn');
        Route::put('/return/{id}', [CatalogController::class, 'putReturn'])->name('putReturn');
        Route::delete('/delete/{id}', [CatalogController::class, 'deleteMovie'])->name('DeleteMovie');
    });
});

require __DIR__.'/auth.php';
