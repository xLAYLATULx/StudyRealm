<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $table  = 'goal';

    protected $fillable = [
        'userID',
        'goalName',
        'description',
        'progress',
        'deadline',
        'completed',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'goalID');
    }
}
