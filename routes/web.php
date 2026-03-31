<?php

use App\Http\Controllers\SandboxController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
Route::prefix('sandbox')->group(function () {
    Route::get('/auth', [SandboxController::class, 'index']);
    Route::get('/public', [SandboxController::class, 'public']);
});
require __DIR__ . '/settings.php';
