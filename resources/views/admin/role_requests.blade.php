@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pending Role Requests</h2>

    @if($roleRequests->isEmpty())
        <div class="alert alert-info">No pending role requests.</div>
    @endif

    <table class="table">
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

                    {{-- Display CV File with Correct Link --}}
                    <td>
                        @if(!empty($request->cv_file))
                            <a href="{{ asset('storage/' . $request->cv_file) }}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-file"></i> View CV
                            </a>
                        @else
                            <span class="text-muted">No CV uploaded</span>
                        @endif
                    </td>

                    <td>
                        <form method="POST" action="{{ route('role.request.update', $request->id) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-check"></i> Approve
                            </button>
                        </form>

                        <form method="POST" action="{{ route('role.request.update', $request->id) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-times"></i> Reject
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
