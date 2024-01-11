<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\UserController;

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

// All authenticated routes
Route::middleware('auth')->group(function() {
    // Main route
    Route::get('/', function () {
        return view('home');
    });

    // Projeto
    Route::prefix('projetos')->group(function (){
        Route::post('/', [ProjetoController::class, 'store'])->name('projeto.store');
        Route::get('/', [ProjetoController::class, 'index'])->name('projeto.index');
        Route::get('/create', [ProjetoController::class, 'create'])->name('projeto.create');
        Route::get('/edit/{id}', [ProjetoController::class, 'edit'])->name('projeto.edit');
        Route::patch('/edit/{id}', [ProjetoController::class, 'update'])->name('projeto.update');
        Route::delete('/{id}', [ProjetoController::class, 'destroy'])->name('projeto.destroy');
    });

    // Users routes
    Route::prefix('users')->group(function () {
        Route::post('/', [UserController::class, 'store'])->name('user.store');
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::patch('/edit/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });
});

require __DIR__.'/auth.php';
