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
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                @if(Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.role.requests') }}"><i class="fa-solid fa-user-check"></i> Manage Role Requests</a></li>
                                @endif

                                @if(Auth::user()->role === 'user')
                                    <li>
                                        <form method="POST" action="{{ route('role.request') }}">
                                            @csrf
                                            <input type="hidden" name="requested_role" value="gardener">
                                            <button type="submit" class="dropdown-item"><i class="fa-solid fa-leaf"></i> Request Gardener Role</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('role.request') }}">
                                            @csrf
                                            <input type="hidden" name="requested_role" value="seller">
                                            <button type="submit" class="dropdown-item"><i class="fa-solid fa-store"></i> Request Seller Role</button>
                                        </form>
                                    </li>
                                @endif

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fa-solid fa-arrow-right"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
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
