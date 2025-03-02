@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="my-4">Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $totalUsers }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Pending Role Requests</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $pendingRequests }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Orders</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $totalOrders }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h5>User Growth (Last 6 Months)</h5>
            <div>{!! $userGrowthChart->container() !!}</div>
        </div>

        <div class="col-md-6">
            <h5>Orders Per Month</h5>
            <div>{!! $ordersChart->container() !!}</div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Revenue Per Month</h5>
            <div>{!! $revenueChart->container() !!}</div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{!! $userGrowthChart->script() !!}
{!! $ordersChart->script() !!}
{!! $revenueChart->script() !!}

@endsection
