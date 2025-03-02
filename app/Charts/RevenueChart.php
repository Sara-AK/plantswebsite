<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Order;
use Carbon\Carbon;

class RevenueChart
{
    public function build()
    {
        $months = collect(range(5, 0))->map(function ($month) {
            return Carbon::now()->subMonths($month)->format('M');
        });

        $revenueCounts = collect(range(5, 0))->map(function ($month) {
            return Order::whereMonth('created_at', Carbon::now()->subMonths($month)->month)
                        ->whereYear('created_at', Carbon::now()->subMonths($month)->year)
                        ->sum('total_price');
        });

        return (new Chart)
            ->labels($months)
            ->dataset('Revenue ($)', 'line', $revenueCounts->toArray())
            ->backgroundColor('rgba(255, 99, 132, 0.2)');
    }
}
