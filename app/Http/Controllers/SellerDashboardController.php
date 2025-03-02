<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PlantProduct;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id(); // Get logged-in seller's ID

        // Count total products listed by the seller
        $totalProducts = PlantProduct::where('seller_id', $sellerId)->count();

        // Get total orders for seller's products
        $totalOrders = Order::whereHas('items.plantProduct', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->count();

        // Calculate total revenue for seller
        $totalRevenue = Order::whereHas('items.plantProduct', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->sum('total_price');

        // Count pending orders
        $pendingOrders = Order::whereHas('items.plantProduct', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->where('status', 'pending')->count();

        // Sales Performance (Last 6 Months)
        $months = collect([]);
        $salesData = collect([]);

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months->push($date->format('M Y'));

            $salesData->push(Order::whereHas('items.plantProduct', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total_price'));
        }

        // Top Selling Products (Corrected Query)
        $topProducts = OrderItem::select('plant_product_id', DB::raw('count(*) as count'))
            ->whereHas('plantProduct', function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            })
            ->groupBy('plant_product_id')
            ->orderByDesc('count')
            ->take(5)
            ->with('plantProduct')
            ->get();

        $productLabels = $topProducts->pluck('plantProduct.name');
        $productData = $topProducts->pluck('count');

        // Order Status Breakdown (Fixed Relationship)
        $orderStatusCounts = Order::whereHas('items.plantProduct', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('seller.dashboard', [
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'pendingOrders' => $pendingOrders,
            'months' => $months,
            'salesData' => $salesData,
            'productLabels' => $productLabels,
            'productData' => $productData,
            'orderStatusCounts' => $orderStatusCounts,
        ]);
    }
}
