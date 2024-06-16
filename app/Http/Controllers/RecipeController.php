<?php

namespace App\Http\Controllers;
use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use Illuminate\Http\Request;
    


class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }
    public function store(RecipeRequest $request)
    {
        // Create a new recipe instance with validated data
        $recipe = new Recipe($request->validated());

        // Handle file upload if present
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $recipe->photo = $path;
        }

        // Save the recipe to the database
        $recipe->save();

        // Redirect to the recipes index page
        return redirect()->route('recipes.index');
    }
    
    // public function store(Request $request)
    // {
    //     $recipe = new Recipe();
    //     $recipe->name = $request->name;
    //     $recipe->description = $request->description;
    //     $recipe->save();

    //     // Save other details like ingredients, steps, etc.

    //     return redirect()->route('recipes.index');
    // }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->name = $request->name;
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
