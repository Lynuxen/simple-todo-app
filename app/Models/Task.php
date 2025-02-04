<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'completed',
        'todo_list_id',
    ];

    public function list(): BelongsTo
    {
        return $this->belongsTo(TodoList::class, 'todo_list_id');
    }
}
