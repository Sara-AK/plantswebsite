@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Role Request Management</h2>

    @php
        $roleRequest = \App\Models\RoleRequest::where('user_id', Auth::id())->latest()->first();
    @endphp

    @if($roleRequest)
        <div class="alert alert-info">
            Your current request: <strong>{{ ucfirst($roleRequest->requested_role) }}</strong> (Status: <strong>{{ ucfirst($roleRequest->status) }}</strong>)
        </div>

        @if($roleRequest->status === 'pending')
            <form method="POST" action="{{ route('role.request.cancel') }}">
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fa-solid fa-ban"></i> Cancel Request</button>
            </form>

            <form method="POST" action="{{ route('role.request.modify') }}" class="mt-3">
                @csrf
                <input type="hidden" name="current_request_id" value="{{ $roleRequest->id }}">
                <label for="requested_role">Modify Request:</label>
                <select name="requested_role" class="form-select">
                    <option value="gardener" @if($roleRequest->requested_role == 'gardener') selected @endif>Gardener</option>
                    <option value="seller" @if($roleRequest->requested_role == 'seller') selected @endif>Seller</option>
                </select>
                <button type="submit" class="btn btn-primary mt-2"><i class="fa-solid fa-edit"></i> Modify Request</button>
            </form>
        @endif
    @else
        <div class="alert alert-warning">
            You have not submitted any role request.
        </div>

        <form method="POST" action="{{ route('role.request') }}">
            @csrf
            <label for="requested_role">Select Role:</label>
            <select name="requested_role" class="form-select">
                <option value="gardener">Gardener</option>
                <option value="seller">Seller</option>
            </select>
            <button type="submit" class="btn btn-success mt-2"><i class="fa-solid fa-user-plus"></i> Request Role</button>
        </form>
    @endif
</div>
@endsection
