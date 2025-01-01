@extends('layouts.app')
@section('title', 'Plants Page')
@section('content')

    <!-- Page banner area start here -->
    <section class="page-banner bg-image pt-130 pb-130">
        <div class="container">
            <h2 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">{{ $product->name }}</h2>
        </div>
    </section>
    <!-- Page banner area end here -->

    <!-- Plant Details Section -->
    <section class="event-single pt-130 pb-130">
        <div class="container">
            <div class="row g-4">
                <div class="event-two__item">
                    <div class="event-two__content px-0">
                        <h3 class="mb-40">{{ $product->name }}</h3>
                        <p class="mb-30">{{ $product->description }}</p>
                        <p>Price: {{ $product->price }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Plant Details Section End -->

@endsection
