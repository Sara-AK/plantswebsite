@extends('layouts.admin')

@section('title', 'Manage Plants')

@section('content')
    <section class="content">
        <div class="section-header text-center">
            <h5 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                ALL PLANTS
            </h5>
            <h2 class="wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">Edit and Add Plants</h2>
        </div>
        <div class="container-fluid">
            <!-- Add Plant Form -->
            <div class="card shadow-sm rounded mb-4">
                <div class="card-header bg-dark-green d-flex justify-content-between align-items-center rounded">
                    <h3 class="card-title text-white">Add Plant</h3>
                    <button type="button" class="btn btn-tool text-white" data-bs-toggle="collapse" data-bs-target="#addPlantForm">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div id="addPlantForm" class="collapse p-3">
                    <div class="card-body">
                        <form action="{{ route('admin.plants.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label>Plant Name</label>
                                    <input type="text" class="form-control rounded" name="name" placeholder="Enter plant name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Care Difficulty</label>
                                    <input type="text" class="form-control rounded" name="caredifficulty" placeholder="Enter care difficulty" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label>Plant Description</label>
                                    <textarea class="form-control rounded" rows="3" name="description" placeholder="Enter description" required></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Planting Tips</label>
                                    <textarea class="form-control rounded" rows="3" name="caretips" placeholder="Enter tips"></textarea>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Plant Image (URL)</label>
                                <input type="text" class="form-control rounded" name="pictures" placeholder="Enter Image URL" required>
                            </div>

                            <div class="form-group">
                                <label for="categories">Categories</label>
                                <select name="categories[]" id="categories" class="form-control select2" multiple="multiple" data-placeholder="Select categories" required>
                                    @foreach($allCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="regions">Regions</label>
                                <select name="regions[]" id="regions" class="form-control select2" multiple="multiple" data-placeholder="Select regions" required>
                                    @foreach($allRegions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="card-footer">
                                <button type="submit" class="btn btn-success rounded">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Plants List -->
            <div class="card shadow-sm rounded">
                <div class="card-header bg-dark-green d-flex justify-content-between align-items-center rounded">
                    <h3 class="card-title text-white">All Plants</h3>
                    <button type="button" class="btn btn-tool text-white" data-bs-toggle="collapse" data-bs-target="#plantsTable">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-dark-green rounded">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th>Plant</th>
                                <th class="d-none d-lg-table-cell">Description</th>
                                <th class="d-none d-md-table-cell">Categories</th>
                                <th class="d-none d-md-table-cell">Regions</th>
                                <th>Image</th>
                                <th class="d-none d-lg-table-cell">Care Difficulty</th>
                                <th class="d-none d-lg-table-cell">Planting Tips</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plants as $plant)
                                <tr>
                                    <td>{{ $plant->name }}</td>
                                    <td class="d-none d-lg-table-cell">{{ \Illuminate\Support\Str::limit($plant->description, 50) }}</td>
                                    <td class="d-none d-md-table-cell">
                                        @foreach ($plant->categories as $category)
                                            <span class="badge bg-success rounded-pill">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        @foreach ($plant->regions as $region)
                                            <span class="badge bg-primary rounded-pill">{{ $region->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $pictures = is_array($plant->pictures) ? $plant->pictures : (is_string($plant->pictures) ? json_decode($plant->pictures, true) : []);
                                        @endphp

                                        @if (!empty($pictures))
                                            <img src="{{ $pictures[0] }}" alt="{{ $plant->name }}" class="img-thumbnail rounded-circle" style="width: 50px; height: 50px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td class="d-none d-lg-table-cell">{{ \Illuminate\Support\Str::limit($plant->caredifficulty, 50) }}</td>
                                    <td class="d-none d-lg-table-cell">{{ \Illuminate\Support\Str::limit($plant->caretips, 50) }}</td>
                                    <td>
                                        <a href="{{ route('admin.plants.edit', $plant->id) }}" class="btn btn-warning btn-sm rounded">Edit</a>
                                        <form action="{{ route('admin.plants.destroy', $plant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
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

@endsection
