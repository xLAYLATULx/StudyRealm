<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table  = 'schedule';
    use HasFactory;

    protected $fillable = [
        'userID',
        'title',
        'description',
        'startDate',
        'endDate',
        'isGoal',
        'isTask',
    ];
}
