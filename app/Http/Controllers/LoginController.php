<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request) {
        //Validate data from the user
        $request->validate([
            'name' => 'required|string|max:50',
            'last_names' => 'nullable|string|max:70',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'age' => 'nullable|integer|min:0|max:120',
            'height' => 'nullable|integer|min:0|max:300',
            'weight' => 'nullable|integer|min:0|max:200',
            'diet' => 'required|boolean',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 50 caracteres.',
        
            'last_names.string' => 'Los apellidos deben ser cadenas de texto.',
            'last_names.max' => 'Los apellidos no pueden tener más de 70 caracteres.',
        
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduzca un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',
        
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad no puede ser menor que 0.',
            'age.max' => 'La edad no puede ser mayor que 120.',
        
            'height.integer' => 'La altura debe ser un número entero.',
            'height.min' => 'La altura debe ser un número positivo.',
            'height.max' => 'La altura no puede ser mayor que 300 cm.',
        
            'weight.integer' => 'El peso debe ser un número entero.',
            'weight.min' => 'El peso debe ser un número positivo.',
            'weight.max' => 'El peso no puede ser mayor que 200 kg.',
        
            'diet.required' => 'El campo dieta es obligatorio.',
            'diet.boolean' => 'El campo dieta debe ser sí o no.',
        ]);

        //Create a new user
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->last_names = $request->last_names;
        $user->age = $request->age;
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->diet = $request->diet;

        $user->save();

        Auth::login($user);

        return redirect(route('privada'));
    }

    public function login(Request $request) {
        //Validate login credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduzca un correo electrónico válido.',
        
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de caracteres.',
        ]);

        $credentials = [
            "email" => $request->email, 
            "password" => $request->password,
        ];

        $remember = ($request->has('remember') ? true : false);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('privada'));
        } else {
            return redirect('login')->withErrors([
                'email' => 'Las credenciales no coinciden'
            ]);
        }
    }

    //Logs out and redirects to the login page
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
