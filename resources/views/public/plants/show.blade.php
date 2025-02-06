@extends('layouts.app')
@section('title', 'Plants Page')
@section('content')

    <!-- Page banner area start here -->
    <section class="page-banner bg-image pt-130 pb-130">
        <div class="container">
            <h2 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">{{ $plant->name }}</h2>
        </div>
    </section>
    <!-- Page banner area end here -->

    <!-- Plant Details Section -->
    <section class="event-single pt-130 pb-130">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="event-two__content px-0">
                        <h3 class="mb-40">{{ $plant->name }}</h3>

                        <!-- Categories Section -->
                        <div class="mt-40">
                            <h4 class="mb-20">Categories:</h4>
                            <ul class="list-inline">
                                @foreach ($plant->categories as $category)
                                    <li class="list-inline-item">
                                        <a href="{{ route('public.categories.show', $category->id) }}" class="btn-one">
                                            <span>{{ $category->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <h4 class="mb-20">Regions:</h4>
                            <ul class="list-inline">
                                @foreach ($plant->regions as $region)
                                    <li class="list-inline-item">
                                        <a href="{{ route('public.categories.show', $region->id) }}" class="btn-one">
                                            <span>{{ $region->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Categories Section -->

                        <p class="mb-30">{{ $plant->description }}</p>
                        <p><strong>Care Difficulty:</strong> {{ $plant->caredifficulty }}</p>
                        <p>{{ $plant->caretips }}</p>
                    </div>

                    <!-- Related Products Section -->
                    <div class="mt-40">
                        <h4 class="mb-20">Related Products:</h4>
                        <div class="row g-4">
                            @foreach ($relatedProducts as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="event-two__item border rounded p-3 shadow-sm">
                                        <div class="event-two__content px-0">
                                            <h3 class="mb-20">{{ $product->name }}</h3>
                                            <p class="mb-20">{{ $product->description }}</p>
                                            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>

                                            <!-- View Product Button -->
                                            <div class="text-center mt-3">
                                                <a href="{{ route('public.products.show', $product->id) }}" class="btn-one">
                                                    <span>View Product</span>
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- End Related Products Section -->

                </div>

                <!-- Image Section - Right Half -->
                <div class="col-lg-6">
                    <div class="image">
                        @php
                            $pictures = is_array($plant->pictures) ? $plant->pictures : json_decode($plant->pictures, true);
                        @endphp

                        @if ($pictures)
                            @foreach ($pictures as $picture)
                                <img src="{{ $picture }}" alt="{{ $plant->name }}" class="img-fluid rounded mb-3" style="max-width: 300px ; height: auto;">
                            @endforeach
                        @else
                            <img src="default-image.jpg" alt="{{ $plant->name }}" class="img-fluid rounded" style="max-width: 300px; height: auto;">
                        @endif
                    </div>
                </div>

            </div>

            <p class="mt-40 mb-30">{{ $plant->additional_details }}</p>
        </div>
    </section>
    <!-- Plant Details Section End -->

@endsection
