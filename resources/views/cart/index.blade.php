@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container">
    <h2>🛒 Your Shopping Cart</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(auth()->check() && $cartItems->count() > 0)
        <!-- ✅ Authenticated User Cart -->
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td><img src="{{ $item->product->picture_url }}" width="50"></td>
                        <td>{{ $item->product->name }}</td>
                        <td>${{ number_format($item->product->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->plant_product_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <a href="{{ route('orders.checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>

    @elseif(session('cart') && count(session('cart')) > 0)
        <!-- ✅ Guest User Cart -->
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>${{ $product['price'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <a href="{{ route('orders.checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>

    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
