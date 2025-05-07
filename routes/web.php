<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomizationController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Rutas para admin.users.index
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::view('admin/roles', 'admin.roles.index')
        ->middleware(['role:admin|root'])
        ->name('admin.roles.index');
    Route::redirect('settings', 'settings/profile');

    // Playground solo para root
    Route::get('playground', \App\Http\Controllers\PlaygroundController::class)
        ->name('playground');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Route::get('settings/customization', CustomizationController::class)->name('settings.customization');

});

// Página estática: About
use App\Http\Controllers\PageController;

Route::get('about', fn() => app(\App\Http\Controllers\PageController::class)->show('about'))->name('about');

require __DIR__ . '/auth.php';
