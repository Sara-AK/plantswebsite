<footer class="footer bg-image" data-background="{{ asset('assets/images/bg/footer-bg.jpg') }}">
    <div class="container">
        <div class="pt-65 pb-65">
            <div class="row g-4">
                <!-- About Section -->
                <div class="col-xl-3 col-md-6">
                    <div class="footer__item">
                        <div class="footer__item-title">
                            <h4>About Our Project</h4>
                            <span class="footer__item-title-line"></span>
                            <span class="footer__item-title-line2"></span>
                        </div>
                        <p>Our platform connects plant lovers with expert gardeners and sellers. Find plants, get advice, and explore a vibrant gardening community.</p>
                        <a href="{{ route('home') }}" class="footer__item-map-popup">Visit Us <i class="fa-solid fa-location-arrow"></i></a>
                    </div>
                </div>

                <!-- Get in Touch -->
                <div class="col-xl-3 col-md-6">
                    <div class="footer__item">
                        <div class="footer__item-title">
                            <h4>Get in Touch</h4>
                            <span class="footer__item-title-line"></span>
                            <span class="footer__item-title-line2"></span>
                        </div>
                        <ul>
                            <li class="pb-3"><i class="fa-solid fa-location-dot pe-1 primary-color"></i> 123 Green Street, Plant City</li>
                            <li class="pb-3"><a href="tel:+1234567890"><i class="fa-solid fa-phone-volume pe-1 primary-color"></i> +1 234 567 890</a></li>
                            <li><a href="mailto:support@plantsite.com"><i class="fa-solid fa-envelope pe-1 primary-color"></i> support@plantsite.com</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-xl-3 col-md-6">
                    <div class="footer__item">
                        <div class="footer__item-title">
                            <h4>Quick Links</h4>
                            <span class="footer__item-title-line"></span>
                            <span class="footer__item-title-line2"></span>
                        </div>
                        <ul>
                            <li class="pb-1"><a href="{{ route('public.plants.index') }}"><i class="fa-solid fa-chevron-right pe-1 primary-color"></i> Plants</a></li>
                            <li class="pb-1"><a href="{{ route('public.products.index') }}"><i class="fa-solid fa-chevron-right pe-1 primary-color"></i> Products</a></li>
                            <li class="pb-1"><a href="{{ route('home') }}"><i class="fa-solid fa-chevron-right pe-1 primary-color"></i> Home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer__copyright">
        <p>&copy; {{ date('Y') }} <a href="{{ route('home') }}">PlantConnect</a>. All Rights Reserved.</p>
    </div>
</footer>
