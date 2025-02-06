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
            <div class="row g-4">
                @foreach ($plants as $plant)
                    <div class="col-lg-4 wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                        <div class="donation__item bor">
                            <div class="image mb-30">
                                <img src="{{ is_array($plant->pictures) ? $plant->pictures[0] : json_decode($plant->pictures, true)[0] ?? 'default-image.jpg' }}"
                                     alt="{{ $plant->name }}" >
                            </div>

                            <h3><a href="{{ route('plants.show', $plant->id) }}">{{ $plant->name }}</a></h3>
                            <p>{{ \Illuminate\Support\Str::limit($plant->description, 100) }}</p>

                            <div class="text-center mt-5">
                                <a href="{{ route('public.plants.show', $plant->id) }}" class="btn-one">
                                    <span>View Details</span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagi-wrp mt-65 justify-content-center wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                {{ $plants->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
@endsection
