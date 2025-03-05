@extends('layouts.app')
@section('title', 'Plants Page')

@section('content')
<!-- Page banner area start here -->
<section class="page-banner bg-image pt-130 pb-130">
    <div class="container">
        <h2 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">All Plants</h2>
    </div>
</section>
<!-- Page banner area end here -->

<section class="donation-inner pb-130">
    <div class="container">
        <!-- 🔍 Search and Filter Form -->
        <form method="GET" action="{{ route('public.plants.index') }}" class="mb-4">
            <div class="row align-items-end mt-4 pb-3 pt-3 border-bottom">
                <!-- Search Bar -->
                <div class="col-md-4">
                    <label for="search" class="form-label fw-bold"></label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Search plants...">
                </div>

                <!-- Category Dropdown -->
                <div class="col-md-3">
                    <select id="category" name="category" class="form-control">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sorting -->
                <div class="col-md-3">
                    <select id="sort" name="sort" class="form-control">
                        <option value="asc" {{ request('sort', 'asc') == 'asc' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Name (Z-A)</option>
                    </select>
                </div>


                <!-- Submit Button -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100 mt-4">Apply</button>
                </div>
            </div>
        </form>

        <!-- 🌱 Plants Listing -->
        <div class="row g-4">
            @forelse ($plants as $plant)
                <div class="col-lg-4 wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                    <div class="donation__item bor">
                        <div class="image mb-30">
                            @php
                                $pictures = $plant->pictures;
                            @endphp

                            <img src="{{ isset($pictures[0]) ? asset($pictures[0]) : asset('storage/plants/default-image.jpg') }}"
                                 alt="{{ $plant->name }}"
                                 class="plant-image">
                        </div>
                        <h3><a href="{{ route('public.plants.show', $plant->id) }}">{{ $plant->name }}</a></h3>
                        <p>{{ \Illuminate\Support\Str::limit($plant->description, 100) }}</p>
                        <div class="text-center mt-5">
                            <a href="{{ route('public.plants.show', $plant->id) }}" class="btn-one">
                                <span>View Details</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No plants found.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="pagi-wrp mt-65 justify-content-center wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
            {{ $plants->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>

<!-- 🖼 Custom Styles for Image Sizing -->
<style>
    .plant-image {
        width: 100%;        /* Ensures the image takes full width */
        height: 250px;      /* Fixed height */
        object-fit: cover;  /* Crop instead of stretching */
        border-radius: 10px; /* Optional: Rounds the corners */
    }
</style>

@endsection
