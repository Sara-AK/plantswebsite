<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class UserGrowthChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        // Fetch the last 6 months of user data
        $months = collect(range(5, 0))->map(function ($month) {
            return Carbon::now()->subMonths($month)->format('M'); // Jan, Feb, Mar...
        });

        $userCounts = collect(range(5, 0))->map(function ($month) {
            return User::whereMonth('created_at', Carbon::now()->subMonths($month)->month)
                        ->whereYear('created_at', Carbon::now()->subMonths($month)->year)
                        ->count();
        });

        // Define the chart
        $this->labels($months)
            ->dataset('New Users', 'line', $userCounts->toArray())
            ->options([
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
            ]);
    }
}
