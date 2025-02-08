<!DOCTYPE html>
<html lang="en">

@extends('layouts.navigation')

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devgren - Gardening and Landscaping HTML Template</title>
    <!-- Favicon img -->
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <!-- Bootstarp min css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- All min css -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- Swiper bundle min css -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!-- Magnigic popup css -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- Animate css -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Nice select css -->
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <!-- Style css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Preloader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="loading-icon text-center d-flex flex-column align-items-center justify-content-center">
                    <img class="loading-logo" src="assets/images/preloader.svg" alt="icon">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader area end -->

@section('content')
<!-- Page banner area start here -->
<section class="page-banner bg-image pt-130 pb-130">
    <div class="container">
        <div class="d-flex align-items-center">
            <!-- Back arrow to home -->
            <a href="{{ route('home') }}" class="back-arrow me-3">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h2 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">Role Request Status</h2>
        </div>
        <div class="breadcrumb-list wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">
            <a href="{{ route('home') }}">Home :</a>
            <span class="primary-color">Role Request</span>
        </div>
    </div>
</section>
<!-- Page banner area end here -->

<!-- Role Request Status -->
<section class="role-request-area pt-130 pb-130">
    <div class="container">
        <div class="login__item">
            <div class="row g-4">
                <div class="col-xxl-6 offset-xxl-3">
                    <div class="login__content text-center">
                        <h2 class="text-white mb-65">Check Your Role Request</h2>

                        @if ($request)
                            <p class="text-white">
                                Your request to become a <strong>{{ ucfirst($request->role) }}</strong> is currently:
                                <strong class="primary-color">{{ ucfirst($request->status) }}</strong>
                            </p>
                        @else
                            <p class="text-white">You have not made any role requests yet.</p>
                        @endif

                        <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                            <i class="fa-solid fa-arrow-left"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Role Request Status End -->

@endsection
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
</main>

<!-- Footer area start here -->
<footer class="footer bg-image" data-background="assets/images/bg/footer-bg.jpg">
    <div class="container">
        <div class="pt-65 pb-65">
            <div class="row g-4">
                <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                    <div class="footer__item">
                        <div class="footer__item-title">
                            <h4>about Devgren</h4>
                            <span class="footer__item-title-line"></span><span
                                class="footer__item-title-line2"></span>
                        </div>
                        <p>Tree planting is the act of planting young trees, shrubs, or other woody plants into the
                            ground to establish new</p>
                        <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29581.552527417!2d-77.04440883230183!3d38.80089850193032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b7b0f02c6539a9%3A0xacc6091466dd9068!2s901%20N%20Pitt%20St%20Suite%20170%2C%20Alexandria%2C%20VA%2022314%2C%20USA!5e0!3m2!1sen!2sbd!4v1694324425557!5m2!1sen!2sbd"
                            class="footer__item-map-popup map-popup">View Map <i
                                class="fa-solid fa-location-arrow"></i></a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">
                    <div class="footer__item">
                        <div class="footer__item-title">
                            <h4>Get in touch!</h4>
                            <span class="footer__item-title-line"></span><span
                                class="footer__item-title-line2"></span>
                        </div>
                        <ul>
                            <li class="pb-3"><a href="#0"><i
                                        class="fa-solid fa-location-dot pe-1 primary-color"></i>
                                    901 N Pitt Str., Suite 170
                                    Alexandria, <br> USA
                                </a>
                            </li>
                            <li class="pb-3"><a href="tel:+4065550120"><i
                                        class="fa-solid fa-phone-volume pe-1 primary-color"></i>
                                    (406) 555-0120
                                </a></li>
                            <li><a href="#0"><i class="fa-solid fa-envelope pe-1 primary-color"></i>
                                    info@extrem.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-duration="1.6s" data-wow-delay=".6s">
                    <div class="footer__item">
                        <div class="footer__item-title">
                            <h4>Quick Link</h4>
                            <span class="footer__item-title-line"></span><span
                                class="footer__item-title-line2"></span>
                        </div>
                        <ul>
                            <li class="pb-1"><a href="service-single.html"><i
                                        class="fa-solid fa-chevron-right pe-1 primary-color"></i> Water Conservation
                                </a>
                            </li>
                            <li class="pb-1"><a href="service-single.html"><i
                                        class="fa-solid fa-chevron-right pe-1 primary-color"></i> Eco System
                                </a>
                            </li>
                            <li class="pb-1"><a href="service-single.html"><i
                                        class="fa-solid fa-chevron-right pe-1 primary-color"></i> Plastic Recycleing
                                </a>
                            </li>
                            <li class="pb-1"><a href="service-single.html"><i
                                        class="fa-solid fa-chevron-right pe-1 primary-color"></i> Urban planning
                                </a>
                            </li>
                            <li><a href="service-single.html"><i
                                        class="fa-solid fa-chevron-right pe-1 primary-color"></i> Save Green
                                    House
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-duration="1.8s" data-wow-delay=".8s">
                    <div class="footer__item">
                        <div class="footer__item-title">
                            <h4>recent news</h4>
                            <span class="footer__item-title-line"></span><span
                                class="footer__item-title-line2"></span>
                        </div>
                        <ul class="footer__item-blog">
                            <li class="pb-3">
                                <img src="assets/images/footer/01.png" alt="image">
                                <div class="ms-3">
                                    <h4><a href="blog-single.html">Close up picture of the sapling</a></h4>
                                    <span>2 weeks ago</span>
                                </div>
                            </li>
                            <li>
                                <img src="assets/images/footer/02.png" alt="image">
                                <div class="ms-3">
                                    <h4><a href="blog-single.html">Close up picture of the sapling</a></h4>
                                    <span>2 weeks ago</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__copyright">
        <p>&copy; Copyright 2024 <a href="#0">Devgren</a> All Rights Reserved</p>
    </div>
</footer>
<!-- Footer area end here -->

<!-- Back to top area start here -->
<div class="scroll-up">
    <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- Back to top area end here -->

<!-- Jquery 3. 7. 1 Min Js -->
<script src="assets/js/jquery-3.7.1.min.js"></script>
<!-- Bootstrap min Js -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Swiper bundle min Js -->
<script src="assets/js/swiper-bundle.min.js"></script>
<!-- Counterup min Js -->
<script src="assets/js/jquery.counterup.min.js"></script>
<!-- Wow min Js -->
<script src="assets/js/wow.min.js"></script>
<!-- Magnific popup min Js -->
<script src="assets/js/magnific-popup.min.js"></script>
<!-- Nice select min Js -->
<script src="assets/js/nice-select.min.js"></script>
<!-- Isotope pkgd min Js -->
<script src="assets/js/isotope.pkgd.min.js"></script>
<!-- Waypoints Js -->
<script src="assets/js/jquery.waypoints.js"></script>
<!-- Script Js -->
<script src="assets/js/script.js"></script>
</body>


<!-- Mirrored from iideainformatics.it/html/devgalaxy/devgren/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Aug 2024 06:55:16 GMT -->
</html>

