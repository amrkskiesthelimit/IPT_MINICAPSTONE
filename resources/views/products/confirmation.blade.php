@extends('base')

@section('content')
<div class="container">
    <h1>Order Confirmation</h1>
    <p>Thank you for your purchase!</p>

    <!-- Display order details -->
    <h2>Order Details</h2>
    <p>Order ID: {{ $order->id }}</p>
    <p>Product: {{ $order->product->name }}</p>
    <p>Quantity: {{ $order->quantity }}</p>
    <p>Total Price: ${{ number_format($order->total_price, 2) }}</p>

    <form method="post" action="{{ route('purchase.confirm', ['product' => $product]) }}">
        @csrf
        <button type="submit" class="btn btn-success">Confirm Purchase</button>
    </form>

    <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Home</a>
</div>
@endsection
