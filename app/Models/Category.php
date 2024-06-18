<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cuisine_type'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'category_recipe');
    }

    // Define other relationships
}
