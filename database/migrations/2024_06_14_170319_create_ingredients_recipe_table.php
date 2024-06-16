<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    
        public function up()
        {
            Schema::create('recipe_ingredients', function (Blueprint $table) {
                $table->id('recipe_ingredient_id');
                $table->foreignId('recipe_id')->constrained('recipes','recipe_id')->onDelete('cascade');
                $table->foreignId('ingredient_id')->constrained('ingredients','ingredient_id')->onDelete('cascade');
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('recipe_ingredients');
        }
    
    
};
