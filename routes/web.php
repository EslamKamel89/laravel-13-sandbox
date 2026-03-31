<?php

use App\Http\Controllers\SandboxController;
use App\Jobs\TestJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});
Route::prefix('sandbox')->group(function () {
    Route::get('/auth', [SandboxController::class, 'index']);
    Route::get('/public', [SandboxController::class, 'public']);
    Route::get('/test-job', function () {
        TestJob::dispatch();
        return response()->json([
            'message' => 'job dispatched',
        ]);
    });

    Route::post('/validation/{id}', function (Request $request, $id) {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'page' => ['required', 'integer', 'min:1'],
            'limit' => ['required', 'integer', 'min:1'],
        ]);
        $pathParams = validator(
            ['id' => $id],
            ['id' => 'required|integer|min:1']
        )->validate();
        return response()->json([
            'body_and_query_data' => $validated,
            'path_params' => $pathParams,
        ]);
    });
});
require __DIR__ . '/settings.php';
