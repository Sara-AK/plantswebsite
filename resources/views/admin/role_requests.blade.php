@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pending Role Requests</h2>

    @foreach($requests as $request)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $request->user->name }} wants to become a {{ ucfirst($request->requested_role) }}</h5>

                <form method="POST" action="{{ route('role.request.update', $request->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>

                <form method="POST" action="{{ route('role.request.update', $request->id) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
