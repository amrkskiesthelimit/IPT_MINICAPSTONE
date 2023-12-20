@extends('base')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Product Details</h1>

    <div class="card mb-4">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('no-image.png') }}" class="card-img" alt="{{ $product->name }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title">{{ $product->name }}</h2>
                    <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p class="card-text"><strong>Category:</strong> {{ ucfirst($product->category) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
