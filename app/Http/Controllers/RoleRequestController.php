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

    public function cancel()
    {
        $roleRequest = RoleRequest::where('user_id', Auth::id())->where('status', 'pending')->first();

        if (!$roleRequest) {
            return back()->with('error', 'No pending request found to cancel.');
        }

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

    public function store(Request $request)
    {
        $request->validate([
            'requested_role' => 'required|in:gardener,seller',
        ]);

        $existingRequest = RoleRequest::where('user_id', Auth::id())->where('status', 'pending')->first();
        if ($existingRequest) {
            return back()->with('error', 'You already have a pending role request.');
        }

        RoleRequest::create([
            'user_id' => Auth::id(),
            'requested_role' => $request->requested_role,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your role request has been submitted.');
    }

    public function requestRoleRemoval()
    {
        if (Auth::user()->role === 'user') {
            return back()->with('error', 'You do not have a role to remove.');
        }

        RoleRequest::create([
            'user_id' => Auth::id(),
            'requested_role' => 'user', // Requesting to revert to a normal user
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your role removal request has been submitted.');
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
