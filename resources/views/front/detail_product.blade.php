@extends('layouts.frontend')

@section('content')
<section id="details" class="about section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Detail Produk</h2>
        <p><span>Info lengkap</span> <span class="description-title">{{ $product->name }}</span></p>
    </div>
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="product-card" style="overflow: hidden;">
                    <img src="{{ url($product->image) }}" class="img-fluid w-100" alt="{{ $product->name }}" style="max-height: 400px; object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                <div class="content ps-0 ps-lg-4">
                    <h3 style="font-family: var(--default-font); font-weight: 700;">{{ $product->name }}</h3>
                    <p class="price" style="font-size: 1.5rem; font-weight: 700; color: var(--accent-color); margin: 0.5rem 0 1.5rem;">
                        Rp. {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="mb-4">
                        <h5 style="font-family: var(--default-font); font-weight: 600;">Deskripsi</h5>
                        <p>{{ $product->description }}</p>
                    </div>

                    <ul class="mb-4">
                        <li><i class="bi bi-tag-fill"></i> <span>Kategori: <strong>{{ $product->category->name }}</strong></span></li>
                        <li><i class="bi bi-box-seam"></i> <span>Ketersediaan: <strong>{{ $product->stoks ? 'Tersedia' : 'Habis' }}</strong></span></li>
                    </ul>

                    @if($product->stoks)
                    <form action="{{ route('cart.store') }}" method="POST" class="d-flex gap-3 align-items-end mt-4">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div>
                            <label for="quantity" style="font-size: 0.85rem; font-weight: 600; color: #6c757d;">Jumlah</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="100" value="1" class="form-control" style="width: 80px; border-radius: 10px;">
                        </div>
                        <button class="btn-add-cart" type="submit" style="width: auto; padding: 12px 32px;">
                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </form>
                    @else
                    <div class="alert alert-warning mt-4">
                        <i class="bi bi-exclamation-triangle"></i> Produk ini sedang tidak tersedia.
                    </div>
                    @endif

                    <a href="/menu" class="btn-outline-custom mt-4 d-inline-block" style="padding: 10px 24px; border-radius: 50px; text-decoration: none;">
                        <i class="bi bi-arrow-left"></i> Kembali ke Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection