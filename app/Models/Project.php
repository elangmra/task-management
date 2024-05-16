<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['project_name', 'priority', 'due_date'];

    public function assigns()
    {
        return $this->hasMany(ProjectAssign::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_assigns', 'project_id', 'user_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
