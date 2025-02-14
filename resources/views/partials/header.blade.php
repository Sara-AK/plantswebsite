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
                    <li><a class="text-white" href="{{ url('contact') }}">Contact Us</a></li>

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
                                        {{-- Kept the existing condition --}}
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
                        @if(Auth::check() && request()->is('products'))
                            <div class="shopping-cart">
                                <a href="{{ route('cart.index') }}" class="btn btn-primary">
                                    🛒 Cart ({{ session('cart') ? count(session('cart')) : 0 }})
                                </a>
                            </div>
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

{{-- Role Request Modal (Only for non-admin users) --}}
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

                    {{-- If the user has a pending role request --}}
                    @if($roleRequest && $roleRequest->status === 'pending')
                        <div class="alert alert-info">
                            Your current request: <strong>{{ ucfirst($roleRequest->requested_role) }}</strong>
                            (Status: <strong>{{ ucfirst($roleRequest->status) }}</strong>)
                        </div>

                        {{-- Cancel Role Request Button --}}
                        <form method="POST" action="{{ route('role.request.cancel') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-ban"></i> Cancel Request</button>
                        </form>

                    {{-- If the user's request was rejected, show a rejection message --}}
                    @elseif($roleRequest && $roleRequest->status === 'rejected')
                        <div class="alert alert-warning">
                            Your previous request to become a <strong>{{ ucfirst($roleRequest->requested_role) }}</strong> was rejected.
                            You may submit a new request.
                        </div>

                        {{-- Allow user to submit a new request --}}
                        <form method="POST" action="{{ route('role.request') }}" enctype="multipart/form-data">
                            @csrf
                            <label for="requested_role">Select Role:</label>
                            <select name="requested_role" class="form-select">
                                <option value="gardener">Gardener</option>
                                <option value="seller">Seller</option>
                            </select>

                            <label for="request_note" class="mt-2">Additional Information (Optional):</label>
                            <textarea name="request_note" class="form-control" rows="3" placeholder="Explain why you are applying for this role..."></textarea>

                            <label for="cv_file" class="mt-2">Upload CV (Optional):</label>
                            <input type="file" name="cv_file" class="form-control" accept=".pdf,.doc,.docx">

                            <button type="submit" class="btn btn-success mt-2">
                                <i class="fa-solid fa-user-plus"></i> Request Role
                            </button>
                        </form>

                    {{-- If the user already has a role (not a regular user) --}}
                    @elseif(Auth::user()->role !== 'user')
                        <div class="alert alert-info">
                            Your current role: <strong>{{ ucfirst(Auth::user()->role) }}</strong>
                        </div>

                        {{-- Remove Role Button --}}
                        <form method="POST" action="{{ route('role.remove') }}">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                <i class="fa-solid fa-user-slash"></i> Remove My Role (Become Regular User)
                            </button>
                        </form>

                    {{-- If no role request exists, allow new submission --}}
                    @else
                        <div class="alert alert-warning">
                            You have not submitted any role request.
                        </div>

                        <form method="POST" action="{{ route('role.request') }}" enctype="multipart/form-data">
                            @csrf
                            <label for="requested_role">Select Role:</label>
                            <select name="requested_role" class="form-select">
                                <option value="gardener">Gardener</option>
                                <option value="seller">Seller</option>
                            </select>

                            <label for="request_note" class="mt-2">Additional Information (Optional):</label>
                            <textarea name="request_note" class="form-control" rows="3" placeholder="Explain why you are applying for this role..."></textarea>

                            <label for="cv_file" class="mt-2">Upload CV (Optional):</label>
                            <input type="file" name="cv_file" class="form-control" accept=".pdf,.doc,.docx">

                            <button type="submit" class="btn btn-success mt-2">
                                <i class="fa-solid fa-user-plus"></i> Request Role
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

{{-- Success Message --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
