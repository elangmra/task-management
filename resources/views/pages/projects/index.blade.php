@extends('layouts.dashboard')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-5">
    <h2 class="text-dark fw-semibold mb-0">Projects</h2>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i> Add Project
    </a>
</div>
<div class="card border-0">
    <div class="card-body p-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Project Name</th>
                        <th>Priority</th>
                        <th>Due Date</th>
                        <th>Assigns</th>
                        <th>Progress</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="{{ route('projects.show',$project->id) }}">{{ $project->project_name }}</a></td>
                            <td>
                                <span class="badge bg-primary fs-8 text-uppercase">{{ $project->priority }}</span>
                            </td>
                            <td>{{ $project->due_date }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    @foreach ($project->assigns as $assign)
                                        <img src="https://ui-avatars.com/api/?name={{ $assign->user->name }}" alt=""
                                            class="rounded-circle" width="30">
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                @php
                                    $total_done = $project->tasks->where('status','Completed')->count();
                                    $total = $project->tasks->count();

                                    if($total != 0){
                                        $percentage_done = number_format(($total_done / $total) * 100,2);
                                    }else{
                                        $percentage_done = 0;
                                    }
                                @endphp
                                <div class="progress" role="progressbar" aria-label="Basic example"
                                    aria-valuenow="{{ $percentage_done }}" aria-valuemin="0" aria-valuemax="100"
                                    style="height: 10px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        style="width: {{ $percentage_done }}%"></div>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light rounded-circle p-2" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"
                                        style="width: 34px; height: 34px">
                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" style="z-index: 100;">
                                        <li><a class="dropdown-item" href="{{ route('projects.edit',$project->id) }}">Edit</a></li>
                                        <li>
                                            <form action="{{ route('projects.destroy',$project->id) }}" method="POST">
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
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
