<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PlantProduct;
use App\Models\Order;
use App\Models\Plant;
use App\Charts\UserGrowthChart;
use App\Charts\OrdersChart;
use App\Charts\RevenueChart;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $pendingRequests = User::where('role_request', '!=', null)->count();
        $totalProducts = PlantProduct::count();
        $totalPlants = Plant::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');

        // Initialize Charts
        $userGrowthChart = new UserGrowthChart();
        $ordersChart = new OrdersChart();
        $revenueChart = new RevenueChart();

        return view('admin.dashboard', compact(
            'totalUsers', 'pendingRequests', 'totalProducts', 'totalPlants',
            'totalOrders', 'totalRevenue', 'userGrowthChart', 'ordersChart', 'revenueChart'
        ));
    }
}
