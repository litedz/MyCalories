<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_list extends Model
{
    use HasFactory;

    protected $guarded;
    protected $casts = [

    ];

    // protected $with =['user','food'];
    protected $fillable = ['user_id', 'food_id', 'kcal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function food()
    {
        return $this->belongsTo(food::class);
    }
}
