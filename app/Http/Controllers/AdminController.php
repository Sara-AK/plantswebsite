<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleRequest;

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
}
