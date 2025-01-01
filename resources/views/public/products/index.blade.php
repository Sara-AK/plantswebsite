@extends('layouts.app')
@section('title', 'Plant Products Page')
@section('content')

    <!-- Page banner area start here -->
    <section class="page-banner bg-image pt-130 pb-130">
        <div class="container">
            <h2 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">All Products</h2>
        </div>
    </section>
    <!-- Page banner area end here -->

    <section class="donation-inner pb-130">
        <div class="container">
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-lg-4 wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                        <div class="donation__item bor">
                            <div class="image mb-30">
                                <img src="{{ $product->picture_url }}" alt="{{ $product->name }}">
                            </div>
                            <h3><a href="{{ route('plants.show', $product->id) }}">{{ $product->name }}</a></h3>
                            <p>{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>

                            <!-- Price Display -->
                            <div class="price mt-3">
                                <h4 class="text-success">Price: ${{ number_format($product->price, 2) }}</h4>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{ route('public.products.show', $product->id) }}" class="btn-one">
                                    <span>View Details</span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagi-wrp mt-65 justify-content-center wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>
@endsection
