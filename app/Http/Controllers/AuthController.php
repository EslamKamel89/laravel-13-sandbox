<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {
    public function login(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user =  User::where('email', $validated['email'])->first();
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw  ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }
        $token = $user->createToken($user->email)->plainTextToken;
        return response()->json([
            'token' => $token,
        ]);
    }
}
