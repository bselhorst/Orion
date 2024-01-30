<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjetosDashboardController;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\ProjetoOrcamentoController;
use App\Http\Controllers\ProjetoOrcamentoDespesaController;
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

    // Projetos
    Route::prefix('projetos')->group(function (){
        Route::get('/grafico', [ProjetoController::class, 'dashboard']);
        Route::get('/json', [ProjetoController::class, 'json']);

        Route::get('/', [ProjetoController::class, 'index'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.read')])->name('projeto.index');
        Route::post('/', [ProjetoController::class, 'store'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.create')])->name('projeto.store');
        Route::get('/create', [ProjetoController::class, 'create'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.create')])->name('projeto.create');
        Route::get('/edit/{id}', [ProjetoController::class, 'edit'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.update')])->name('projeto.edit');
        Route::patch('/edit/{id}', [ProjetoController::class, 'update'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.update')])->name('projeto.update');
        Route::delete('/{id}', [ProjetoController::class, 'destroy'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.delete')])->name('projeto.destroy');
        // Orçamentos
        Route::prefix('/{id_projeto}/orcamentos')->group(function (){
            Route::get('/', [ProjetoOrcamentoController::class, 'index'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.read')])->name('projeto.orcamento.index');
            Route::post('/', [ProjetoOrcamentoController::class, 'store'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.create')])->name('projeto.orcamento.store');
            Route::get('/create', [ProjetoOrcamentoController::class, 'create'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.create')])->name('projeto.orcamento.create');
            Route::get('/edit/{id}', [ProjetoOrcamentoController::class, 'edit'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.update')])->name('projeto.orcamento.edit');
            Route::patch('/edit/{id}', [ProjetoOrcamentoController::class, 'update'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.update')])->name('projeto.orcamento.update');
            Route::delete('/{id}', [ProjetoOrcamentoController::class, 'destroy'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.delete')])->name('projeto.orcamento.destroy');
            // Despesas
            Route::prefix('{id_orcamento}/despesas')->group(function (){
                Route::get('/', [ProjetoOrcamentoDespesaController::class, 'index'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.read')])->name('projeto.orcamento.despesa.index');
                Route::post('/', [ProjetoOrcamentoDespesaController::class, 'store'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.create')])->name('projeto.orcamento.despesa.store');
                Route::get('/create', [ProjetoOrcamentoDespesaController::class, 'create'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.create')])->name('projeto.orcamento.despesa.create');
                Route::get('/edit/{id}', [ProjetoOrcamentoDespesaController::class, 'edit'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.update')])->name('projeto.orcamento.despesa.edit');
                Route::patch('/edit/{id}', [ProjetoOrcamentoDespesaController::class, 'update'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.update')])->name('projeto.orcamento.despesa.update');
                Route::delete('/{id}', [ProjetoOrcamentoDespesaController::class, 'destroy'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('projeto.orcamento.delete')])->name('projeto.orcamento.despesa.destroy');
            });
        });
    });

    // Users routes
    Route::prefix('users')->group(function () {
        Route::get('/json', [UserController::class, 'json']);
        Route::get('/', [UserController::class, 'index'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('user.read')])->name('user.index');
        Route::post('/', [UserController::class, 'store'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('user.create')])->name('user.store');
        Route::get('/create', [UserController::class, 'create'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('user.create')])->name('user.create');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('user.update')])->name('user.edit');
        Route::patch('/edit/{id}', [UserController::class, 'update'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('user.update')])->name('user.update');
        Route::patch('/perfil/{id}', [UserController::class, 'permissionUpdate'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('user.update')])->name('user.update.permission');
        Route::get('/perfil/{id}', [UserController::class, 'permission'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('user.update')])->name('user.permission');
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware([\Illuminate\Auth\Middleware\Authorize::using('user.delete')])->name('user.destroy');
    });
});

require __DIR__.'/auth.php';
