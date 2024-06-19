<?php

namespace App\Http\Controllers;
 use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('categories')->orderBy('created_at', 'desc')->get();
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        if (!Auth::check()) {
            abort(403);
        }

        return view('recipes.create');
    }

    public function store(Request $request) {
        // Create a new recipe instance with validated data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:4000',
            // 'media' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $recipe = new Recipe();

        // Handle file upload if present
        if ($request->hasFile('media')) {
            $path = $request->file('media')->store('photos', 'public');
            $recipe->media = $path;
        }

        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->user_id = auth()->id();
        // Save the recipe to the database
        $recipe->save();

        // Common units to recognize
        $common_units = ['G', 'KG', 'ML', 'L', 'Cup', 'Tablespoon', 'Teaspoon', 'Clove', 'Slice', 'Large', 'Small', 'Medium'];
        
        // Handle ingredients
        $ingredients = explode("\n", $request->input('ingredients'));
        foreach ($ingredients as $ingredient) {
            // Trim whitespace from the ingredient
            $ingredient = trim($ingredient);
        
            // Attempt to find a quantity and unit at the beginning of the string
            if (preg_match('/^(\d+\s*(' . implode('|', $common_units) . ')?)\s*(.*)$/i', $ingredient, $matches)) {
                // Quantity and unit
                $quantity = $matches[1];
                $name = $matches[3];
        
                // Create the ingredient in the database
                $recipe->ingredients()->create([
                    'name' => trim($name),
                    'quantity' => trim($quantity),
                ]);
            } else {
                // Handle the case where the ingredient does not have the expected format
                // For example, you might log this or throw an exception
                // Log::warning("Ingredient format incorrect: " . $ingredient);
                continue; // Skip the incorrectly formatted ingredient
            }
        }
        
        

        // Handle steps
        $steps = explode("\n", $request->input('steps'));
        foreach ($steps as $index => $step) {
            // Assuming Step model has a description, step_number and recipe_id
            $recipe->steps()->create(['description' => $step, 'step_number' => $index + 1]);
        }

        // Redirect to the recipes index page
        return redirect()->route('recipes.show', $recipe->id)->with('success', 'Recipe has been created successfully');
    }
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->save();

        // Update other details like ingredients, steps, etc.

        return redirect()->route('recipes.index');
    }

    public function destroy($id)
{
    $recipe = Recipe::findOrFail($id);

     // Optionally, you can add authorization logic here as well
        // if (auth()->user()->cannot('delete', $recipe)) {
        //     abort(403);
        // }
    
    if (!Auth::user()->is_admin) {
        return redirect()->route('recipes.index')->with('error', 'You are not authorized to delete this recipe');
    }
    // Delete related steps
    $recipe->steps()->delete();

    $recipe->comments()->delete();

    // Delete related ingredients
    $recipe->ingredients()->delete();

    // Delete the recipe
    $recipe->delete();

    return redirect()->route('recipes.index')->with('success', 'Recipe has been deleted successfully');
}


    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.show', compact('recipe'));
        
    }
    public function search(Request $request)
    {
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $recipe = Recipe::where('title', 'like', '%' . $keyword . '%')->first();
            
            if ($recipe) {
                return redirect()->route('recipes.show', $recipe->id);
            } else {
                return redirect()->route('recipes.index')->with('error', 'Recipe not found');
            }
        }

        return redirect()->route('recipes.index');
    

    // Add more filters based on the request

    // $recipes = $query->get();
    // return view('recipes.index', compact('recipes'));
    }




}       
