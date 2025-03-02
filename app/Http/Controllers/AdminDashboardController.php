<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB for queries
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $pendingRequests = User::whereNotNull('role_request')->count();

        // Generate statistics for the last 6 months
        $months = collect([]);
        $userGrowthData = collect([]);
        $ordersData = collect([]);
        $revenueData = collect([]);

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months->push($date->format('M Y'));

            // User Growth
            $userGrowthData->push(User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count());

            // Orders Data
            $ordersData->push(Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count());

            // Revenue Data
            $revenueData->push(Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total_price'));
        }

        // Get user roles count
        $roleCounts = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role');

        $roleLabels = $roleCounts->keys();
        $roleData = $roleCounts->values();

        // Get pending role requests count per role
        $pendingRoleCounts = User::select('role_request', DB::raw('count(*) as count'))
            ->whereNotNull('role_request')
            ->groupBy('role_request')
            ->pluck('count', 'role_request');

        $pendingRoleLabels = $pendingRoleCounts->keys();
        $pendingRoleData = $pendingRoleCounts->values();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'pendingRequests' => $pendingRequests,
            'userGrowthLabels' => $months,
            'userGrowthData' => $userGrowthData,
            'ordersLabels' => $months,
            'ordersData' => $ordersData,
            'revenueLabels' => $months,
            'revenueData' => $revenueData,
            'roleLabels' => $roleLabels,
            'roleData' => $roleData,
            'pendingRoleLabels' => $pendingRoleLabels,
            'pendingRoleData' => $pendingRoleData,
        ]);
    }
}
