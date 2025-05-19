<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request) {
        /** 
         * @var \App\Models\User $user
         * This tells the IDE that $user is an instance of the User model,
         * so that methods like save(), delete(), etc., are recognized.
         */
        $user = Auth::user();

        // Validations
        $request->validate([
            'name' => 'required|string|max:50',
            'last_names' => 'nullable|string|max:70',
            'email' => 'required|email|max:255',
            'age' => 'nullable|integer',
            'height' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'diet' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image',
        ]);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public'); //Ubication -> storage/app/public/profile_images
            $user->profile_image = $path;
        }

        $user->fill($request->only(['name', 'last_names', 'email', 'age', 'height', 'weight', 'diet']));
        $user->save();
        return redirect()->back()->with('success', 'Tu perfil ha sido actualizado correctamente');
    }

    public function show() {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
}
