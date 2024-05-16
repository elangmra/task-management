@extends('layouts.dashboard')
@section('content')
<div class="d-flex align-items-center justify-content-between mb-5">
    <h2 class="text-dark fw-semibold mb-0">Edit User</h2>
    <a href="{{ route('users.index') }}" class="btn btn-light">
        <i class="bx bx-arrow-back"></i> Back
    </a>
</div>
<div class="card border-0">
    <div class="card-body p-5">
        <form action="{{ route('users.update',$user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
            </div>
            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="role">Role</label>
                <input type="text" name="role" id="role" class="form-control" value="{{ $user->role }}">
            </div>
            <button class="btn btn-primary" type="submit">Update a User</button>
        </form>
    </div>
</div>
@endsection
