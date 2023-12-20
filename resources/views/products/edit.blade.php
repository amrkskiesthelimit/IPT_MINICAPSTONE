@extends('base')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" required>{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category" id="category" class="form-control" required>
                <option value="shoes" {{ $product->category === 'shoes' ? 'selected' : '' }}>Shoes</option>
                <option value="apparel" {{ $product->category === 'apparel' ? 'selected' : '' }}>Apparel</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
