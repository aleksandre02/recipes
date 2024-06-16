<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('category_recipe', function (Blueprint $table) {
            $table->id('category_recipe_id');
            $table->foreignId('categories_id')->constrained('categories','categories_id')->onDelete('cascade');
            $table->foreignId('recipe_id')->constrained('recipes','recipe_id')->onDelete('cascade');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('category_recipe');
    }

    
};

