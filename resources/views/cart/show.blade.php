@extends('base')

@section('content')
<div class="container">
    <h1>Your Cart</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Shoes Section -->
    <section>
        <h2>Shoes</h2>
        @if ($shoesCartItems !== null && count($shoesCartItems) > 0)
            <form method="post" action="{{ route('cart.buyAll', ['category' => 'shoes']) }}">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shoesCartItems as $cartItem)
                            <tr>
                                <td>{{ $cartItem->product->name }}</td>
                                <td>{{ $cartItem->quantity }}</td>
                                <td>${{ number_format($cartItem->product->price, 2) }}</td>
                                <td>${{ number_format($cartItem->quantity * $cartItem->product->price, 2) }}</td>
                                <td>
                                    <form method="post" action="{{ route('cart.remove', ['id' => $cartItem->id]) }}">
                                        @csrf
                                        @method('DELETE') <!-- Specify the DELETE method -->
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">Buy All Shoes</button>
            </form>
        @else
            <p>Your cart for shoes is empty.</p>
        @endif
    </section>

    <!-- Apparel Section -->
    <section>
        <h2>Apparel</h2>
        @if ($apparelCartItems !== null && count($apparelCartItems) > 0)
            <form method="post" action="{{ route('cart.buyAll', ['category' => 'apparel']) }}">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apparelCartItems as $cartItem)
                            <tr>
                                <td>{{ $cartItem->product->name }}</td>
                                <td>{{ $cartItem->quantity }}</td>
                                <td>${{ number_format($cartItem->product->price, 2) }}</td>
                                <td>${{ number_format($cartItem->quantity * $cartItem->product->price, 2) }}</td>
                                <td>
                                    <form method="post" action="{{ route('cart.remove', ['id' => $cartItem->id]) }}">
                                        @csrf
                                        @method('DELETE') <!-- Specify the DELETE method -->
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">Buy All Apparel</button>
            </form>
        @else
            <p>Your cart for apparel is empty.</p>
        @endif
    </section>
</div>
@endsection
