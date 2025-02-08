<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleRequest;

class AdminController extends Controller
{
    public function roleRequests() {
        $requests = RoleRequest::where('status', 'pending')->get();
        return view('admin.role_requests', compact('requests'));
    }
}
