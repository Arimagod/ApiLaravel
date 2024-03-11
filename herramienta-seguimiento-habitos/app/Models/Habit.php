<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use app\Models\Habit;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = [
        "description",
        "user_id",
        "habit_type_id", 
        "frequency_id",
        "status_id",                          
                         
    ];
    public function habit_type(){
        return $this->belongsTo(Habit_type::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function frequency(){
        return $this->belongsTo(Frequency::class);
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }
    
}
