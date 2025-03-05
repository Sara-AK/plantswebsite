<?php

namespace App\Http\Controllers;

use App\Models\Gardener;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GardenerRequest;
use Illuminate\Support\Facades\Auth;


class GardenerController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $gardeners = User::where('role', 'gardener')->get();
            return view('gardeners.index', compact('gardeners'));
        }

        if ($user->role === 'gardener') {
            // Fetch requests where this gardener was requested
            $requests = GardenerRequest::where('gardener_id', Auth::id())->with('user')->get();
            return view('gardeners.index', compact('requests'));
        }

        // Regular users see the list of gardeners and their request statuses
        $gardeners = User::where('role', 'gardener')->get();
        $requests = GardenerRequest::where('user_id', Auth::id())->get()->keyBy('gardener_id');

        return view('gardeners.index', compact('gardeners', 'requests'));
    }
    public function acceptRequest($id)
    {
        $request = GardenerRequest::findOrFail($id);

        // Ensure the logged-in gardener is the one being requested
        if ($request->gardener_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Update request status to 'accepted'
        $request->status = 'accepted';
        $request->save();

        return redirect()->back()->with('success', 'Request accepted! You can now chat with the user.');
    }



}
