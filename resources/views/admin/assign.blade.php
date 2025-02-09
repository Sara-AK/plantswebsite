@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Assign Admin Role</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.assign.post') }}">
        @csrf
        <div class="mb-3">
            <label for="user" class="form-label">Select User:</label>
            <select class="form-select" name="user_id" id="user" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Admin</button>
    </form>
</div>
@endsection
