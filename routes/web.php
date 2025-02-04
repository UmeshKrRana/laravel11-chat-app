<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('chat/{id}', [UserController::class, 'chatUser'])->middleware(['auth', 'verified'])->name('chat');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
