<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use app\Models\Tracking_log;
use Illuminate\Database\Eloquent\Model;

class Tracking_log extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "registration_date",
        "habit_state", 
        
    ];
}
