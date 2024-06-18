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
    
   
}
