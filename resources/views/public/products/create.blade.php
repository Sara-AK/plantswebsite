@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Add a New Product</h2>

    <!-- Display Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Product Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Product Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price ($):</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" required>
        </div>

        <!-- Associated Plant (Optional) -->
        <div class="mb-3">
            <label for="plant_id" class="form-label">Related Plant (Optional):</label>
            <select name="plant_id" id="plant_id" class="form-control">
                <option value="">None</option>
                @foreach ($plants as $plant)
                    <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Product Image -->
        <div class="mb-3">
            <label for="picture" class="form-label">Product Image:</label>
            <input type="file" name="picture" id="picture" class="form-control">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save Product</button>

        <!-- Cancel Button -->
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
