@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-dark-green d-flex justify-content-between align-items-center rounded">
            <h3 class="card-title text-white">Edit Plant Category</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control rounded" id="name" name="name" value="{{ $category->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Category Description</label>
                    <textarea class="form-control rounded" id="description" name="description" rows="3" required>{{ $category->description }}</textarea>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success rounded">Update Category</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
