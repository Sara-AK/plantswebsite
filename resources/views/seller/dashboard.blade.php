@extends('seller.layout')

@section('content')
<div class="container">
    <h1 class="my-4">Seller Dashboard</h1>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Products Listed</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $totalProducts }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Orders</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $totalOrders }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total Revenue</div>
                <div class="card-body">
                    <h4 class="card-title">${{ number_format($totalRevenue, 2) }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Pending Orders</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $pendingOrders }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Monthly Sales Performance</h5>
            <canvas id="salesChart"></canvas>
        </div>

        <div class="col-md-6">
            <h5>Top Selling Products</h5>
            <canvas id="topProductsChart"></canvas>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Order Status Breakdown</h5>
            <canvas id="orderStatusChart"></canvas>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var salesCtx = document.getElementById("salesChart").getContext("2d");
    var productsCtx = document.getElementById("topProductsChart").getContext("2d");
    var statusCtx = document.getElementById("orderStatusChart").getContext("2d");

    // Sales Chart
    new Chart(salesCtx, {
        type: "line",
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: "Revenue",
                data: {!! json_encode($salesData) !!},
                borderColor: "blue",
                backgroundColor: "rgba(0, 123, 255, 0.5)",
                fill: true
            }]
        }
    });

    // Top Products Chart
    new Chart(productsCtx, {
        type: "bar",
        data: {
            labels: {!! json_encode($productLabels) !!},
            datasets: [{
                label: "Sales",
                data: {!! json_encode($productData) !!},
                backgroundColor: "green"
            }]
        }
    });

    // Order Status Chart
    new Chart(statusCtx, {
        type: "pie",
        data: {
            labels: {!! json_encode($orderStatusCounts->keys()) !!},
            datasets: [{
                data: {!! json_encode($orderStatusCounts->values()) !!},
                backgroundColor: ['red', 'orange', 'green']
            }]
        }
    });
});
</script>

@endsection
