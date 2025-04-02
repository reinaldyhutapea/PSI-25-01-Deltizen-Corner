@extends('layouts.frontend')

<head>
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('/js/home.js') }}" rel="stylesheet">
    {{-- icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

@section('content')

<div class="container">
    <div class="row text-center">

        <div class="col-md-12 py-5"></div>
        <div class="kategoris">
            <a href="/menu/makanan"><i class='bx bx-bowl-hot'></i> Makanan</a> |
            <a href="/menu/minuman"><i class='bx bxs-drink'></i> Minuman</a>
        </div>

        <div class="view_wrap grid-view mt-4">
            @foreach ($products as $product)
            <div class="view_item d-flex flex-column align-items-center">
                <div class="vi_left">
                    <img class="img1" src="{{ url($product->image) }}" style="width: 208px;" alt="gambar-menu">
                </div>
                <div class="vi_right text-center">
                    <div class="name">
                        <a href="{{ route('product.detail_front', ['id' => $product->id]) }}" style="font-size: 16px;">{{ $product->name }}</a>
                    </div>
                    <span class="price">Rp.{{ number_format($product->price, 0) }}</span>
                    <br>
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <input type="hidden" value="{{ $product->name }}" name="name">
                        <input type="hidden" value="{{ $product->price }}" name="price">
                        <input type="hidden" value="{{ $product->image }}" name="image">
                        <input type="hidden" value="1" name="quantity">
                        <button class="btn btn-primary mt-2">Tambah <i class="fa fa-shopping-cart ml-2" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Script Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

@endsection