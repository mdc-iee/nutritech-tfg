<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function create() {
        $ingredients = Ingredient::all();
        return view('recipeForm', compact('ingredients'));
    }

    public function storeIngredient(Request $request) {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'instructions' => 'required|string',
            'ingredients_existing' => 'required|array',
            'recipe_image' => 'required|image',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 50 caracteres.',
        
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
        
            'instructions.required' => 'Las instrucciones son obligatorias.',
            'instructions.string' => 'Las instrucciones deben ser una cadena de texto.',
        
            'ingredients_existing.required' => 'Los ingredientes son obligatorios.',

            'recipe_image.required' => 'La imagen de la receta es obligatoria.',
        ]);

        // To obtain the original name of the file
        $originalName = $request->file('recipe_image')->getClientOriginalName();
        $filename = time() . '_' . $originalName;
        $path = $request->file('recipe_image')->storeAs('recipes', $filename, 'public');

        $recipe = Recipe::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
            'description' => $request->description,
            'instructions' => $request->instructions,
            'recipe_image' => $path,
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
        
        $recipe->save();
        return redirect()->route('home')->with('success', 'Receta creada correctamente');
    }

    public function update(Request $request, $id) {
        $recipe = Recipe::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string',
            'instructions' => 'required|string',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 50 caracteres.',
        
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
        
            'instructions.required' => 'Las instrucciones son obligatorias.',
            'instructions.string' => 'Las instrucciones deben ser una cadena de texto.'
        ]);

        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->instructions = $request->instructions;

        if ($request->hasFile('recipe_image')) {
            $originalName = $request->file('recipe_image')->getClientOriginalName();
            $filename = time() . '_' . $originalName;
            $path = $request->file('recipe_image')->storeAs('recipes', $filename, 'public');
            $recipe->recipe_image = $path;
        }

        $recipe->save();

        return redirect()->route('profile')->with('success', 'Receta actualizada correctamente');
    }

    public function destroy($id) {
        $recipe = Recipe::findOrFail($id);

        // Verifica que el usuario pueda eliminar esta receta
        if ($recipe->user_id !== auth()->id()) {
            abort(403);
        }

        $recipe->delete();

        return redirect()->route('profile')->with('success', 'Receta eliminada correctamente.');
    }
}
