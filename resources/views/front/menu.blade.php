@extends('layouts.frontend')

@section('content')
<section id="menu" class="menu section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Menu</h2>
        <p><span>Berikut adalah daftar</span> <span class="description-title">menu yang kami tawarkan</span></p>
    </div>
    <div class="container">
        <!-- Category Tabs -->
        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('menu') ? 'active show' : '' }}" href="/menu">
                    <h4>Semua</h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('menu/promo') ? 'active show' : '' }}" href="/menu/promo">
                    <h4>🔥 Promo</h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('menu/minuman') ? 'active show' : '' }}" href="/menu/minuman">
                    <h4>🥤 Minuman</h4>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('menu/makanan') ? 'active show' : '' }}" href="/menu/makanan">
                    <h4>🍚 Makanan</h4>
                </a>
            </li>
        </ul>

        <!-- Search Bar -->
        <div class="search-bar mt-4" data-aos="fade-up" data-aos-delay="150">
            <form action="{{ url('/menu/cari') }}" method="GET" class="d-flex">
                <input type="text" name="cari" class="form-control" placeholder="Cari menu favorit kamu..." value="{{ request('cari') }}">
                <button type="submit" class="btn"><i class="bi bi-search"></i></button>
            </form>
        </div>

        @if(isset($message) && $message)
            <div class="text-center py-4" data-aos="fade-up">
                <i class="bi bi-emoji-frown" style="font-size: 3rem; color: #6c757d;"></i>
                <p class="mt-2 text-muted">{{ $message }}</p>
            </div>
        @endif

        <!-- Product Grid -->
        <div class="row gy-5 mt-3 justify-content-center">
            @forelse ($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 + 100 }}">
                    <div class="product-card">
                        <a href="{{ route('product.detail_front', ['id' => $product->id]) }}">
                            <img src="{{ url($product->image) }}" class="menu-img img-fluid" alt="{{ $product->name }}" loading="lazy">
                        </a>
                        <div class="product-card-body">
                            <h4>{{ $product->name }}</h4>
                            <p class="ingredients">{{ Str::limit($product->description, 80) }}</p>
                            <p class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="btn-add-cart" type="submit">
                                    <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-cup-straw" style="font-size: 3rem; color: #6c757d;"></i>
                    <h4 class="mt-3">Menu tidak ditemukan</h4>
                    <p class="text-muted">Coba kata kunci lain atau lihat semua menu.</p>
                    <a href="/menu" class="btn-get-started mt-2">Lihat Semua Menu</a>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection