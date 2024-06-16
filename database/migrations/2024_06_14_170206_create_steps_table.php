<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

    {
        public function up()
        {
            Schema::create('steps', function (Blueprint $table) {
                $table->id('step_id');
                $table->integer('step_number');
                $table->text('description');
                $table->foreignId('recipe_id')->constrained('recipes','recipe_id');
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('steps');
        }
    };
    