@extends('layouts.admin')

@section('title', 'Edit Plant')


@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded mb-4">
        <div class="card-header bg-dark-green d-flex justify-content-between align-items-center rounded">
            <h3 class="card-title text-white">Edit Plant</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.plants.update', $plant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label>Plant Name</label>
                        <input type="text" class="form-control rounded" name="name" value="{{ $plant->name }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Care Difficulty</label>
                        <input type="text" class="form-control rounded" name="caredifficulty" value="{{ $plant->caredifficulty }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="form-group col-md-6">
                        <label>Plant Description</label>
                        <textarea class="form-control rounded" rows="3" name="description" required>{{ $plant->description }}</textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Planting Tips</label>
                        <textarea class="form-control rounded" rows="3" name="caretips">{{ $plant->caretips }}</textarea>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Plant Image (URL)</label>
                    <input type="text" class="form-control rounded" name="pictures" value="{{ is_array($plant->pictures) ? implode(', ', $plant->pictures) : $plant->pictures }}" required>
                </div>

                <div class="form-group">
                    <label for="categories">Categories</label>
                    <select name="categories[]" id="categories" class="form-control select2" multiple="multiple" required>
                        @foreach($allCategories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id, $plant->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="regions">Regions</label>
                    <select name="regions[]" id="regions" class="form-control select2" multiple="multiple" required>
                        @foreach($allRegions as $region)
                            <option value="{{ $region->id }}"
                                {{ in_array($region->id, $plant->regions->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success rounded">Update Plant</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
