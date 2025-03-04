@extends('layouts.app')
@section('title', 'Dashboard Page')
@section('content')
<style>
    .product-image {
        width: 100%;
        height: 350px; /* Same height as plants */
        object-fit: cover; /* Ensures proper cropping */
        border-radius: 10px; /* Optional: rounded edges */
    }
</style>



    <!-- Banner area start here -->
    <section class="banner-three banner-five">
        <div class="swiper banner-three__slider banner-five__slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slide-bg" data-background="assets/images/banner/banner-five-bg.jpg"></div>
                    <div class="container">
                        <div class="banner-three__content banner-five__content">
                            <h4 data-animation="fadeInUp" data-delay="0.5s">The Green Canvas</h4>
                            <h1 data-animation="fadeInUp" data-delay="0.65s">The Healing Power <br> of Gardening
                            </h1>
                            <a href="about.html" class="btn-one-white mt-50" data-animation="fadeInUp" data-delay="0.9s">
                                <span>Discover with us</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-bg" data-background="assets/images/banner/banner-five-bg2.jpg"></div>
                    <div class="container">
                        <div class="banner-three__content banner-five__content">
                            <h4 data-animation="fadeInUp" data-delay="0.5s">The Green Canvas</h4>
                            <h1 data-animation="fadeInUp" data-delay="0.65s">The Healing Power <br> of Gardening
                            </h1>
                            <a href="about.html" class="btn-one-white mt-50" data-animation="fadeInUp" data-delay="0.9s">
                                <span>Discover with us</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-bg" data-background="assets/images/banner/banner-five-bg3.jpg"></div>
                    <div class="container">
                        <div class="banner-three__content banner-five__content">
                            <h4 data-animation="fadeInUp" data-delay="0.5s">The Green Canvas</h4>
                            <h1 data-animation="fadeInUp" data-delay="0.65s">The Healing Power <br> of Gardening
                            </h1>
                            <a href="about.html" class="btn-one-white mt-50" data-animation="fadeInUp" data-delay="0.9s">
                                <span>Discover with us</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-five__arry-btn">
            <button class="arry-prev mb-15 banner-five__arry-prev">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="arry-next banner-five__arry-next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </section>
    <!-- Banner area end here -->

    <!-- About area start here -->
    <section class="involve-two sub-bg pt-130 pb-130">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-xl-6">
                    <div class="involve-two__image">
                        <img src="assets/images/about/about-five-image.png" alt="image">
                        <div class="image-sm">
                            <img src="assets/images/involve/involve-sm.jpg" alt="image">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="involve-two__item">
                        <div class="section-header mb-4">
                            <h5 class="wow fadeInUp" data-wow-duration="0.6s" data-wow-delay=".2s"><img
                                    src="assets/images/icon/leaf.svg" alt="image"> ABOUT OUR WEBSITE</h5>
                            <h2 class="wow fadeInUp" data-wow-duration="0.7s" data-wow-delay=".4s">Illuminating Paths to
                                Wellness in Your Garden</h2>
                            <p class="wow fadeInUp" data-wow-duration="0.8s" data-wow-delay=".6s">Our website is a hub for
                                plant enthusiasts, connecting you with planting tips, expert advice, and plant sellers while
                                fostering a social space for sharing your plant journey.</p>
                        </div>
                        <div class="accordion" id="accordionExample-two">
                            <div class="accordion-item wow fadeInDown" data-wow-duration="0.6s" data-wow-delay=".2s">
                                <h2 class="accordion-header" id="heading1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                        Planting Tips and Expert Advice
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1"
                                    data-bs-parent="#accordionExample-two">
                                    <div class="accordion-body">
                                        <p>Our goal is to bridge the gap between plant lovers and experts, offering
                                            personalized advice to help you nurture your plants to their fullest potential.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item bor-top wow fadeInDown" data-wow-duration="0.7s"
                                data-wow-delay=".4s">
                                <h2 class="accordion-header" id="heading2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        Connecting Buyers and Sellers
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                                    data-bs-parent="#accordionExample-two">
                                    <div class="accordion-body">
                                        <p>Find local and online shops with a variety of plants and tools, creating a
                                            vibrant marketplace to fulfill all your gardening needs.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item wow fadeInDown" data-wow-duration="0.8s" data-wow-delay=".6s">
                                <h2 class="accordion-header" id="heading3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        Community Growth and Sharing
                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                    data-bs-parent="#accordionExample-two">
                                    <div class="accordion-body">
                                        <p>Be a part of our plant-loving community! Share your plant growth stories, post
                                            tips, and inspire others to start their own green journeys.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="about.html" class="btn-one mt-35"><span>More About us</span> <i
                                class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About area end here -->


