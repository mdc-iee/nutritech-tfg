<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function create() {
        $ingredients = Ingredient::all();
        return view('recipeForm', compact('ingredients'));
    }

    public function storeIngredient(Request $request) {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'ingredients_existing' => 'nullable|array',
        ]);

        $recipe = Recipe::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
            'description' => $request->description,
            'instructions' => $request->instructions,
        ]);

        // The existing ingredients are associated
        foreach ($request->input('ingredients_existing', []) as $item) {
            if (is_numeric($item)) {
                // Ingrediente existente
                $recipe->ingredients()->attach($item);
            } else {
                // Nuevo ingrediente
                $ingredient = Ingredient::firstOrCreate([
                    'name' => trim($item),
                ]);
                $recipe->ingredients()->attach($ingredient->id);
            }
        }

        return redirect()->route('home')->with('success', 'Receta creada correctamente');
    }
}
