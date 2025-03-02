@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Gardener Requests</h2>
    <ul class="list-group">
        @foreach($requests as $request)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Gardener:</strong> {{ $request->gardener->name }}

                @if ($request->status === 'pending')
                    <span class="badge bg-warning">Pending</span>
                @elseif ($request->status === 'accepted')
                    <a href="{{ route('chat.index', $request->gardener->id) }}" class="btn btn-success btn-sm">
                        Go to Chat
                    </a>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
