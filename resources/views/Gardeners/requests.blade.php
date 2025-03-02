@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Requests</h2>

    @if($requests->isEmpty())
        <p>No requests yet.</p>
    @else
        <ul class="list-group">
            @foreach($requests as $request)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $request->user->name }}</strong> ({{ $request->user->email }})
                        <br>
                        <small>Requested on {{ $request->created_at->format('d M Y, H:i') }}</small>
                    </div>

                    <div class="d-flex">
                        {{-- Accept Request Button --}}
                        <form method="POST" action="{{ route('requests.accept', $request->id) }}" class="me-2">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-check"></i> Accept Request
                            </button>
                        </form>

                        {{-- Open Chat Button (Visible only if the request is accepted) --}}
                        @if($request->status === 'accepted')
                            <a href="{{ route('chat.index', $request->user->id) }}" class="btn btn-primary btn-sm" style="background-color: #4BAF47; border: none;">
                                <i class="fa-solid fa-comments"></i> Open Chat
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
