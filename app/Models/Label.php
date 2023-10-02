<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = false;

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'label_tasks', 'label_id', 'task_id');
    }
}