@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Users</h2>

    {{-- Register User Form --}}
    <div class="card mb-4">
        <div class="card-header">Register New User</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.user.register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Select Role</label>
                    <select class="form-select" name="role" id="role" required>
                        <option value="user">User</option>
                        <option value="gardener">Gardener</option>
                        <option value="seller">Seller</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success"><i class="fa-solid fa-user-plus"></i> Register User</button>
            </form>
        </div>
    </div>

    {{-- Role Requests Section --}}
    <h3>Pending Role Requests</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Requested Role</th>
                <th>Request Note</th>
                <th>CV File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roleRequests as $request)
                <tr>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ ucfirst($request->requested_role) }}</td>

                    {{-- Display Request Note --}}
                    <td>
                        @if(!empty($request->request_note))
                            {{ $request->request_note }}
                        @else
                            <span class="text-muted">No note provided</span>
                        @endif
                    </td>

                    {{-- Display CV File --}}
                    <td>
                        @if(!empty($request->cv_file))
                            <a href="{{ asset('storage/' . $request->cv_file) }}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-file"></i> View CV
                            </a>
                        @else
                            <span class="text-muted">No CV uploaded</span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td>
                        <form method="POST" action="{{ route('admin.role.request.update', $request->id) }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i> Approve</button>
                        </form>

                        <form method="POST" action="{{ route('admin.role.request.update', $request->id) }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-ban"></i> Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- User List --}}
    <h3>All Users</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>

                    {{-- Actions --}}
                    <td>
                        {{-- Assign Admin Button (Only for non-admins) --}}
                        @if($user->role !== 'admin')
                            <form method="POST" action="{{ route('admin.user.assignAdmin', $user->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-user-shield"></i> Assign Admin</button>
                            </form>
                        @endif

                        {{-- Change Role Button (Only for non-admins) --}}
                        @if($user->role !== 'admin')
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changeRoleModal{{ $user->id }}">
                                <i class="fa-solid fa-exchange-alt"></i> Change Role
                            </a>

                            {{-- Change Role Modal --}}
                            <div class="modal fade" id="changeRoleModal{{ $user->id }}" tabindex="-1" aria-labelledby="changeRoleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="changeRoleModalLabel">Change Role for {{ $user->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('admin.user.changeRole', $user->id) }}">
                                                @csrf
                                                <label for="new_role">Select New Role:</label>
                                                <select name="new_role" class="form-select">
                                                    <option value="user">User</option>
                                                    <option value="gardener">Gardener</option>
                                                    <option value="seller">Seller</option>
                                                </select>
                                                <button type="submit" class="btn btn-success mt-2">
                                                    <i class="fa-solid fa-check"></i> Update Role
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Delete Button (Only for non-admins) --}}
                        @if($user->role !== 'admin')
                            <form method="POST" action="{{ route('admin.user.delete', $user->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
