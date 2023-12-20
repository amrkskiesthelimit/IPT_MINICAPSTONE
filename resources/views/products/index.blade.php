@extends('base')

@section('content')
<div class="container">
    <h1>Shoes And Apparel</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @role('admin')
       <a href="{{ route('products.create') }}" class="btn btn-success">Create Product</a>
    @endrole
    <!-- Shoes Section -->
    <section>
        <h2>Shoes</h2>
        <div class="row">
            @forelse($shoes as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('no-image.png') }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">$ {{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Show</a>
                            @role('user')
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Add to Cart</button>
                            </form>
                            @endrole
                            @role('admin')
                              <form action="{{ route('products.edit', $product) }}" method="GET" class="d-inline">
                                  <button type="submit" class="btn btn-warning">Edit</button>
                              </form>

                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @endrole
                            @role('user')
                            <a href="{{ route('products.buy', ['product' => $product]) }}" class="btn btn-warning">Buy Now</a>
                            @endrole
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p class="no-products">No shoes found.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Apparel Section -->
    <section>
        <h2>Apparel</h2>
        <div class="row">
            @forelse($apparel as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('no-image.png') }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">$ {{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Show</a>
                            @role('user')
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Add to Cart</button>
                            </form>
                            @endrole
                            @role('admin')
                            <form action="{{ route('products.edit', $product) }}" method="GET" class="d-inline">
                                <button type="submit" class="btn btn-warning">Edit</button>
                            </form>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @endrole
                            @role('user')
                            <a href="{{ route('products.buy', ['product' => $product]) }}"  class="btn btn-warning">Buy Now</a>
                            @endrole
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p class="no-products">No apparel found.</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection
