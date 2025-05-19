<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(Request $request) {
        /** 
         * @var \App\Models\User $user
         * This tells the IDE that $user is an instance of the User model,
         * so that methods like save(), delete(), etc., are recognized.
         */
        $user = Auth::user();

        $request->merge([
            'diet' => $request->has('diet') ? 1 : 0,
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'last_names' => 'nullable|string|max:70',
            // It will validate depending on the user id
            'email' => 'required|email|unique:users,email,' . $user->id,
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
        
            'age.integer' => 'La edad debe ser un número entero.',
            'age.min' => 'La edad debe ser un número positivo.',
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

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->fill($request->only([
            'name', 'last_names', 'email', 'age', 'height', 'weight', 'diet'
        ]));

        $user->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Perfil actualizado correctamente.']);
        }

        return redirect()->route('profile')->with('success', 'Perfil actualizado');
    }
}
