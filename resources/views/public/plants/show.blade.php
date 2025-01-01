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
                <div class="event-two__item">
                    <div class="event-two__content px-0">
                        <h3 class="mb-40">{{ $plant->name }}</h3>
                        <p class="mb-30">{{ $plant->description }}</p>
                        <p>Care Difficulty: {{ $plant->care_difficulty }}</p>
                        <p>{{ $plant->care_tips }}</p>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="image">
                            <img src="{{ $plant->picture_url }}" alt="{{ $plant->name }}">
                        </div>
                    </div>
                </div>
                <p class="mt-40 mb-30">{{ $plant->additional_details }}</p>
            </div>
        </div>
    </section>
    <!-- Plant Details Section End -->


@endsection
