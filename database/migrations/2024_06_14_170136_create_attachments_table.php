<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration

{
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id('attachment_id');
            $table->foreignId('recipe_id')->constrained('recipes','recipe_id');
            $table->string('media');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attachments');
    }
};
