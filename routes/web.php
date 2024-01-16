<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\ProjetoOrcamentoController;
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

        Route::prefix('/{id_projeto}/orcamentos')->group(function (){
            Route::post('/', [ProjetoOrcamentoController::class, 'store'])->name('projeto.orcamento.store');
            Route::get('/', [ProjetoOrcamentoController::class, 'index'])->name('projeto.orcamento.index');
            Route::get('/create', [ProjetoOrcamentoController::class, 'create'])->name('projeto.orcamento.create');
            Route::get('/edit/{id}', [ProjetoOrcamentoController::class, 'edit'])->name('projeto.orcamento.edit');
            Route::patch('/edit/{id}', [ProjetoOrcamentoController::class, 'update'])->name('projeto.orcamento.update');
            Route::delete('/{id}', [ProjetoOrcamentoController::class, 'destroy'])->name('projeto.orcamento.destroy');
        });

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
