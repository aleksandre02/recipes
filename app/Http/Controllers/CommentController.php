<?php

namespace App\Http\Controllers;
use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller {
  public function store(Request $request, Recipe $recipe)
  {
      $validated = $request->validate([
        'body' => 'required|string|max:255',
      ]);

      // Find the recipe by ID
      $recipe = Recipe::findOrFail($recipe->id);

      // Create a new comment
      $comment = new Comment();
      $comment->body = $validated['body'];
      $comment->user_id = auth()->id();
      $comment->recipe_id = $recipe->id;
      $comment->save();

      // Redirect back to the recipe detail page
      return redirect()->route('recipes.show', $recipe->id)->with('success', 'Comment added successfully!');
  }
}
