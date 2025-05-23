<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;

class ChatController extends Controller
{
    public function index($gardenerId)
    {
        $gardeners = User::where('role', 'gardener')->get();
        $gardener = User::findOrFail($gardenerId);
        $messages = Message::where(function ($query) use ($gardener) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $gardener->id);
        })->orWhere(function ($query) use ($gardener) {
            $query->where('sender_id', $gardener->id)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        return view('chat.index', compact('gardener', 'messages', 'gardeners'));
    }

    public function store(Request $request, $gardenerId)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        // Create the new message
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $gardenerId,
            'message' => $request->message
        ]);

        // Return the new message data as a JSON response
        return response()->json([
            'success' => true,
            'message' => $message->message,
            'sender' => Auth::user()->name
        ]);
    }


}
