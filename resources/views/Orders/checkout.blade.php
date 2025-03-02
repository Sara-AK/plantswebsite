@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container">
    <h2>🛍 Checkout</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: ${{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }}</h3>

    <form action="{{ route('orders.place') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">✅ Place Order</button>
    </form>
</div>
@endsection
