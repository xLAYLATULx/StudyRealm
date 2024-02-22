<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Goal;

class Task extends Model
{
    use HasFactory;
    protected $table  = 'task';

    protected $fillable = [
        'userID',
        'categoryID',
        'taskName',
        'description',
        'priority',
        'dueDate',
        'progress',
        'completed',
        'goalID',
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