<!-- Plants area sart here -->
<section class="project-five pt-130">
    <div class="section-header text-center">
        <h5 class="wow fadeInUp" data-wow-duration="0.6s" data-wow-delay=".2s">
            <img src="assets/images/icon/leaf.svg" alt="image"> PLANTS
        </h5>
        <h2 class="wow fadeInUp" data-wow-duration="0.7s" data-wow-delay=".4s">Recent Plants</h2>
    </div>
    <div class="row g-0">
        @foreach ($plants->slice(0, 4) as $plant)
            <div class="col-xxl-3 col-lg-6 wow fadeInUp" data-wow-duration="0.6s" data-wow-delay=".2s">
                <div class="project-five__item sub-bg">
                    <div class="project-five__content bg-white">
                        <h3>{{ $plant->name }}</h3>
                        <p>{{ $plant->description }}</p>
                        <a href="plants/{{ $plant->id }}" class="btn-two">
                            <span>Care Tips</span>
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6 wow fadeInUp" data-wow-duration="0.7s" data-wow-delay=".4s">
                <div class="project-five__image">
                    <img src="{{ is_array($plant->pictures) ? $plant->pictures[0] : json_decode($plant->pictures, true)[0] ?? 'default-image.jpg' }}" alt="{{ $plant->name }}" style="max-height: 350px; width: auto;">
                </div>
            </div>

        @endforeach
    </div>
    <div class="text-center mt-5">
        <a href="{{ route('public.plants.index') }}" class="btn-one">
            <span>View All Plants</span>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</section>
<!-- Plant area end here -->

    <!-- product area start here -->
    <div class="section-header text-center">
        <h5 class="wow fadeInUp" data-wow-duration="0.6s" data-wow-delay=".2s">
            <img src="assets/images/icon/leaf.svg" alt="image"> PLANT PRODUCTS
        </h5>
        <h2 class="wow fadeInUp" data-wow-duration="0.7s" data-wow-delay=".4s">Recent Products</h2>
    </div>
    <section class="blog-two view-area pb-130 pt-65">
        <div class="container">
            <div class="row g-4">
                @foreach ($plantProducts->slice(0, 6) as $product)
    <div class="col-lg-4 col-md-6 wow fadeInDown" data-wow-duration="0.6s" data-wow-delay=".2s">
        <div class="donation__item blog-two__item bor view__item">
            <div class="blog-two__image mb-30">
                @php
                    $pictures = json_decode($product->pictures, true);
                    $imagePath = isset($pictures[0]) ? asset($pictures[0]) : asset('storage/plantproducts/default-product.jpg');
                @endphp

                <div class="image">
                    <img src="{{ $imagePath }}" alt="{{ $product->name }}" class="product-image">
                </div>
            </div>
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p>Price: ${{ $product->price }}</p>
            <a class="blog-two__item-arrow" href="{{ route('public.products.show', $product->id) }}"><i
                    class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
            @endforeach
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('public.products.index') }}" class="btn-one">
                <span>View All Plant Products</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>
    <!-- product area end here -->

    <!-- Articles area start here -->
    <!-- Articles area start here -->
<section class="work work-five pt-130 pb-65">
    <div class="container">
        <div class="pb-65 bor-bottom mb-65">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="section-header m-0">
                        <h5 class="wow fadeInUp" data-wow-duration="0.6s" data-wow-delay=".2s">
                            <img src="{{ asset('assets/images/icon/leaf.svg') }}" alt="image"> EXPLORE
                        </h5>
                        <h2 class="wow fadeInUp" data-wow-duration="0.7s" data-wow-delay=".4s">Articles</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4">
            @foreach ($articles as $index => $article)
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 wow fadeInDown" data-wow-duration="0.5s"
                    data-wow-delay=".{{ 2 + ($index * 2) }}s">
                    <div class="work-five__item">
                        <div class="work__item-icon mb-30">
                            <div class="work-five__icon">
                                <i class="fa-light fa-lightbulb-on"></i>
                            </div>
                            <span>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h3><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></h3>
                        <p>{{ Str::limit($article->content, 100, '...') }}</p>
                        <a class="work__item-arrow" href="{{ route('articles.show', $article->id) }}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Articles area end here -->

@endsection
