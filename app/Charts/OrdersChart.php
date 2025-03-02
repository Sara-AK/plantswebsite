<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Order;
use Carbon\Carbon;

class OrdersChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        // Fetch the last 6 months of order data
        $months = collect(range(5, 0))->map(function ($month) {
            return Carbon::now()->subMonths($month)->format('M'); // Jan, Feb, Mar...
        });

        $orderCounts = collect(range(5, 0))->map(function ($month) {
            return Order::whereMonth('created_at', Carbon::now()->subMonths($month)->month)
                        ->whereYear('created_at', Carbon::now()->subMonths($month)->year)
                        ->count();
        });

        // Define the chart
        $this->labels($months)
            ->dataset('Orders', 'bar', $orderCounts->toArray())
            ->options([
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
            ]);
    }
}
