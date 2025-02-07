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
                <ul class="main-menu">
                    <li><a class="text-white" href="/">Home</a></li>
                    <li><a class="text-white" href="{{ url('contact') }}">Contact Us</a></li>
                    @auth
                        <li class="menu-btn">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link text-white" style="border: none; background: none; cursor: pointer;">
                                    Logout <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="menu-btn">
                            <a href="{{ route('register') }}"><span>Sign Up</span> <i class="fa-solid fa-arrow-right"></i></a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>
