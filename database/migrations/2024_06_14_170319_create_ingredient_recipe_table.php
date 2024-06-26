<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    
        public function up()
        {
            Schema::create('ingredient_recipe', function (Blueprint $table) {
                $table->id();
                $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('cascade');
                $table->foreignId('recipe_id')->constrained('recipes')->onDelete('cascade');
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('ingredient_recipe');
        }
    
    
};
