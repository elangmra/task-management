<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskAssign;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create($id){
        return view('pages.projects.tasks.create',[
            'project' => Project::findOrFail($id)
        ]);
    }

    public function store(Request $request){
        $data = $request->all();
        $task = Task::create($data);
        $data['status'] = 'To Do';
        if($request->has('assignments')){
            foreach($request->assignments as $assignId){
                TaskAssign::create([
                    'task_id' => $task->id,
                    'user_id' => $assignId
                ]);
            }
        }

        return redirect()->route('projects.show',$request->project_id);
    }

    public function edit($project_id, $task_id){
        return view('pages.projects.tasks.edit',[
            'project' => Project::findOrFail($project_id),
            'task' => Task::findOrFail($task_id),
        ]);
    }
    public function update(Request $request, $id){
        $data = $request->all();
        if($request->has('status')){
            Task::findOrFail($id)->update(['status' => $request->status]);
            return back();
        }else{
            $task = Task::findOrFail($id);
            $task->update($data);

            $task->assigns()->delete();

            if($request->has('assignments')){
                foreach($request->assignments as $assignId){
                    TaskAssign::create([
                        'task_id' => $task->id,
                        'user_id' => $assignId
                    ]);
                }
            }
            return redirect()->route('projects.show',$task->project->id);
        }

    }

    public function destroy(string $id)
    {
        Task::find($id)->delete();
        return back();
    }
}
