@extends('layouts.app')

@section('title', 'Order Success')

@section('content')
<div class="container text-center">
    <h2>🎉 Order Placed Successfully!</h2>
    <p>Thank you for your purchase. Your order is being processed.</p>
    <a href="{{ route('public.products.index') }}" class="btn btn-primary">Continue Shopping</a>
</div>
@endsection
