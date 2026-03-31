<?php

use App\Http\Controllers\SandboxController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
Route::get('/test', [SandboxController::class, 'index']);
require __DIR__ . '/settings.php';
