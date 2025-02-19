@extends('layouts.app')
@section('title', 'Plant Products Page')
@section('content')

    <!-- Page banner area start here -->
    <section class="page-banner bg-image pt-130 pb-130">
        <div class="container">
            <h2 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">All Products</h2>
        </div>
    </section>
    <!-- Page banner area end here -->

    <section class="donation-inner pb-130">
        <div class="container">


            <!-- 🔍 Search and Filter Form -->
            <form method="GET" action="{{ route('public.products.index') }}" class="mb-4">
                <div class="row align-items-end mt-4 pb-3 pt-3 border-bottom">
                    <!-- Search Bar -->
                    <div class="col-md-4">
                        <label for="search" class="form-label fw-bold"></label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Search products...">
                    </div>

                    <!-- Category Dropdown -->
                    <div class="col-md-3">
                        <label for="category" class="form-label fw-bold"></label>
                        <select id="category" name="category" class="form-control">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sorting -->
                    <div class="col-md-3">
                        <label for="sort" class="form-label fw-bold"></label>
                        <select id="sort" name="sort" class="form-control">
                            <option value="">Sort By</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 mt-4">Apply</button>
                    </div>
                </div>
            </form>

            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-lg-4 wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                        <div class="donation__item bor">
                            <div class="image mb-30">
                                <img src="{{ $product->picture_url }}" alt="{{ $product->name }}">
                            </div>
                            <h3><a href="{{ route('public.products.show', $product->id) }}">{{ $product->name }}</a></h3>
                            <p>{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>

                            <!-- Price Display -->
                            <div class="price mt-3">
                                <h4 class="text-success">Price: ${{ number_format($product->price, 2) }}</h4>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{ route('public.products.show', $product->id) }}" class="btn-one">
                                    <span>View Details</span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>

                            <div class="text-center mt-3">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        🛒 Add to Cart
                                    </button>
                                </form>
                            </div>

                            @if(!auth()->check())
                                <script>
                                    document.querySelectorAll('form[action*="cart.add"]').forEach(form => {
                                        form.addEventListener('submit', function(e) {
                                            e.preventDefault();
                                            window.location.href = "{{ route('login') }}";
                                        });
                                    });
                                </script>
                            @endif


                        </div>
                    </div>
                @endforeach
            </div>

            <div class="pagi-wrp mt-65 justify-content-center wow fadeInDown" data-wow-duration="1.2s" data-wow-delay=".2s">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>

@endsection
