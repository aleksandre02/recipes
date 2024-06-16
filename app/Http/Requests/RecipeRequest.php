<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
{
    

    
    
        public function authorize()
        {
            return true; // Set to true to allow all users
        }
    
        public function rules()
        {
            return [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // Add other validation rules as needed
            ];
        }
    
    
    public function store(RecipeRequest $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Add other validation rules as needed
        ]);
    
        // Create a new recipe instance with validated data
        $recipe = new RecipeRequest($validatedData);
    
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
    

}
