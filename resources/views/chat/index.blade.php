@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="section-header text-center">
            <h5 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
            </h5>
            <h2 class="wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">Chat with {{ $gardener->name }}</h2>
        </div>

        <div id="chat-box" class="chat-box p-2 border rounded shadow-sm"
            style="height: 350px; overflow-y: auto; background-color: #f8f9fa;">
            @foreach ($messages as $message)
                <div
                    class="d-flex {{ $message->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }} mb-2">
                    <div class="p-2 rounded shadow-sm"
                        style="max-width: 75%; min-width: 200px; padding: 8px 12px;
                                background-color: {{ $message->sender_id == auth()->id() ? '#e6f7e6' : '#ffffff' }};
                                border: 1px solid #ddd; font-size: 14px;">
                        <strong class="d-block mb-1" style="color: #4BAF47; font-size: 13px;">
                            {{ $message->sender_id == auth()->id() ? 'You' : $gardener->name }}
                        </strong>
                        <p class="mb-0 text-dark" style="word-wrap: break-word;">{{ $message->message }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <form id="chat-form" action="{{ route('chat.store', $gardener->id) }}" method="POST" class="mt-2">
            @csrf
            <div class="input-group">
                <textarea name="message" id="message" class="form-control" placeholder="Type a message..." required
                    style="resize: none; font-size: 14px;"></textarea>
                <button type="submit" class="btn btn-success"
                    style="background-color: #4BAF47; border: none; font-size: 14px;">
                    Send
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Scroll the chat box to the bottom when the page loads or a new message is added
        function scrollToBottom() {
            var chatBox = document.getElementById('chat-box');
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        // Submit the form using AJAX and update the chat without reloading the page
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent page reload on form submit

            var message = document.getElementById('message').value;
            var formData = new FormData(this);

            fetch("{{ route('chat.store', $gardener->id) }}", {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Append the new message to the chat box
                    var messageHTML = `
                        <div class="d-flex justify-content-end mb-2">
                            <div class="p-2 rounded shadow-sm"
                                style="max-width: 75%; min-width: 200px; padding: 8px 12px;
                                       background-color: #e6f7e6; border: 1px solid #ddd; font-size: 14px;">
                                <strong class="d-block mb-1" style="color: #4BAF47; font-size: 13px;">
                                    You
                                </strong>
                                <p class="mb-0 text-dark" style="word-wrap: break-word;">${data.message}</p>
                            </div>
                        </div>
                    `;

                    document.getElementById('chat-box').innerHTML += messageHTML;

                    // Clear the input field and scroll to the bottom
                    document.getElementById('message').value = '';
                    scrollToBottom();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        // Scroll to the bottom on page load
        document.addEventListener('DOMContentLoaded', scrollToBottom);
    </script>
    @endpush
@endsection
