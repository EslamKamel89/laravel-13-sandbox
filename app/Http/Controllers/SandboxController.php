<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Authorize;
use Illuminate\Routing\Attributes\Controllers\Middleware;

class SandboxController extends Controller {
    #[Middleware('auth')]
    #[Authorize('admin-only')]
    public function index() {
        return response()->json([
            'message' => 'Authenticated user'
        ]);
    }
    public function public() {
        return response()->json([
            'message' => 'Public endpoint'
        ]);
    }
}
