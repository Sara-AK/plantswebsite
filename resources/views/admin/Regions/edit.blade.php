@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-dark-green d-flex justify-content-between align-items-center rounded">
            <h3 class="card-title text-white">Edit Region</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.regions.update', $region->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Region Name</label>
                    <input type="text" class="form-control rounded" id="name" name="name" value="{{ $region->name }}" required>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success rounded">Update Region</button>
                    <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
