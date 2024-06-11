@extends('layouts.dashboard')
@section('content')
<div class="mb-5">
    <div class="d-flex align-items-center gap-2 mb-3">
        <a href="{{ route('projects.index') }}" class="btn btn-light">
            <i class="bx bx-arrow-back"></i>
        </a>
        <h2 class="text-dark fw-semibold mb-0">{{ $project->project_name }}</h2>
    </div>
    <div class="card border-0">
        <div class="card-body">
            <table class="table">
                <tr class="align-middle">
                    <td class="text-secondary">Priority</td>
                    <td>
                        @if ($project->priority == 'High')
                            <span class="badge bg-danger fs-8 text-uppercase">{{ $project->priority }}</span>
                        @elseif ($project->priority == 'Medium')
                            <span class="badge bg-primary fs-8 text-uppercase">{{ $project->priority }}</span>
                        @else
                            <span class="badge bg-secondary fs-8 text-uppercase">{{ $project->priority }}</span>

                        @endif
                    </td>
                </tr>
                <tr class="align-middle">
                    <td class="text-secondary">Due Date</td>
                    <td>{{ $project->due_date }}</td>
                </tr>
                <tr class="align-middle">
                    <td class="text-secondary">Assignees</td>
                    <td>
                        <div class="d-flex gap-2">
                            @foreach ($project->assigns as $assign)
                                <div class="d-flex align-items-center gap-1">
                                    <img src="https://ui-avatars.com/api/?name={{ $assign->user->name }}" alt=""
                                        class="rounded-circle" width="30">
                                    {{ $assign->user->name }}
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<a href="{{ route('projects.create-task',$project->id) }}" class="btn btn-primary mb-3" style="width: max-content">
    <i class="bx bx-plus"></i> Add New Task
</a>
<div class="card border-0">
    <div class="card-body p-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Task Name</th>
                        <th>Assigns</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project->tasks as $task)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $task->task_name }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    @foreach ($task->assigns as $assign)
                                        <img src="https://ui-avatars.com/api/?name={{ $assign->user->name }}" alt=""
                                            class="rounded-circle" width="30">
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $task->due_date }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if ($task->status == 'Completed')
                                        <span class="badge bg-success fs-8 text-uppercase">{{ $task->status }}</span>
                                    @elseif ($task->status == 'To Do')
                                        <span class="badge bg-secondary fs-8 text-uppercase">{{ $task->status }}</span>
                                    @else
                                        <span class="badge bg-primary fs-8 text-uppercase">{{ $task->status }}</span>

                                    @endif
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            Change Status
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <form action="{{ route('tasks.update',$task->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="To Do">
                                                    <button type="submit" class="dropdown-item" >To Do</button>

                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('tasks.update',$task->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="On Progress">
                                                    <button type="submit" class="dropdown-item" >On Progress</button>

                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('tasks.update',$task->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Completed">
                                                    <button type="submit" class="dropdown-item" >Completed</button>

                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light rounded-circle p-2" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"
                                        style="width: 34px; height: 34px">
                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('projects.edit-task',['project_id' =>$project->id,'task_id'=>$task->id]) }}">Edit</a></li>
                                        <li>
                                            <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" >Hapus</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    @endforeach

            </table>
        </div>
    </div>
</div>
@endsection
