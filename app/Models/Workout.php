<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_date',
        'exercise',
        'weight',
        'reps',
        'sets',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
