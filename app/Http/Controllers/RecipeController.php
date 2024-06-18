<?php

namespace App\Http\Controllers;
// use App\Http\Requests\RecipeRequest;
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
            'description' => 'required|string|max:4000'
        ]);

        $recipe = new Recipe();

        // Handle file upload if present
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $recipe->media = $path;
        }

        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->user_id = auth()->id();
        // Save the recipe to the database
        $recipe->save();

        // Handle ingredients
        $ingredients = explode("\n", $request->input('ingredients'));
        foreach ($ingredients as $ingredient) {
            list($name, $quantity) = explode('-', $ingredient);

            // Assuming Ingredient model has a name and recipe_id
            $recipe->ingredients()->create(
                [
                    'name' => $name,
                    'quantity' => $quantity
                ]
            );
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
        $recipe->delete();

        return redirect()->route('recipes.index');
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.show', compact('recipe'));
        
    }
    public function search(Request $request)
    {
    $query = Recipe::query();

    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    // Add more filters based on the request

    $recipes = $query->get();
    return view('recipes.index', compact('recipes'));
    }




}
