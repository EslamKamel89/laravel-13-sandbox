<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Middleware;

class SandboxController extends Controller {
    #[Middleware('auth')]
    public function index() {
        return response()->json([
            'message' => 'hello world'
        ]);
    }
}
