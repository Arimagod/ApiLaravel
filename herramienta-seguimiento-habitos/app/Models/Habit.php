<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use app\Models\Habit;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "user_id",
        "habit_type_id", 
        "frequency_id",
        "status_id",                          
                         
    ];
}
