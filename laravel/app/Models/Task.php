<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = false;

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'label_tasks', 'task_id', 'label_id');
    }

    public function userExecutor()
    {
        return $this->belongsTo(User::class, 'user_executor_id', 'id');
    }

}