<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlaygroundController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    // Route::view('settings/api-tokens', 'settings.api-tokens')->name('settings.api-tokens');
    Volt::route('settings/api-tokens', 'settings.api-token')->name('settings.api-token');
});

// Rutas solo para autenticados y con roles admin o root, con prefix admin
Route::middleware(['auth', 'verified', 'role:admin|root'])->prefix('admin')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::view('roles', 'admin.roles.index')->name('admin.roles.index');

    Route::get('playground', PlaygroundController::class)->name('playground');
    Route::get('/playground/prompts', [PageController::class, 'prompts'])->name('prompts');
    Route::get('/customization', CustomizationController::class)->name('customization');
});

// Página estática: About
Route::get('about', fn() => app(PageController::class)->show('about'))
->middleware(['auth'])
->name('about');

require __DIR__ . '/auth.php';
