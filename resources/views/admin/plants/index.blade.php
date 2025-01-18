@extends('layouts.admin')

@section('title', 'Manage Plants')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card collapsed-card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Add Plant</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.plants.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Plant Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter plant name"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Scientific Name</label>
                                <input type="text" class="form-control" name="scientificname"
                                    placeholder="Enter scientific name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Plant Description</label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Enter description" required></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Planting Tips</label>
                                <textarea class="form-control" rows="3" name="plantingtips" placeholder="Enter tips"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Categories</label>
                                    <select class="select2" name="categories[]" multiple="multiple"
                                        data-placeholder="Select categories" style="width: 100%;">
                                        @foreach ($allCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Regions</label>
                                    <select class="select2" name="regions[]" multiple="multiple"
                                        data-placeholder="Select regions" style="width: 100%;">
                                        @foreach ($allRegions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputFile">Add Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="fileToUpload">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Listing -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">All Plants</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Plant</th>
                                        <th>Scientific Name</th>
                                        <th>Description</th>
                                        <th>Categories</th>
                                        <th>Regions</th>
                                        <th>Images</th>
                                        <th>Planting Tips</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plants as $plant)
                                        <tr>
                                            <td>{{ $plant->name }}</td>
                                            <td>{{ $plant->scientificname }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($plant->description, 50) }}</td>
                                            <td>
                                                @foreach ($plant->categories as $category)
                                                    {{ $category->name }}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($plant->regions as $region)
                                                    {{ $region->name }}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary mx-2">View Images</a>
                                            </td>
                                            <td>{{ \Illuminate\Support\Str::limit($plant->plantingtips, 50) }}</td>
                                            <td>
                                                <a href="{{ route('admin.plants.edit', $plant->id) }}"
                                                    class="btn btn-primary mx-2">Edit</a>
                                                <form action="{{ route('admin.plants.destroy', $plant->id) }}"
                                                    method="POST" style="display: inline;"
                                                    onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger mx-2">Delete</button>
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
        </div>
    </section>

@endsection
