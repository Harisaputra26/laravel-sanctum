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
    <h3>Detail produk</h3>

    <div class="mb-3">
        <strong>Nama:</strong> {{ $product->name }}
    </div>
    <div class="mb-3">
        <strong>Deskripsi:</strong> {{ $product->description }}
    </div>
    <div class="mb-3">
        <strong>Harga:</strong> ${{ $product->price }}
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">balik Produk List</a>
</div>
{{-- @endsection --}}

</body>
</html>