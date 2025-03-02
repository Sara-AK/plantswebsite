@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="my-4">Admin Dashboard</h1>

    <div class="row">
        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $totalUsers }}</h4>
                </div>
            </div>
        </div>

        <!-- Pending Role Requests -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Pending Role Requests</div>
                <div class="card-body">
                    <h4 class="card-title">{{ $pendingRequests }}</h4>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
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
            <canvas id="userGrowthChart"></canvas>
        </div>

        <div class="col-md-6">
            <h5>Orders Per Month</h5>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h5>Revenue Per Month</h5>
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h5>User Role Distribution</h5>
            <canvas id="roleDistributionChart"></canvas>
        </div>

        <div class="col-md-6">
            <h5>Pending Role Requests</h5>
            <canvas id="pendingRequestsChart"></canvas>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var userGrowthCtx = document.getElementById("userGrowthChart").getContext("2d");
    var ordersCtx = document.getElementById("ordersChart").getContext("2d");
    var revenueCtx = document.getElementById("revenueChart").getContext("2d");
    var roleCtx = document.getElementById("roleDistributionChart").getContext("2d");
    var pendingRequestsCtx = document.getElementById("pendingRequestsChart").getContext("2d");

    // User Growth Chart
    new Chart(userGrowthCtx, {
        type: "line",
        data: {
            labels: {!! json_encode($userGrowthLabels) !!},
            datasets: [{
                label: "New Users",
                data: {!! json_encode($userGrowthData) !!},
                borderColor: "blue",
                backgroundColor: "rgba(0, 123, 255, 0.5)",
                fill: true
            }]
        }
    });

    // Orders Chart
    new Chart(ordersCtx, {
        type: "bar",
        data: {
            labels: {!! json_encode($ordersLabels) !!},
            datasets: [{
                label: "Orders",
                data: {!! json_encode($ordersData) !!},
                backgroundColor: "green"
            }]
        }
    });

    // Revenue Chart
    new Chart(revenueCtx, {
        type: "line",
        data: {
            labels: {!! json_encode($revenueLabels) !!},
            datasets: [{
                label: "Revenue",
                data: {!! json_encode($revenueData) !!},
                borderColor: "red",
                backgroundColor: "rgba(255, 0, 0, 0.5)",
                fill: true
            }]
        }
    });

    // User Role Distribution (Pie Chart)
    new Chart(roleCtx, {
        type: "pie",
        data: {
            labels: {!! json_encode($roleLabels) !!},
            datasets: [{
                data: {!! json_encode($roleData) !!},
                backgroundColor: ['blue', 'green', 'orange', 'red']
            }]
        }
    });

    // Pending Role Requests (Bar Chart)
    new Chart(pendingRequestsCtx, {
        type: "bar",
        data: {
            labels: {!! json_encode($pendingRoleLabels) !!},
            datasets: [{
                label: "Pending Requests",
                data: {!! json_encode($pendingRoleData) !!},
                backgroundColor: "orange"
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

});
</script>
@endsection
