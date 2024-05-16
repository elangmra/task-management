@extends('layouts.dashboard')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-5">
    <h2 class="text-dark fw-semibold mb-0">Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="bx bx-plus"></i> Add User
    </a>
</div>
<div class="card border-0">
    <div class="card-body p-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-light rounded-circle p-2" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"
                                        style="width: 34px; height: 34px">
                                        <i class='bx bx-dots-horizontal-rounded'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" style="z-index: 100;">
                                        <li><a class="dropdown-item" href="{{ route('users.edit',$user->id) }}">Edit</a></li>
                                        <li>
                                            <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit">Hapus</button>
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
