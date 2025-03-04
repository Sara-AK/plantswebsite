<header class="header header-five">
    <div class="header-section">
        <div class="container">
            <div class="header-wrapper">
                {{-- Sidebar for large screens --}}
                <div class="side-bars d-none d-xl-block">
                    <i id="openButton" class="text-white fa-solid fa-bars"></i>
                </div>

                {{-- Logo --}}
                <div class="logo-menu d-block d-xl-none">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{ asset('assets/images/logo/logo-light.svg') }}" alt="logo">
                    </a>
                </div>

                {{-- Main Navigation --}}
                <ul class="main-menu">
                    <li><a class="text-white" href="/">Home</a></li>

                    {{-- Gardener Buttons --}}
                    @auth
                        @if(Auth::user()->role === 'admin')
                    <li><a class="text-white" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                @endif
                @if(Auth::user()->role === 'gardener')
                                <li><a class="text-white" href="{{ route('gardeners.index') }}">My Requests</a></li>
                        @else
                            <li><a class="text-white" href="{{ route('gardeners.index') }}">Contact a Gardener</a></li>
                        @endif
                    @endauth

                    {{-- Ensure "Contact a Gardener" is visible to guests too --}}
                    @guest
                        <li><a class="text-white" href="{{ route('gardeners.index') }}">Contact a Gardener</a></li>
                    @endguest

                    @auth
                        @php
                            // Fetch the latest role request of the user if not admin
                            $roleRequest = Auth::user()->role !== 'admin'
                                ? \App\Models\RoleRequest::where('user_id', Auth::id())->latest()->first()
                                : null;
                        @endphp

                        {{-- User Dropdown --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">

                                {{-- Role Request & Management (Only for non-admins) --}}
                                @if(Auth::user()->role !== 'admin')
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#roleRequestModal">
                                            <i class="fa-solid {{ $roleRequest ? 'fa-clock' : 'fa-user-plus' }}"></i>
                                            {{ $roleRequest == 'user' ? 'Request Role' : 'Manage Role Request' }}
                                        </a>
                                    </li>
                                @endif

                                {{-- Logout --}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fa-solid fa-arrow-right"></i> Logout</button>
                                    </form>
                                </li>

                                {{-- Delete Account (Only for non-admins) --}}
                                <li>
                                    @if(Auth::user()->role !== 'admin')
                                        <form method="POST" action="{{ route('account.delete') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-trash"></i> Delete My Account</button>
                                        </form>
                                    @endif
                                </li>
                            </ul>
                        </li>

                        {{-- Shopping Cart (Only visible on product pages) --}}
                        <li>
                            @if(request()->is('products'))
                                <a href="{{ route('cart.index') }}" class="nav-link text-white">Cart</a>
                            @endif
                        </li>
                    @else
                        {{-- Sign-Up Button for Guests --}}
                        <li class="menu-btn">
                            <a href="{{ route('register') }}"><span>Sign Up</span> <i class="fa-solid fa-arrow-right"></i></a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>
