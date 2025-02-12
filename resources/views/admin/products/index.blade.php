@extends('layouts.admin')

@section('title', 'Manage Plant Products')

@section('content')
    <section class="content">
        <div class="section-header text-center">
            <h5 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                ALL PLANT PRODUCTS
            </h5>
            <h2 class="wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">Edit and Add Plant Products</h2>
        </div>
        <div class="container-fluid">

            <!-- Plant Products List -->
            <div class="card shadow-sm rounded">
                <div class="card-header bg-dark-green d-flex justify-content-between align-items-center rounded">
                    <h3 class="card-title text-white">All Plant Products</h3>
                    <button type="button" class="btn btn-tool text-white" data-bs-toggle="collapse" data-bs-target="#productsTable">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-dark-green rounded">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th>Product</th>
                                <th class="d-none d-lg-table-cell">Description</th>
                                <th class="d-none d-md-table-cell">Associated Plant</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plantProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td class="d-none d-lg-table-cell">{{ \Illuminate\Support\Str::limit($product->description, 50) }}</td>
                                    <td class="d-none d-md-table-cell">
                                        {{ $product->plant ? $product->plant->name : 'N/A' }}
                                    </td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

    <style>
        .bg-dark-green {
            background-color: #4baf47 !important;
            color: white !important;
        }
        .table-dark-green {
            border: 0.5px solid #04240c;
        }
        .btn-success {
            background-color: #2d6a32 !important;
            border-color: #4baf47 !important;
        }
        .btn-success:hover {
            background-color: #4baf47 !important;
        }
        .rounded {
            border-radius: 10px !important;
        }
        .rounded-pill {
            border-radius: 50px !important;
        }
    </style>

    <!-- Ensure jQuery & Bootstrap JS are included -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>


@endsection
