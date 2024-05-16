<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectAssign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $userId = Auth::user()->id;
            // Proceed with the rest of your logic using $userId
        } else {
            // Handle the case when the user is not authenticated
            return redirect()->route('login')->with('error', 'You must be logged in to access this page.');
        }
        if(Auth::user()->role == 'Owner'){
            $projects = Project::orderBy('id','desc')->get();
        }else{
            $projects = Project::orderBy('id','desc')->whereHas('assigns', function($query) use ($userId){
                $query->where('user_id', $userId);

            })->get(); // only show projects that belong to the authenticated user onl
        }
        return view ('pages.projects.index',[
            'projects' => $projects
        ]);
    }

    public function create(){
        return view('pages.projects.create',[
            'users' => User::all()
        ]);
    }

    public function store(Request $request){
        $data = $request->all();
        $project = Project::create($data);

        if($request->has('assignments')){
            foreach($request->assignments as $assignId){
                ProjectAssign::create([
                    'project_id' => $project->id,
                    'user_id' => $assignId
                ]);
            }
        }

        return redirect()->route('projects.index');
    }

    public function show(string $id){
        $project = Project::with('users')->findOrFail($id);
        return view('pages.projects.tasks.index', compact('project'));
    }

    public function edit(string $id){
        $project = Project::with('users')->findOrFail($id);
        $users = User::all();
        return view('pages.projects.edit', compact('project', 'users'));
    }

    public function update(Request $request, string $id){
        $data = $request->all();
        $project = Project::findOrFail($id);
        $project->update($data);

        $project->assigns()->delete();

        if($request->has('assignments')){
            foreach($request->assignments as $assignId){
                ProjectAssign::create([
                    'project_id' => $project->id,
                    'user_id' => $assignId
                ]);
            }
        }

        return redirect()->route('projects.index');
    }

    public function destroy(string $id)
    {
        Project::find($id)->delete();
        return back();
    }
}
