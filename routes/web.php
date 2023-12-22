<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\authorizeResource;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página inicial
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

// Área protegida por autenticação
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Autenticação OAuth2
Route::prefix('oauth')->name('oauth.')->group(function () {
    Route::get('/login', function () {
        // ... lógica da rota de login OAuth2 ...
    })->name('login');

    Route::get('/auth/callback', function (Request $request) {
        // ... lógica da rota de callback OAuth2 ...
    });
});

Route::get('/authorize', [authorizeResource::class, 'authorize'])->name('authorize');

// Inclusão das rotas de autenticação padrão do Laravel
require __DIR__.'/auth.php';
