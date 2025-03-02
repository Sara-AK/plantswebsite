@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chat with {{ $gardener->name }}</h2>

    <div class="chat-box" style="border: 1px solid #ccc; padding: 10px; height: 300px; overflow-y: auto; margin-bottom: 20px;">
        @foreach($messages as $message)
            <div style="margin-bottom: 10px; {{ $message->sender_id == auth()->id() ? 'text-align: right;' : '' }}">
                <strong>{{ $message->sender_id == auth()->id() ? 'You' : $gardener->name }}:</strong>
                <p>{{ $message->message }}</p>
            </div>
        @endforeach
    </div>

    <form action="{{ route('chat.store', $gardener->id) }}" method="POST" class="mt-3">
        @csrf
        <textarea name="message" class="form-control" placeholder="Type your message..." required style="height: 100px; resize: none;"></textarea>
        <button type="submit" class="btn btn-success mt-2" style="background-color: #4BAF47; border: none; width: 100%; padding: 10px;">Send</button>
    </form>
</div>
@endsection
