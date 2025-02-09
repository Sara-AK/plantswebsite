<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
    public function showRequestStatus()
    {
        $request = Auth::user()->roleRequests()->latest()->first(); // Get latest request
        return view('user.request-status', compact('request'));
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return back()->with('error', 'Admins cannot delete their own account.');
        }

        // Log out and delete the account
        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }

    // Allow admins to delete user accounts (except other admins)
    public function deleteUser(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'You cannot delete an admin.');
        }

        $user->delete();
        return back()->with('success', 'User account has been deleted.');
    }

}
