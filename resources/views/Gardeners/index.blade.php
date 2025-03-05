@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Contact a Gardener</h2>

    @if(auth()->user()->role === 'gardener')
        <h3>Requests from Users</h3>
        <ul class="list-group">
            @foreach($requests as $request)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $request->user->name }} wants to contact you.

                @if($request->status === 'accepted')
                    <a href="{{ route('chat.index', $request->user->id) }}" class="btn btn-success btn-sm">
                        Go to Chat
                    </a>
                @else
                    <form action="{{ route('request.accept', $request->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">
                            Accept Request
                        </button>
                    </form>
                @endif
            </li>
        @endforeach
        </ul>

    @else
        <h3>Available Gardeners</h3>
        <ul class="list-group">
            @foreach($gardeners as $gardener)
            @php
                $existingRequest = \App\Models\GardenerRequest::where('user_id', auth()->id())
                    ->where('gardener_id', $gardener->id)
                    ->first();
            @endphp

            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $gardener->name }} - {{ $gardener->email }}

                @if ($existingRequest && $existingRequest->status === 'accepted')
                    <a href="{{ route('chat.index', $gardener->id) }}" class="btn btn-success btn-sm">
                        Go to Chat
                    </a>
                @else
                    <form action="{{ route('request.gardener', $gardener->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm" style="background-color: #4BAF47; border: none;"
                            {{ $existingRequest ? 'disabled' : '' }}>
                            Request
                        </button>
                    </form>
                @endif
            </li>
        @endforeach
        </ul>
    @endif
</div>
@endsection
