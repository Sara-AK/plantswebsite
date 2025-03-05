<div id="targetElement" class="side_bar slideInRight side_bar_hidden">
    <div class="side_bar_overlay"></div>

    <!-- 🔹 User Links -->
    @auth
        <ul class="info py-4 mt-4 bor-top bor-bottom">
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'seller')
                @if (auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fa-solid fa-screwdriver-wrench"></i> Admin Dashboard
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.index') }}">
                        <i class="fa-solid fa-box"></i> Manage Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.plants.index') }}">
                        <i class="fa-solid fa-seedling"></i> Manage Plants
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.regions.index') }}">
                        <i class="fa-solid fa-map"></i> Manage Regions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">
                        <i class="fa-solid fa-leaf"></i> Manage Plant Categories
                    </a>
                </li>
            @endif
            @if (Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users') }}">
                        <i class="fa-solid fa-users"></i> Manage Users
                    </a>
                </li>
            @endif
        </ul>
    @endauth

    <!-- 🔹 Contact Info -->
    <ul class="info py-4 mt-4 bor-top bor-bottom">
        <li>
            <i class="fa-solid fa-envelope primary-color"></i>
            <a href="mailto:example@example.com">example@example.com</a>
        </li>
        <li class="py-3">
            <i class="fa-solid fa-phone primary-color"></i>
            <a href="tel:+022659302003">+02 2659 302 003</a>
        </li>
        <li>
            <i class="fa-solid fa-paper-plane primary-color"></i>
            <a href="mailto:info.company@gmail.com">info.company@gmail.com</a>
        </li>
    </ul>

    <!-- 🔹 Social Icons -->
    <div class="social-icon mt-4 text-center">
        <a href="#0"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#0"><i class="fa-brands fa-twitter"></i></a>
        <a href="#0"><i class="fa-brands fa-linkedin-in"></i></a>
        <a href="#0"><i class="fa-brands fa-instagram"></i></a>
    </div>

    <!-- ❌ Close Button -->
    <button id="closeButton" class="close-btn">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>
