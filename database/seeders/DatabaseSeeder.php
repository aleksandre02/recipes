<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Comment;
use App\Models\User;
use App\Models\Step;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        // Create users
        $user = User::create([
            'username' => 'john_doe',
            'email' => 'john@example2.com',
            'password' => bcrypt('password'),
            'privileges' => 'user',
        ]);

        // Create categories
        $vegetarianCategory = Category::create(['name' => 'Vegetarian']);
        $meatBasedCategory = Category::create(['name' => 'Meat-Based']);
        $dessertCategory = Category::create(['name' => 'Dessert']);

        // Create recipes
        $vegetarianRecipe = Recipe::create([
            'title' => 'Grilled Vegetables',
            'description' => 'Delicious grilled vegetables with herbs.',
            'media' => 'grilled_vegetables.jpg', // Assuming media is a string path
            'user_id' => $user->id,
        ]);
        $vegetarianRecipe->categories()->attach($vegetarianCategory->id);

        $meatRecipe = Recipe::create([
            'title' => 'Beef Steak',
            'description' => 'Juicy beef steak with garlic butter.',
            'media' => 'beef_steak.jpg', // Assuming media is a string path
            'user_id' => $user->id,
        ]);
        $meatRecipe->categories()->attach($meatBasedCategory->id);

        $dessertRecipe = Recipe::create([
            'title' => 'Chocolate Cake',
            'description' => 'Rich chocolate cake with ganache.',
            'media' => 'chocolate_cake.jpg', // Assuming media is a string path
            'user_id' => $user->id,
        ]);
        $dessertRecipe->categories()->attach($dessertCategory->id);

        // Create ingredients
        $zucchini = Ingredient::create(['name' => 'Zucchini', 'quantity' => '2']);
        $bellPepper = Ingredient::create(['name' => 'Bell Pepper', 'quantity' => '3']);
        $oliveOil = Ingredient::create(['name' => 'Olive Oil', 'quantity' => '2 tbsp']);
        $salt = Ingredient::create(['name' => 'Salt', 'quantity' => '1 tsp']);
        $pepper = Ingredient::create(['name' => 'Pepper', 'quantity' => '1 tsp']);

        $beefSteak = Ingredient::create(['name' => 'Beef Steak', 'quantity' => '500g']);
        $garlic = Ingredient::create(['name' => 'Garlic', 'quantity' => '2 cloves']);
        $butter = Ingredient::create(['name' => 'Butter', 'quantity' => '50g']);
        
        $flour = Ingredient::create(['name' => 'Flour', 'quantity' => '2 cups']);
        $cocoaPowder = Ingredient::create(['name' => 'Cocoa Powder', 'quantity' => '1 cup']);
        $sugar = Ingredient::create(['name' => 'Sugar', 'quantity' => '1.5 cups']);
        $eggs = Ingredient::create(['name' => 'Eggs', 'quantity' => '3']);

        // Attach ingredients to recipes
        $vegetarianRecipe->ingredients()->attach([
            $zucchini->id,
            $bellPepper->id,
            $oliveOil->id,
            $salt->id,
            $pepper->id
        ]);

        $meatRecipe->ingredients()->attach([
            $beefSteak->id,
            $garlic->id,
            $butter->id,
            $salt->id,
            $pepper->id
        ]);

        $dessertRecipe->ingredients()->attach([
            $flour->id,
            $cocoaPowder->id,
            $sugar->id,
            $butter->id,
            $eggs->id
        ]);

        // Create steps for each recipe
        $vegetarianRecipe->steps()->createMany([
            ['step_number' => 1, 'description' => 'Slice the zucchini and bell pepper.'],
            ['step_number' => 2, 'description' => 'Drizzle with olive oil, and season with salt and pepper.'],
            ['step_number' => 3, 'description' => 'Grill the vegetables for 5-7 minutes on each side.'],
        ]);

        $meatRecipe->steps()->createMany([
            ['step_number' => 1, 'description' => 'Season the beef steak with salt and pepper.'],
            ['step_number' => 2, 'description' => 'Heat butter in a pan and add garlic.'],
            ['step_number' => 3, 'description' => 'Cook the steak for 4-5 minutes on each side.'],
        ]);

        $dessertRecipe->steps()->createMany([
            ['step_number' => 1, 'description' => 'Preheat the oven to 350°F (175°C).'],
            ['step_number' => 2, 'description' => 'Mix flour, cocoa powder, and sugar.'],
            ['step_number' => 3, 'description' => 'Add butter and eggs, and mix until smooth.'],
            ['step_number' => 4, 'description' => 'Pour into a baking pan and bake for 30 minutes.'],
        ]);

        // Create comments for each recipe
        $vegetarianRecipe->comments()->createMany([
            ['body' => 'I love this recipe!', 'user_id' => $user->id, 'recipe_id' => $vegetarianRecipe->id],
            ['body' => 'Very healthy and tasty.', 'user_id' => $user->id, 'recipe_id' => $vegetarianRecipe->id],
        ]);

        $meatRecipe->comments()->createMany([
            ['body' => 'The steak was perfect!', 'user_id' => $user->id, 'recipe_id' => $meatRecipe->id],
            ['body' => 'Will definitely make this again.', 'user_id' => $user->id, 'recipe_id' => $meatRecipe->id],
        ]);

        $dessertRecipe->comments()->createMany([
            ['body' => 'Best chocolate cake ever!', 'user_id' => $user->id, 'recipe_id' => $dessertRecipe->id],
            ['body' => 'So rich and delicious.', 'user_id' => $user->id, 'recipe_id' => $dessertRecipe->id],
        ]);
       
    }
}
