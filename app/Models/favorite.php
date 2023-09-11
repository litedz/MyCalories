<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'food_id'];

    public function food()
    {
        return $this->belongsTo(food::class);
    }
}
