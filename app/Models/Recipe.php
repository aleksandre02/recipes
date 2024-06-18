<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'media', 'user_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_recipe');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_recipe');
    }

    public function steps() {
        return $this->hasMany(Step::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // Define other relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
