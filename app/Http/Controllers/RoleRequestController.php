<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleRequest;
use Illuminate\Support\Facades\Auth;

class RoleRequestController extends Controller
{
    public function store(Request $request) {
        $user = Auth::user();

        // Check if the user already has a pending request
        if (RoleRequest::where('user_id', $user->id)->where('status', 'pending')->exists()) {
            return redirect()->back()->with('error', 'You already have a pending role request.');
        }

        // Create the request
        RoleRequest::create([
            'user_id' => $user->id,
            'requested_role' => $request->requested_role,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Role request submitted successfully. Admins will review it.');
    }

    // For admins to approve/reject requests
    public function update(Request $request, RoleRequest $roleRequest) {
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }


        if ($request->status == 'approved') {
            $roleRequest->user->update(['role' => $roleRequest->requested_role]);
        }

        $roleRequest->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Role request updated successfully.');
    }
}
