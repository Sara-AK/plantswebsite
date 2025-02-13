<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleRequest;
use Illuminate\Support\Facades\Log;

class RoleRequestController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'requested_role' => 'required|in:gardener,seller',
    //     ]);

    //     $existingRequest = RoleRequest::where('user_id', Auth::id())->where('status', 'pending')->first();
    //     if ($existingRequest) {
    //         return back()->with('error', 'You already have a pending role request.');
    //     }

    //     RoleRequest::create([
    //         'user_id' => Auth::id(),
    //         'requested_role' => $request->requested_role,
    //         'status' => 'pending',
    //     ]);

    //     return back()->with('success', 'Your role request has been submitted.');
    // }


    // public function update(Request $request, RoleRequest $roleRequest) {
    //     if (!auth()->user() || auth()->user()->role !== 'admin') {
    //         abort(403, 'Unauthorized');
    //     }


    //     if ($request->status == 'approved') {
    //         $roleRequest->user->update(['role' => $roleRequest->requested_role]);
    //     }

    //     $roleRequest->update(['status' => $request->status]);

    //     return redirect()->back()->with('success', 'Role request updated successfully.');
    // }

    public function update(Request $request, RoleRequest $roleRequest)
    {
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        if ($request->status == 'approved') {
            // Assign the requested role to the user
            $roleRequest->user->update(['role' => $roleRequest->requested_role]);
            $roleRequest->update(['status' => 'approved']);
        } elseif ($request->status == 'rejected') {
            // Keep status as rejected (don't change it to canceled)
            $roleRequest->update(['status' => 'rejected']);
        } else {
            $roleRequest->update(['status' => $request->status]);
        }

        return redirect()->back()->with('success', 'Role request updated successfully.');
    }


    public function cancel()
    {
        $roleRequest = RoleRequest::where('user_id', Auth::id())->where('status', 'pending')->first();

        if (!$roleRequest) {
            return back()->with('error', 'No pending request found to cancel.');
        }

        // Delete the pending request
        $roleRequest->delete();

        return back()->with('success', 'Your role request has been canceled.');
    }

    public function modify(Request $request)
    {
        $request->validate([
            'current_request_id' => 'required|exists:role_requests,id',
            'requested_role' => 'required|in:gardener,seller',
        ]);

        $roleRequest = RoleRequest::where('id', $request->current_request_id)
                                  ->where('user_id', Auth::id())
                                  ->where('status', 'pending')
                                  ->first();

        if (!$roleRequest) {
            return back()->with('error', 'Invalid request modification.');
        }

        $roleRequest->update([
            'requested_role' => $request->requested_role,
        ]);

        return back()->with('success', 'Your role request has been updated.');
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'requested_role' => 'required|in:gardener,seller',
    //     ]);

    //     $existingRequest = RoleRequest::where('user_id', Auth::id())->where('status', 'pending')->first();
    //     if ($existingRequest) {
    //         return back()->with('error', 'You already have a pending role request.');
    //     }

    //     RoleRequest::create([
    //         'user_id' => Auth::id(),
    //         'requested_role' => $request->requested_role,
    //         'status' => 'pending',
    //     ]);

    //     return back()->with('success', 'Your role request has been submitted.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'requested_role' => 'required|in:gardener,seller',
            'request_note' => 'nullable|string|max:1000', // Optional note
            'cv_file' => 'nullable|mimes:pdf,doc,docx|max:2048', // Only allow PDFs & Docs (2MB max)
        ]);

        $user = Auth::user();

        // Check for rejected requests and mark them as canceled
        $previousRequest = RoleRequest::where('user_id', $user->id)
            ->where('status', 'rejected')
            ->first();

        if ($previousRequest) {
            $previousRequest->update(['status' => 'canceled']);
        }

        // Check for an existing pending request
        $existingRequest = RoleRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'You already have a pending role request.');
        }

        // Handle file upload if a CV is submitted
        $cvFilePath = null;
        if ($request->hasFile('cv_file')) {
            $cvFilePath = $request->file('cv_file')->store('cv_uploads', 'public'); // Store in public storage
        }

        // Create a new role request with optional note and CV
        RoleRequest::create([
            'user_id' => $user->id,
            'requested_role' => $request->requested_role,
            'status' => 'pending',
            'request_note' => $request->request_note,
            'cv_file' => $cvFilePath,
        ]);

        return back()->with('success', 'Your role request has been submitted.');
    }

// no need for this function
    // public function requestRoleRemoval()
    // {
    //     // Prevent admins from removing their roles
    //     if (Auth::user()->role === 'admin') {
    //         return back()->with('error', 'Admins cannot remove their role.');
    //     }

    //     // Prevent duplicate removal requests
    //     $existingRequest = RoleRequest::where('user_id', Auth::id())
    //                                   ->where('requested_role', 'user')
    //                                   ->where('status', 'pending')
    //                                   ->first();

    //     if ($existingRequest) {
    //         return back()->with('error', 'You already have a pending role removal request.');
    //     }


    //     // Create a role removal request (downgrade to 'user')
    //     RoleRequest::create([
    //         'user_id' => Auth::id(),
    //         'requested_role' => 'user',
    //         'status' => 'pending',
    //     ]);

    //     return back()->with('success', 'Your role removal request has been submitted.');
    // }
    public function removeRole()
    {
        $user = Auth::user();

        if ($user->role === 'user') {
            return back()->with('error', 'You are already a regular user.');
        }

        // Update the user's role to 'user'
        $user->update(['role' => 'user']);

        return back()->with('success', 'Your role has been removed. You are now a regular user.');
    }


    public function requestRoleChange(Request $request)
    {
        $request->validate([
            'requested_role' => 'required|in:gardener,seller',
        ]);

        if (Auth::user()->role === $request->requested_role) {
            return back()->with('error', 'You are already assigned this role.');
        }

        RoleRequest::create([
            'user_id' => Auth::id(),
            'requested_role' => $request->requested_role,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your role change request has been submitted.');
    }




}
