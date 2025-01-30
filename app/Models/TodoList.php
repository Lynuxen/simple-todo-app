<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TodoList extends Model
{
    protected $fillable = [
        'title',
        'completed',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function isCompleted()
    {
        return $this->tasks->every(function ($task) {
            return $task->completed;
        });
    }
}
