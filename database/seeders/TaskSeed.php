<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskAssign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'project_id' => 1,
            'task_name' => 'Create a new design',
            'status' => 'Completed',
            'due_date' => '2024-05-16'

        ]);

        TaskAssign::create([
            'task_id' => 1,
            'user_id' => 1
        ]);
    }
}
