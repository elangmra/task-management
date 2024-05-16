@extends('layouts.dashboard')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-5">
    <h2 class="text-dark fw-semibold mb-0">Edit Projects</h2>
    <a href="{{ route('projects.index') }}" class="btn btn-light">
        <i class="bx bx-arrow-back"></i> Back
    </a>
</div>
<div class="card border-0">
    <div class="card-body p-5">
        <form action="{{ route('projects.update',$project->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="project_name">Project Name</label>
                <input type="text" name="project_name" id="project_name" class="form-control" value="{{ $project->project_name }}">
            </div>
            <div class="mb-3">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-select">
                    <option value="">Choice Priority</option>
                    <option value="High" {{ $project->priority =='High' ? 'selected' : '' }}>High</option>
                    <option value="Medium" {{ $project->priority =='Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Low" {{ $project->priority =='Low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $project->due_date }}">
            </div>
            <div class="mb-3">
                <label for="assigns">Assigns</label>
                <div class="d-flex flex-wrap gap-2 form-control">
                    @foreach ($users as $user)
                        <div class="form-check">
                            <input class="form-check-input" name="assignments[]" type="checkbox" value="{{ $user->id }}" id="user-{{ $user->id }}" {{ $project->users->contains($user->id) ? 'checked': '' }}>
                            <label class="form-check-label" for="user-{{ $user->id }}">
                                {{ $user->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Update a Project</button>
        </form>
    </div>
</div>
@endsection
