@extends('layouts.app')
@section('title', 'Home Page')
@section('content')

    <!-- Banner area start here -->
    <section class="banner-three banner-five">
        <div class="swiper banner-three__slider banner-five__slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slide-bg" data-background="assets/images/banner/banner-five-bg.jpg"></div>
                    <div class="container">
                        <div class="banner-three__content banner-five__content">
                            <h4 data-animation="fadeInUp" data-delay="1s">The Green Canvas</h4>
                            <h1 data-animation="fadeInUp" data-delay="1.3s">The Healing Power <br> of Gardening
                            </h1>
                            <a href="about.html" class="btn-one-white mt-50" data-animation="fadeInUp" data-delay="1.8s">
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
                            <h4 data-animation="fadeInUp" data-delay="1s">The Green Canvas</h4>
                            <h1 data-animation="fadeInUp" data-delay="1.3s">The Healing Power <br> of Gardening
                            </h1>
                            <a href="about.html" class="btn-one-white mt-50" data-animation="fadeInUp" data-delay="1.8s">
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
                            <h4 data-animation="fadeInUp" data-delay="1s">The Green Canvas</h4>
                            <h1 data-animation="fadeInUp" data-delay="1.3s">The Healing Power <br> of Gardening
                            </h1>
                            <a href="about.html" class="btn-one-white mt-50" data-animation="fadeInUp" data-delay="1.8s">
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

    <!-- View area removed here -->

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
                            <h5 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s"><img
                                    src="assets/images/icon/leaf.svg" alt="image"> ABOUT OUR WEBSITE</h5>
                            <h2 class="wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">Growth and
                                Glow
                                Illuminating Paths to Wellness in Your Garden</h2>
                            <p class="wow fadeInUp" data-wow-duration="1.6s" data-wow-delay=".6s">We want to live
                                on
                                a healthy, peaceful planet. A planet where forests flourish, oceans are full of life
                                and where
                                once-threatened animals safely roam. Where our quality of life is measured in
                                relationships, not things we have or own.</p>
                        </div>
                        <div class="accordion" id="accordionExample-two">
                            <div class="accordion-item wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                                <h2 class="accordion-header" id="heading1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                        E-Waste Recycling
                                    </button>
                                </h2>
                                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1"
                                    data-bs-parent="#accordionExample-two">
                                    <div class="accordion-body">
                                        <p>Our goal is to ensure the ability of the earth to nurture life in all its
                                            diversity: protect biodiversity in all its
                                            forms, prevent pollution of land, air and water, promote forestation and
                                            protect wildlife.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item bor-top wow fadeInDown" data-wow-duration="1.4s"
                                data-wow-delay=".4s">
                                <h2 class="accordion-header" id="heading2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                        Water Conservation
                                    </button>
                                </h2>
                                <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                                    data-bs-parent="#accordionExample-two">
                                    <div class="accordion-body">
                                        <p>Our goal is to ensure the ability of the earth to nurture life in all its
                                            diversity: protect biodiversity in all its
                                            forms, prevent pollution of land, air and water, promote forestation and
                                            protect wildlife.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item wow fadeInDown" data-wow-duration="1.6s" data-wow-delay=".6s">
                                <h2 class="accordion-header" id="heading3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                        Community devgren
                                    </button>
                                </h2>
                                <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                    data-bs-parent="#accordionExample-two">
                                    <div class="accordion-body">
                                        <p>Our goal is to ensure the ability of the earth to nurture life in all its
                                            diversity: protect biodiversity in all its
                                            forms, prevent pollution of land, air and water, promote forestation and
                                            protect wildlife.</p>
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

    <!-- Articles area start here -->
    <section class="work work-five pt-130 pb-65">
        <div class="container">
            <div class="pb-65 bor-bottom mb-65">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="section-header m-0">
                            <h5 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s"><img
                                    src="assets/images/icon/leaf.svg" alt="image"> EXPLORE </h5>
                            <h2 class="wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">Articles</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 wow fadeInDown" data-wow-duration="1.2s"
                    data-wow-delay=".2s">
                    <div class="work-five__item">
                        <div class="work__item-icon mb-30">
                            <div class="work-five__icon">
                                <i class="fa-light fa-lightbulb-on"></i>
                            </div>
                            <span>01</span>
                        </div>
                        <h3><a href="service-single.html">Energy saving</a></h3>
                        <p>We maintain a busy network of forestry and social development staff along with local
                            facilitators in the areas we work.</p>
                        <a class="work__item-arrow" href="service-single.html"><i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 wow fadeInDown" data-wow-duration="1.4s"
                    data-wow-delay=".4s">
                    <div class="work-five__item">
                        <div class="work__item-icon mb-30">
                            <div class="work-five__icon">
                                <i class="fa-light fa-seedling"></i>
                            </div>
                            <span>02</span>
                        </div>
                        <h3><a href="service-single.html">Forest protection</a></h3>
                        <p>We maintain a busy network of forestry and social development staff along with local
                            facilitators in the areas we work.</p>
                        <a class="work__item-arrow" href="service-single.html"><i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 wow fadeInDown" data-wow-duration="1.6s"
                    data-wow-delay=".6s">
                    <div class="work-five__item">
                        <div class="work__item-icon mb-30">
                            <div class="work-five__icon">
                                <i class="fa-light fa-recycle"></i>
                            </div>
                            <span>03</span>
                        </div>
                        <h3><a href="service-single.html">Cleaning & Recycling</a></h3>
                        <p>We maintain a busy network of forestry and social development staff along with local
                            facilitators in the areas we work.</p>
                        <a class="work__item-arrow" href="service-single.html"><i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 wow fadeInDown" data-wow-duration="1.8s"
                    data-wow-delay=".8s">
                    <div class="work-five__item">
                        <div class="work__item-icon mb-30">
                            <div class="work-five__icon">
                                <i class="fa-light fa-raindrops"></i>
                            </div>
                            <span>04</span>
                        </div>
                        <h3><a href="service-single.html">water saving</a></h3>
                        <p>We maintain a busy network of forestry and social development staff along with local
                            facilitators in the areas we work.</p>
                        <a class="work__item-arrow" href="service-single.html"><i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Articles area end here -->

    <!-- achievement area start here -->
    <section class="achievement-five">
        <div class="container">
            <div class="achievement-five__wrp bg-image" data-background="assets/images/bg/achievement-bg.jpg">
                <div class="row g-4 align-items-center justify-content-between">
                    <div class="col-lg-5">
                        <div class="achievement-five__item">
                            <h3 class="wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">What have we
                                achieved so far?</h3>
                            <a href="team.html" class="btn-two-light wow fadeInUp mt-50" data-wow-duration="1.2s"
                                data-wow-delay=".2s"><span>join our team</span> <i
                                    class="fa-solid fa-angles-right"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-2 wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                        <div class="achievement-five__count">
                            <h2 class="count">120</h2>
                            <h5>Social activism projects
                                accomplished</h5>
                        </div>
                    </div>
                    <div class="col-lg-2 wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">
                        <div class="achievement-five__count">
                            <h2 class="count">90</h2>
                            <h5>Communities in
                                environment</h5>
                        </div>
                    </div>
                    <div class="col-lg-2 wow fadeInUp" data-wow-duration="1.6s" data-wow-delay=".6s">
                        <div class="achievement-five__count">
                            <h2 class="count">75</h2>
                            <h5>Team members activate <br>
                                in nature</h5>
                        </div>
                    </div>
                </div>
                <div class="achievement-five__bg-overlay">
                    <img src="assets/images/bg/achievement-bg-image.jpg" alt="image">
                </div>
            </div>
        </div>
    </section>
    <!-- achievement area end here -->

    <!-- Project area sart here -->
    <section class="project-five pt-130">
        <div class="section-header text-center">
            <h5 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s"><img
                    src="assets/images/icon/leaf.svg" alt="image"> PLANT CATEGORIES</h5>
            <h2 class="wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">recent complete project</h2>
        </div>
        <div class="row g-0">
            <div class="col-xxl-3 wow fadeInDown col-lg-6" data-wow-duration="1.2s" data-wow-delay=".2s">
                <div class="project-five__image">
                    <img src="assets/images/project/project1.jpg" alt="image">
                </div>
            </div>
            <div class="col-xxl-3 wow fadeInDown col-lg-6" data-wow-duration="1.4s" data-wow-delay=".4s">
                <div class="project-five__item sub-bg">
                    <div class="project-five__content bg-white">
                        <h3><a href="project-single.html">How to save plains and forests Capitalize on low
                                hanging</a></h3>
                        <p>We maintain a busy network of forestry and social development staff
                            along with local
                            facilitators in the areas we work.</p>
                        <a href="project-single.html" class="btn-two"><span>details project</span> <i
                                class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 wow fadeInDown col-lg-6" data-wow-duration="1.6s" data-wow-delay=".6s">
                <div class="project-five__image">
                    <img src="assets/images/project/project2.jpg" alt="image">
                </div>
            </div>
            <div class="col-xxl-3 wow fadeInDown col-lg-6" data-wow-duration="1.8s" data-wow-delay=".8s">
                <div class="project-five__item sub-bg">
                    <div class="project-five__content bg-white">
                        <h3><a href="project-single.html">Project: Planting 300 trees in the city, Bring to the
                                table win-win
                                survival</a></h3>
                        <p>We maintain a busy network of forestry and social development staff
                            along with local
                            facilitators in the areas we work.</p>
                        <a href="project-single.html" class="btn-two"><span>details project</span> <i
                                class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6 wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                <div class="project-five__item sub-bg">
                    <div class="project-five__content bg-white">
                        <h3><a href="project-single.html">How to find inspiring solution and movement Leverage
                                agile
                                frameworks</a>
                        </h3>
                        <p>We maintain a busy network of forestry and social development staff
                            along with local
                            facilitators in the areas we work.</p>
                        <a href="project-single.html" class="btn-two"><span>details project</span> <i
                                class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6 wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">
                <div class="project-five__image">
                    <img src="assets/images/project/project3.jpg" alt="image">
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6 wow fadeInUp" data-wow-duration="1.6s" data-wow-delay=".6s">
                <div class="project-five__item sub-bg">
                    <div class="project-five__content bg-white">
                        <h3><a href="project-single.html">Efficiently unleash cross-media information without
                                cross-media value.</a>
                        </h3>
                        <p>We maintain a busy network of forestry and social development staff
                            along with local
                            facilitators in the areas we work.</p>
                        <a href="project-single.html" class="btn-two"><span>details project</span> <i
                                class="fa-solid fa-angles-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-6 wow fadeInUp" data-wow-duration="1.8s" data-wow-delay=".8s">
                <div class="project-five__image">
                    <img src="assets/images/project/project4.jpg" alt="image">
                </div>
            </div>
        </div>
    </section>
    <!-- Project area end here -->

    <!-- Team area removed here -->
    <!-- Donation area removed here -->
    <!-- Testimonial area removed here -->
    <!-- Blog area removed here -->

    <!-- Our info area start here -->
    <div class="our-info" data-background="assets/images/bg/our-info.jpg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">
                    <a href="index-2.html" class="our-info__logo mb-4 mb-lg-0">
                        <img src="assets/images/logo/logo-light.svg" alt="logo">
                    </a>
                </div>
                <div class="col-lg-5 wow fadeInDown" data-wow-duration="1.6s" data-wow-delay=".6s">
                    <div class="our-info__input">
                        <input type="text" placeholder="Your email Address">
                        <i class="fa-regular fa-envelope our-info__input-envelope"></i>
                        <i class="fa-solid fa-paper-plane our-info__input-plane"></i>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="our-info__social-icon float-lg-end float-none mt-4 mt-lg-0">
                        <a class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s" href="#0"><i
                                class="fa-brands fa-facebook-f"></i></a>
                        <a class="wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".3s" href="#0"><i
                                class="fa-brands fa-twitter"></i></a>
                        <a class="wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s" href="#0"><i
                                class="fa-brands fa-linkedin-in"></i></a>
                        <a class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".5s" href="#0"><i
                                class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our info area end here -->

@endsection
