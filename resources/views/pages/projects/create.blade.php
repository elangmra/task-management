@extends('layouts.dashboard')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-5">
    <h2 class="text-dark fw-semibold mb-0">Projects</h2>
    <a href="{{ route('projects.index') }}" class="btn btn-light">
        <i class="bx bx-arrow-back"></i> Back
    </a>
</div>
<div class="card border-0">
    <div class="card-body p-5">
        <form action="{{ route('projects.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="project_name">Project Name</label>
                <input type="text" name="project_name" id="project_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-select">
                    <option value="">Choice Priority</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control">
            </div>
            <div class="mb-3">
                <label for="assigns">Assigns</label>
                <div class="d-flex flex-wrap gap-2 form-control">
                    @foreach ($users as $user)
                        <div class="form-check">
                            <input class="form-check-input" name="assignments[]" type="checkbox" value="{{ $user->id }}" id="{{ $user->id }}">
                            <label class="form-check-label" for="{{ $user->id }}">
                                {{ $user->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Create a Project</button>
        </form>
    </div>
</div>
@endsection
