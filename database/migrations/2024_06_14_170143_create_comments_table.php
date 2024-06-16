<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up()
        {
            Schema::create('comments', function (Blueprint $table) {
                $table->id('comment_id');
                $table->foreignId('user_id')->constrained('users','user_id');
                $table->foreignId('recipe_id')->constrained('recipes','recipe_id');
                $table->text('description');
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('comments');
        }
    
};
