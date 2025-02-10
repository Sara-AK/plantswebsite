@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
<div class="container">
    <h2>📋 Manage Products</h2>

    <!-- Add New Product Button (Only for Admins & Sellers) -->
    <div class="mb-4 text-end">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            ➕ Add New Product
        </a>
    </div>

    @if($products->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            <!-- View -->
                            <a href="{{ route('public.products.show', $product->id) }}" class="btn btn-info">👁 View</a>

                            <!-- Edit (Only for Admins & Product Owners) -->
                            @if(auth()->user()->role === 'admin' || auth()->id() === $product->seller_id)
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">✏ Edit</a>

                                <!-- Delete -->
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        🗑 Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    @else
        <p>No products found.</p>
    @endif
</div>
@endsection
