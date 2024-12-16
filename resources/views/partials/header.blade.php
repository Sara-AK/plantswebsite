<!-- Header area start here -->
<header class="header header-five">
    <div class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="side-bars d-none d-xl-block">
                    <i id="openButton" class="text-white fa-solid fa-bars"></i>
                </div>
                <div class="logo-menu d-block d-xl-none">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('assets/images/logo/logo-light.svg') }}" alt="logo">
                    </a>
                </div>
                <div class="header-bar d-xl-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="main-menu">
                    <li><a class="text-white" href="#">About Us</a></li>
                    <li><a class="text-white" href="#">Services</a></li>
                    <li><a class="text-white" href="{{ url('contact') }}">Contact Us</a></li>
                    <li class="menu-btn">
                        <a href="{{ url('contact') }}"><span>Sign Up</span> <i class="fa-solid fa-arrow-right"></i></a>
                    </li>
                </ul>
                <!-- Mega menu area start here -->
                <div class="mega-menu-area d-none d-xl-block">
                    <div class="container">
                        <div class="mega-menu">
                            <div class="row g-4 justify-content-between">
                                <div class="col-md-2">
                                    <div class="mega-menu__item">
                                        <h5 class="primary-color">Our Project</h5>
                                        <ul>
                                            <li><a href="{{ url('project') }}">Our Project 01</a></li>
                                            <li><a href="{{ url('project-2') }}">Our Project 02</a></li>
                                            <li><a href="{{ url('project-single') }}">Project Details</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Additional columns here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mega menu area end here -->
            </div>
        </div>
    </div>
</header>
<!-- Header area end here -->
