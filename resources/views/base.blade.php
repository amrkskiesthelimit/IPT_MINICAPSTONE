<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}"> <!-- Link to custom CSS stylesheet -->
    <title>Demo</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <div class="container d-flex justify-content-between"> <!-- Align content with flex to the right -->
            <a class="navbar-brand" href="{{ route('products.index') }}">
                @if(auth()->check()) {{ auth()->user()->name }} @else Demo @endif
            </a>
            <ul class="navbar-nav"> <!-- Navigation links aligned to the right -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">JmKickz</a>
                </li>
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product-logs') }}">Logs</a>
                </li>
                @endrole

                @role('user')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.show') }}">Add to Carts</a>
                </li>
                @endrole

                @if(auth()->check())
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">Logout</button>
                    </form>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ ('/') }}">Login</a>
                </li>
                @endif
                <!-- Add more navigation links as needed -->
            </ul>
        </div>
    </nav>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-ZuRj2SNF9wO5KCx4/LbTP0KwlGcsmJp+5D0P5B7utW9jT8t5n5PVCOb7z5O5OZ5q6W" crossorigin="anonymous"></script>
</body>
</html>
