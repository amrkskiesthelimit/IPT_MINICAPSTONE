@extends('base')

@section('content')
<div class="container">
    <h1>Create Product</h1>
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category" id="category" class="form-control" required>
                <option value="shoes">Shoes</option>
                <option value="apparel">Apparel</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
