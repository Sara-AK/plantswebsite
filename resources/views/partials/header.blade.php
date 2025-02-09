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
                    @php
                        // Fetch role request only if user is NOT an admin
                        $roleRequest = Auth::user()->role !== 'admin'
                            ? \App\Models\RoleRequest::where('user_id', Auth::id())->latest()->first()
                            : null;
                    @endphp

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.role.requests') }}"><i class="fa-solid fa-user-check"></i> Manage Role Requests</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.assign') }}"><i class="fa-solid fa-user-shield"></i> Assign Admin</a></li>
                            @endif

                            {{-- Only show role request option for non-admins --}}
                            @if(Auth::user()->role !== 'admin')
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#roleRequestModal">
                                        <i class="fa-solid {{ $roleRequest ? 'fa-clock' : 'fa-user-plus' }}"></i>
                                        {{ $roleRequest ? 'View Role Request' : 'Request Role' }}
                                    </a>
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

{{-- Role Request Modal (Only loaded if user is authenticated & not admin) --}}
@if(Auth::check() && Auth::user()->role !== 'admin')
    <div class="modal fade" id="roleRequestModal" tabindex="-1" aria-labelledby="roleRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleRequestModalLabel">
                        {{ $roleRequest ? 'Manage Role Request' : 'Request a Role' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($roleRequest)
                        <div class="alert alert-info">
                            Your current request: <strong>{{ ucfirst($roleRequest->requested_role) }}</strong>
                            (Status: <strong>{{ ucfirst($roleRequest->status) }}</strong>)
                        </div>

                        @if($roleRequest->status === 'approved')
                            <form method="POST" action="{{ route('role.request.remove') }}">
                                @csrf
                                <button type="submit" class="btn btn-warning"><i class="fa-solid fa-user-slash"></i> Request Role Removal</button>
                            </form>

                            <form method="POST" action="{{ route('role.request.change') }}" class="mt-3">
                                @csrf
                                <label for="requested_role">Change Role:</label>
                                <select name="requested_role" class="form-select">
                                    <option value="gardener" @if(Auth::user()->role == 'gardener') disabled @endif>Gardener</option>
                                    <option value="seller" @if(Auth::user()->role == 'seller') disabled @endif>Seller</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-2"><i class="fa-solid fa-exchange-alt"></i> Request Role Change</button>
                            </form>
                        @endif
                    @else
                        <div class="alert alert-warning">
                            You have not submitted any role request.
                        </div>

                        <form method="POST" action="{{ route('role.request') }}">
                            @csrf
                            <label for="requested_role">Select Role:</label>
                            <select name="requested_role" class="form-select">
                                <option value="gardener">Gardener</option>
                                <option value="seller">Seller</option>
                            </select>
                            <button type="submit" class="btn btn-success mt-2"><i class="fa-solid fa-user-plus"></i> Request Role</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif


{{-- Ensure Bootstrap is included for modals to function properly --}}
@if(!request()->is('admin/*')) {{-- Only include if not in admin panel --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endif
