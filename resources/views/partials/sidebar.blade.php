<div id="targetElement" class="side_bar slideInRight side_bar_hidden">
    <div class="side_bar_overlay"></div>

    <!-- 🔹 Navigation Links -->
    <ul class="info py-4 mt-4 bor-top bor-bottom">
        <!-- Show only on medium and smaller screens -->
        <div class="">
            <li><a class="nav-link" href="/"><i class="fa-solid fa-house"></i> Home</a></li>

            @auth
                @if (Auth::user()->role === 'gardener')
                    <li><a class="nav-link" href="{{ route('gardeners.index') }}"><i class="fa-solid fa-seedling"></i> My
                            Requests</a></li>
                @endif

                @if (Auth::user()->role === 'admin')
                    <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i
                                class="fa-solid fa-screwdriver-wrench"></i> Admin Dashboard</a></li>
                @endif

                <!-- Shopping Cart (Only visible on product pages) -->
                <li><a href="{{ route('cart.index') }}"><i class="fa-solid fa-shopping-cart"></i> Cart</a></li>

                <!-- Logout Button -->
                <li>
                    <a href="{{ route('logout') }}" class="nav-link text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-arrow-right"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

                <!-- Delete Account Button (Only for non-admins) -->
                @if (Auth::user()->role !== 'admin')
                    <li>
                        <a href="{{ route('account.delete') }}" class="nav-link text-danger"
                            onclick="event.preventDefault(); document.getElementById('delete-account-form').submit();">
                            <i class="fa-solid fa-trash"></i> Delete My Account
                        </a>
                        <form id="delete-account-form" action="{{ route('account.delete') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
            @endauth
        </div>

        @auth
            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'seller')
                <li><a class="nav-link" href="{{ route('admin.products.index') }}"><i class="fa-solid fa-box"></i> Manage
                        Products</a></li>
                <li><a class="nav-link" href="{{ route('admin.plants.index') }}"><i class="fa-solid fa-seedling"></i> Manage
                        Plants</a></li>
                <li><a class="nav-link" href="{{ route('admin.regions.index') }}"><i class="fa-solid fa-map"></i> Manage
                        Regions</a></li>
                <li><a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fa-solid fa-leaf"></i>
                        Manage Plant Categories</a></li>
            @endif

            @if (Auth::user()->role === 'admin')
                <li><a class="nav-link" href="{{ route('admin.users') }}"><i class="fa-solid fa-users"></i> Manage
                        Users</a></li>
            @endif
        @else
            <!-- Sign Up for Guests -->
            <li><a href="{{ route('register') }}"><i class="fa-solid fa-user-plus"></i> Sign Up</a></li>
        @endauth
    </ul>

    <!-- 🔹 Contact Info -->
    <ul class="info py-4 mt-4 bor-top bor-bottom">
        <li><i class="fa-solid fa-envelope primary-color"></i> <a
                href="mailto:example@example.com">example@example.com</a></li>
        <li class="py-3"><i class="fa-solid fa-phone primary-color"></i> <a href="tel:+022659302003">+02 2659 302
                003</a></li>
        <li><i class="fa-solid fa-paper-plane primary-color"></i> <a
                href="mailto:info.company@gmail.com">info.company@gmail.com</a></li>
    </ul>

    <!-- 🔹 Social Icons -->
    <div class="social-icon mt-4 text-center">
        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#"><i class="fa-brands fa-twitter"></i></a>
        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
        <a href="#"><i class="fa-brands fa-instagram"></i></a>
    </div>

    <!-- ❌ Close Button -->
    <button id="closeButton" class="close-btn">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>
