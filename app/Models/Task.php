<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{TaskStatus, Label, User};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Task extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "status_id", "created_by_id", "assigned_to_id"];

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'label_task', 'task_id', 'label_id');
    }
}
