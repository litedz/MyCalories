<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class food extends Model
{
    use HasFactory;

    protected $with = ['cat'];

    public function cat(): BelongsTo
    {
        return $this->belongsTo(categorie_food::class, 'categorie_food_id', 'id');
    }
}
