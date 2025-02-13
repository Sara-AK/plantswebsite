@extends('layouts.admin')

@section('title', 'Manage Regions')

@section('content')
    <section class="content">
        <div class="section-header text-center">
            <h5 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                ALL Regions
            </h5>
            <h2 class="wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">Edit and Add Regions</h2>
        </div>
        <div class="container-fluid">
            <!-- Add Region Form -->
            <div class="card shadow-sm rounded mb-4">
                <div class="card-header bg-dark-green d-flex justify-content-between align-items-center rounded">
                    <h3 class="card-title text-white">Add Region</h3>
                    <button type="button" class="btn btn-tool text-white" data-bs-toggle="collapse" data-bs-target="#addRegionForm">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div id="addRegionForm" class="collapse p-3">
                    <div class="card-body">
                        <form action="{{ route('admin.regions.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label>Region Name</label>
                                    <input type="text" class="form-control rounded" name="name" placeholder="Enter region name" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success rounded">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Regions List -->
            <div class="card shadow-sm rounded">
                <div class="card-header bg-dark-green d-flex justify-content-between align-items-center rounded">
                    <h3 class="card-title text-white">All Regions</h3>
                    <button type="button" class="btn btn-tool text-white" data-bs-toggle="collapse" data-bs-target="#regionsTable">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-dark-green rounded">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th>Region Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regions as $region)
                                <tr>
                                    <td>{{ $region->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.regions.edit', $region->id) }}" class="btn btn-warning btn-sm rounded">Edit</a>
                                        <form action="{{ route('admin.regions.destroy', $region->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

    <style>
        .bg-dark-green {
            background-color: #4baf47 !important;
            color: white !important;
        }
        .table-dark-green {
            border: 0.5px solid #04240c;
        }
        .btn-success {
            background-color: #2d6a32 !important;
            border-color: #4baf47 !important;
        }
        .btn-success:hover {
            background-color: #4baf47 !important;
        }
        .rounded {
            border-radius: 10px !important;
        }
        .rounded-pill {
            border-radius: 50px !important;
        }
        .img-thumbnail {
            border-radius: 50% !important;
            object-fit: cover;
        }
    </style>

    <!-- Ensure jQuery & Bootstrap JS are included -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

@endsection
