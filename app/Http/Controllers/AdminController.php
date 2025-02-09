<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleRequest;
use App\Models\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is logged in
    }

    public function roleRequests() {
        $requests = RoleRequest::where('status', 'pending')->get();
        return view('admin.role_requests', compact('requests'));
    }

    public function showAssignAdminForm()
    {
        $users = User::where('role', '!=', 'admin')->get(); // Exclude existing admins
        return view('admin.assign', compact('users'));
    }

    public function assignAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->role = 'admin';
        $user->save();

        return redirect()->route('admin.assign')->with('success', 'User assigned as admin successfully.');
    }

    public function updateRoleRequest(Request $request, RoleRequest $roleRequest) {
        if (!auth()->user() || auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        if ($request->status == 'approved') {
            if ($roleRequest->requested_role == 'user') {
                // Role removal request: revert to basic user
                $roleRequest->user->update(['role' => 'user']);
            } else {
                // Role change request: assign new role
                $roleRequest->user->update(['role' => $roleRequest->requested_role]);
            }
        }

        $roleRequest->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Role request updated successfully.');
    }


}
