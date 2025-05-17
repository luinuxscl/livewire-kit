<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\RoleController;

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
});

// Rutas solo para autenticados y con roles admin o root, con prefix admin
Route::middleware(['auth', 'verified', 'role:admin|root'])->prefix('admin')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::view('roles', 'admin.roles.index')->name('admin.roles.index');

    Route::get('playground', \App\Http\Controllers\PlaygroundController::class)->name('playground');

    Route::get('/customization', CustomizationController::class)->name('customization');
});

// Página estática: About
use App\Http\Controllers\PageController;

Route::get('about', fn() => app(\App\Http\Controllers\PageController::class)->show('about'))->name('about');

require __DIR__ . '/auth.php';
