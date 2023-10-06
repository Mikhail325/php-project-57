<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = false;

    public function created_at() 
    {
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id', 'id');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'label_tasks', 'task_id', 'label_id');
    }

    public function userExecutor()
    {
        return $this->belongsTo(User::class, 'assigned_to_id', 'id');
    }

    public function userAuthor()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }
}
