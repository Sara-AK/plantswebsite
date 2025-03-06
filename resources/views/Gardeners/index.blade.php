@extends('layouts.app')

@section('content')
    <section class="team-three pt-130 pb-130">
        <div class="container">
            <div class="row g-4">
                @if (auth()->user()->role === 'gardener')
                    <h2 class="text-center mb-5">Requests from Users</h2>
                    @foreach ($requests as $request)
                        <div class="col-lg-4 col-md-6">
                            <div class="team-three__item border rounded shadow-sm p-4 text-center">
                                <h3 class="mb-2">{{ $request->user->name }}</h3>
                                <span class="text-muted d-block mb-3">wants to contact you</span>
                                <div>
                                    @if ($request->status === 'accepted')
                                        <a href="{{ route('chat.index', $request->user->id) }}"
                                            class="btn btn-success btn-sm">Go to Chat</a>
                                    @else
                                        <form action="{{ route('request.accept', $request->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">Accept Request</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2 class="text-center mb-5">Available Gardeners</h2>
                    @foreach ($gardeners as $gardener)
                        @php
                            $existingRequest = \App\Models\GardenerRequest::where('user_id', auth()->id())
                                ->where('gardener_id', $gardener->id)
                                ->first();
                        @endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="team-three__item border rounded shadow-sm p-4 text-center">
                                <h3 class="mb-2">{{ $gardener->name }}</h3>
                                <span class="text-muted d-block mb-3">{{ $gardener->email }}</span>
                                <div>
                                    @if ($existingRequest && $existingRequest->status === 'accepted')
                                        <a href="{{ route('chat.index', $gardener->id) }}" class="btn btn-success btn-sm">Go
                                            to Chat</a>
                                    @else
                                        <form action="{{ route('request.gardener', $gardener->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm"
                                                style="background-color: #4BAF47; border: none;"
                                                {{ $existingRequest ? 'disabled' : '' }}>Request</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
