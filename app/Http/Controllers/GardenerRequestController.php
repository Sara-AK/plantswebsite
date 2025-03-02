<?php

namespace App\Http\Controllers;

use App\Models\GardenerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GardenerRequestController extends Controller
{
    public function index()
    {
        // Only allow gardeners to see their requests
        if (Auth::user()->role !== 'gardener') {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Fetch requests for the logged-in gardener
        $requests = GardenerRequest::where('gardener_id', Auth::id())->get();

        return view('gardeners.requests', compact('requests'));
    }

    public function store($gardenerId)
    {
        $userId = auth()->id(); // Get the logged-in user’s ID

        // Ensure the user has not already requested this gardener
        if (GardenerRequest::where('user_id', $userId)->where('gardener_id', $gardenerId)->exists()) {
            return back()->with('error', 'You have already requested this gardener.');
        }

        // Store the request
        GardenerRequest::create([
            'user_id' => $userId,
            'gardener_id' => $gardenerId,
            'status' => 'pending', // Ensure default status
        ]);

        return back()->with('success', 'Request sent successfully!');
    }
    public function acceptRequest($id)
    {
        $request = GardenerRequest::findOrFail($id);

        if (auth()->user()->id !== $request->gardener_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Mark request as accepted
        $request->status = 'accepted';
        $request->save();

        // Notify the user (you can also use a notification system)
        session()->flash('success', 'Request accepted. The user can now chat with you.');

        return redirect()->route('gardeners.requests');
    }
    public function userRequests()
    {
        $requests = GardenerRequest::where('user_id', auth()->id())->get();
        return view('gardeners.user_requests', compact('requests'));
    }


}
