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
</div>
@endsection
