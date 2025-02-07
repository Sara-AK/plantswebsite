@extends('layouts.admin')

@section('title', 'Manage Plants')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Add Plant Form -->
            <div class="card card-success">
                <div class="card-header bg-dark-green d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white">Add Plant</h3>
                    <button type="button" class="btn btn-tool text-white" data-bs-toggle="collapse" data-bs-target="#addPlantForm">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div id="addPlantForm" class="collapse">
                    <div class="card-body">
                        <form action="{{ route('admin.plants.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Plant Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter plant name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Care Difficulty</label>
                                    <input type="text" class="form-control" name="careDifficulty" placeholder="Enter care difficulty" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Plant Description</label>
                                    <textarea class="form-control" rows="3" name="description" placeholder="Enter description" required></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Planting Tips</label>
                                    <textarea class="form-control" rows="3" name="caretips" placeholder="Enter tips"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Add Images</label>
                                <textarea class="form-control" rows="3" name="ImageURL" placeholder="Enter Image URL" required></textarea>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Plants List -->
            <div class="card card-success">
                <div class="card-header bg-dark-green d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white">All Plants</h3>
                    <button type="button" class="btn btn-tool text-white" data-bs-toggle="collapse" data-bs-target="#plantsTable">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                <div id="plantsTable" class="collapse show">
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-dark-green">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th>Plant</th>
                                    <th>Description</th>
                                    <th>Categories</th>
                                    <th>Regions</th>
                                    <th>Images</th>
                                    <th>Care Difficulty</th>
                                    <th>Planting Tips</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plants as $plant)
                                    <tr>
                                        <td>{{ $plant->name }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($plant->description, 50) }}</td>
                                        <td>
                                            @foreach ($plant->categories as $category)
                                                <span class="badge bg-success">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($plant->regions as $region)
                                                <span class="badge bg-primary">{{ $region->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @php
                                                $pictures = is_array($plant->pictures) ? $plant->pictures : json_decode($plant->pictures, true);
                                            @endphp
                                            @if ($pictures)
                                                <img src="{{ $pictures[0] }}" alt="{{ $plant->name }}" class="img-thumbnail" style="width: 60px; height: 60px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ \Illuminate\Support\Str::limit($plant->caredifficulty, 50) }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($plant->caretips, 50) }}</td>
                                        <td>
                                            <a href="{{ route('admin.plants.edit', $plant->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.plants.destroy', $plant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .bg-dark-green {
            background-color: #2d6a32 !important;
            color: white !important;
        }
        .table-dark-green {
            border: 0.5px solid #04240c;
        }
        .btn-success {
            background-color: #2d6a32 !important;
            border-color: #04240c !important;
        }
        .btn-success:hover {
            background-color: #2d6a32 !important;
        }
    </style>

    <!-- Ensure jQuery & Bootstrap JS are included -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

@endsection
