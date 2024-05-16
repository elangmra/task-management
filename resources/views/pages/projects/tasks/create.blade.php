@extends('layouts.dashboard')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-5">
    <h2 class="text-dark fw-semibold mb-0">Add New Task</h2>
    <a href="{{ route('projects.show',$project->id) }}" class="btn btn-light">
        <i class="bx bx-arrow-back"></i> Back
    </a>
</div>
<div class="card border-0">
    <div class="card-body p-5">
        <form action="{{ route('tasks.store') }}" method="post">
            @csrf

            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <div class="mb-3">
                <label for="task_name">Task Name</label>
                <input type="text" name="task_name" id="task_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control">
            </div>
            <div class="mb-3">
                <label for="assigns">Assigns</label>
                <div class="d-flex flex-wrap gap-2 form-control">
                    @foreach ($project->assigns as $assign)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="assignments[]" value="{{ $assign->user_id }}" id="{{ $assign->user_id }}">
                            <label class="form-check-label" for="{{ $assign->user_id }}">
                                {{ $assign->user->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Create a Task</button>
        </form>
    </div>
</div>
@endsection
