<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->hasMany('App\Models\Task', 'status_id');
    }

    protected $fillable = ['name'];
}
