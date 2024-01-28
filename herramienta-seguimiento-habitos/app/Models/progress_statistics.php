<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use app\Models\progress_statistics;
use Illuminate\Database\Eloquent\Model;

class progress_statistics extends Model
{
    use HasFactory;
    protected $fillable = [
        "date_hour",
        "user_id",
        
    ];
}
