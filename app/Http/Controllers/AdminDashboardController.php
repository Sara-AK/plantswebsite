<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PlantProduct;
use App\Models\Order;
use App\Models\Plant;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

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

        $userGrowthChart = new Chart;
        $userGrowthChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'])
            ->dataset('New Users', 'line', [10, 20, 30, 40, 50, 60])
            ->options(['backgroundColor' => 'rgba(54, 162, 235, 0.2)']);

        return view('admin.dashboard', compact(
            'totalUsers', 'pendingRequests', 'totalProducts', 'totalPlants',
            'totalOrders', 'totalRevenue', 'userGrowthChart'
        ));
    }
}
