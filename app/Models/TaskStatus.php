<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class TaskStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    public function dataTame()
    {
        return Carbon::parse($this->created_at)->format('d.m.Y');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'status_id', 'id');
    }
}
