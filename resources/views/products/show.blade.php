<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

{{-- @section('content') --}}
<div class="container">
    <h3>Product Details</h3>
    <div>
        <strong>Name:</strong> {{ $product->name }}
    </div>
    <div>
        <strong>Description:</strong> {{ $product->description }}
    </div>
    <div>
        <strong>Price:</strong> ${{ $product->price }}
    </div>
    <div>
        <strong>Image:</strong>
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width: 300px; height: auto;">
        @else
            <span>No Image</span>
        @endif
    </div>
</div>

{{-- @endsection --}}

</body>
</html>