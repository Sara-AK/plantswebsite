<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\RoleRequest;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is logged in
        $this->middleware('admin'); // Ensure only admins can access
    }

    // Show the admin panel (Users & Role Requests)
    public function manageUsers()
    {
        $users = User::all(); // Fetch all users
        $roleRequests = RoleRequest::where('status', 'pending')->get(); // Fetch only pending role requests

        return view('admin.users', compact('users', 'roleRequests'));
    }
    // public function manageUsers()
    // {
    //     $users = User::all(); // Fetch all users
    //     $roleRequests = RoleRequest::orderBy('created_at', 'desc')->get(); // Fetch all role requests

    //     return view('admin.users', compact('users', 'roleRequests'));
    // }


    // Show the Assign Admin page
    public function showAssignAdminForm()
    {
        $users = User::where('role', '!=', 'admin')->get(); // Exclude existing admins
        return view('admin.assign', compact('users'));
    }

    // Assign admin role to a user
    public function assignAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);
        if ($user->role === 'admin') {
            return back()->with('error', 'This user is already an admin.');
        }

        $user->update(['role' => 'admin']);

        return redirect()->route('admin.users')->with('success', 'User assigned as admin successfully.');
    }

    // Update Role Requests (Approve/Reject)
// Update Role Requests (Approve/Reject)
public function updateRoleRequest(Request $request, RoleRequest $roleRequest)
{
    if (!auth()->user() || auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }

    if ($request->status == 'approved') {
        // Assign the requested role to the user
        $roleRequest->user->update(['role' => $roleRequest->requested_role]);
    }

    // Update the role request status, ensuring we don't overwrite `cv_file` or `request_note`
    $roleRequest->update([
        'status' => $request->status,
    ]);

    return redirect()->route('admin.users')->with('success', 'Role request updated successfully.');
}

    // Allow admin to delete users (except admins)
    public function deleteUser(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'You cannot delete an admin.');
        }

        $user->delete();
        return back()->with('success', 'User account has been deleted.');
    }

    // Allow admin to register a new user
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,gardener,seller,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User registered successfully!');
    }
}
