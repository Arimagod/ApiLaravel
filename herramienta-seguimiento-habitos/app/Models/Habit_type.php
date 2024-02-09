<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use app\Models\Habit_type;
use Illuminate\Database\Eloquent\Model;

class Habit_type extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "type",
    ];
}
