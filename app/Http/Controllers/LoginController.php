<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request) {
        // Create user validating all the data
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'last_names' => 'nullable|string|max:70',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'age' => 'nullable|integer|min:0|max:120',
            'height' => 'nullable|integer|min:0|max:300',
            'weight' => 'nullable|integer|min:0|max:200',
            'diet' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'last_names' => $validated['last_names'],
            'age' => $validated['age'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'diet' => $validated['diet'],
        ]);

        Auth::login($user);

        return response()->json(['user' => $user]);
    }

    public function login(Request $request) {
        // Validate data before login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return response()->json([
                'message' => 'Credenciales incorrectas',
                'errors' => [
                    'email' => 'El correo electrónico o la contraseña son incorrectos.',
                ]
            ], 422);
        }

        return response()->json(['user' => Auth::user()]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Sesión cerrada']);
    }
}
