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


}
