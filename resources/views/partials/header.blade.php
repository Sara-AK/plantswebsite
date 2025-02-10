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
                        $roleRequest = Auth::user()->role !== 'admin'
                            ? \App\Models\RoleRequest::where('user_id', Auth::id())->latest()->first()
                            : null;
                    @endphp

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            {{-- @if(Auth::user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.role.requests') }}"><i class="fa-solid fa-user-check"></i> Manage Role Requests</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.assign') }}"><i class="fa-solid fa-user-shield"></i> Assign Admin</a></li>
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#registerUserModal">
                                        <i class="fa-solid fa-user-plus"></i> Register User
                                    </a>
                                </li>
                            @endif --}}

                            {{-- Only show role request option for non-admins --}}
                            @if(Auth::user()->role !== 'admin')
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#roleRequestModal">
                                        <i class="fa-solid {{ $roleRequest ? 'fa-clock' : 'fa-user-plus' }}"></i>
                                        {{ $roleRequest ? 'View Role Request' : 'Request Role' }}
                                    </a>
                                </li>
                            @endif

                            {{-- Only show role request option for non-admins --}}
                            {{-- @if(Auth::user()->role !== 'admin')
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#roleRequestModal">
                                        <i class="fa-solid {{ Auth::user()->role !== 'user' ? 'fa-exchange-alt' : 'fa-user-plus' }}"></i>
                                        {{ Auth::user()->role !== 'user' ? 'Manage Role Request' : 'Request Role' }}
                                    </a>
                                </li>
                            @endif --}}
                            {{-- <li>
                                @if(Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.users') }}"><i class="fa-solid fa-users"></i> Manage Users</a></li>
                                @endif
                            </li> --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fa-solid fa-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                            <li>
                                @if(Auth::user()->role !== 'admin') {{-- Users (except admins) can delete their account --}}
                                    <form method="POST" action="{{ route('account.delete') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-trash"></i> Delete My Account</button>
                                    </form>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <li>
                        @if(Auth::check() && request()->is('products'))
                            <div class="shopping-cart">
                                <a href="{{ route('cart.index') }}" class="btn btn-primary">
                                    🛒 Cart ({{ session('cart') ? count(session('cart')) : 0 }})
                                </a>
                            </div>
                        @endif
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

{{-- Role Request Modal (Only loaded if user is authenticated & not admin)
@if(Auth::check() && Auth::user()->role !== 'admin')
    <div class="modal fade" id="roleRequestModal" tabindex="-1" aria-labelledby="roleRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleRequestModalLabel">
                        {{ Auth::user()->role !== 'user' ? 'Manage Role Request' : 'Request a Role' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(Auth::user()->role !== 'user')
                        <div class="alert alert-info">
                            Your current role: <strong>{{ ucfirst(Auth::user()->role) }}</strong>
                        </div>

                        {{-- Role Removal
                        @if(Auth::user()->role !== 'user') {{-- Only for admins, gardeners, and sellers
                            <form method="POST" action="{{ route('role.remove') }}">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa-solid fa-user-slash"></i> Remove My Role (Become Regular User)
                                </button>
                            </form>
                        @endif


                        {{-- Role Change Request
                        <form method="POST" action="{{ route('role.request.change') }}" class="mt-3">
                            @csrf
                            <label for="requested_role">Change Role:</label>
                            <select name="requested_role" class="form-select">
                                <option value="gardener" @if(Auth::user()->role == 'gardener') disabled @endif>Gardener</option>
                                <option value="seller" @if(Auth::user()->role == 'seller') disabled @endif>Seller</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2"><i class="fa-solid fa-exchange-alt"></i> Request Role Change</button>
                        </form>
                    @else
                        {{-- Initial Role Request
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
@endif --}}

{{-- Role Request Modal (Only loaded if user is authenticated & not admin) --}}
@if(Auth::check() && Auth::user()->role !== 'admin')
    <div class="modal fade" id="roleRequestModal" tabindex="-1" aria-labelledby="roleRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleRequestModalLabel">
                        @if(Auth::user()->role !== 'user')
                            Request to Change Role {{-- If user has a role (gardener/seller) --}}
                        @else
                            {{ $roleRequest ? 'Manage Role Request' : 'Request a Role' }} {{-- If user is regular user --}}
                        @endif
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(Auth::user()->role !== 'user') {{-- If user is gardener or seller --}}
                        <div class="alert alert-info">
                            Your current role: <strong>{{ ucfirst(Auth::user()->role) }}</strong>
                        </div>

                        {{-- Role Removal (Downgrade to Regular User) --}}
                        <form method="POST" action="{{ route('role.remove') }}">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                <i class="fa-solid fa-user-slash"></i> Remove Role (Become Regular User)
                            </button>
                        </form>

                        {{-- Role Change Request --}}
                        <form method="POST" action="{{ route('role.request.change') }}" class="mt-3">
                            @csrf
                            <label for="requested_role">Change Role:</label>
                            <select name="requested_role" class="form-select">
                                <option value="gardener" @if(Auth::user()->role == 'gardener') disabled @endif>Gardener</option>
                                <option value="seller" @if(Auth::user()->role == 'seller') disabled @endif>Seller</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2"><i class="fa-solid fa-exchange-alt"></i> Request Role Change</button>
                        </form>

                    @elseif($roleRequest) {{-- If user is regular and has a pending request --}}
                        <div class="alert alert-info">
                            Your current request: <strong>{{ ucfirst($roleRequest->requested_role) }}</strong>
                            (Status: <strong>{{ ucfirst($roleRequest->status) }}</strong>)
                        </div>

                        {{-- Allow user to cancel the role request --}}
                        <form method="POST" action="{{ route('role.request.cancel') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-ban"></i> Cancel Request</button>
                        </form>

                    @else {{-- If user is regular and has no request --}}
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

<!-- Register User Modal -->
<div class="modal fade" id="registerUserModal" tabindex="-1" aria-labelledby="registerUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerUserModalLabel">Register New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.register.user') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Select Role</label>
                        <select class="form-select" name="role" id="role" required>
                            <option value="user">User</option>
                            <option value="gardener">Gardener</option>
                            <option value="seller">Seller</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-user-plus"></i> Register User</button>
                </form>
            </div>
        </div>
    </div>
</div>
