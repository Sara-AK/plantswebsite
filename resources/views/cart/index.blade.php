@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🛒 Your Shopping Cart</h2>

    @if(auth()->check() ? $cartItems->isNotEmpty() : (session('cart') && count(session('cart')) > 0))
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(auth()->check())
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
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
                @endif
            </tbody>
        </table>

        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning">Clear Cart</button>
        </form>

    @else
        <p>Your cart is empty. <a href="{{ route('public.products.index') }}">Browse products</a>.</p>
    @endif
</div>
@endsection
