<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardio extends Model
{
    use HasFactory;

    protected $fillable = [
        'cardio_date',
        'menu',
        'kcal',
        'distance_km',
        'duration_min',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
