<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = ['step_number', 'description', 'recipes_id'];
    
    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }
}
