@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">User Management</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>
                                    <span class="badge {{ $user->role === 'Admin' ? 'bg-danger' : 'bg-primary' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->registration_date)
                                        {{ $user->registration_date->format('M d, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $user->is_approved ? 'bg-success' : 'bg-warning' }}">
                                        {{ $user->is_approved ? 'Approved' : 'Pending' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if(!$user->is_approved)
                                            <form action="{{ route('admin.approve', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Approve
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($user->role !== 'Admin')
                                            <form action="{{ route('admin.promote', $user->id) }}" method="POST" class="d-inline ms-1">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    Promote to Admin
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Site Statistics</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h6 class="card-title">Total Users</h6>
                            <h2 class="card-text">{{ $users->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h6 class="card-title">Approved Users</h6>
                            <h2 class="card-text">{{ $users->where('is_approved', true)->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h6 class="card-title">Pending Approvals</h6>
                            <h2 class="card-text">{{ $users->where('is_approved', false)->count() }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h6 class="card-title">Admin Users</h6>
                            <h2 class="card-text">{{ $users->where('role', 'Admin')->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
