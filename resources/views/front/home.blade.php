<!-- resources/views/front/home.blade.php -->
@extends('layouts.frontend')

@section('content')
<!-- ===== HERO SECTION ===== -->
<section id="hero" class="hero section light-background">
    <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between">
            <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Selamat Datang di <br><span class="text-accent">Deltizen Corner</span></h1>
                <p data-aos="fade-up" data-aos-delay="100">Nikmati hidangan lezat dan minuman segar dari kampus untuk kampus. Pesan sekarang, ambil nanti — tanpa antri!</p>
                <div class="d-flex gap-3" data-aos="fade-up" data-aos-delay="200">
                    <a href="/menu" class="btn-get-started">🍽️ Lihat Menu</a>
                    <a href="#tentang-kami" class="btn-get-started btn-outline-custom">Tentang Kami</a>
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                <img src="{{ asset('gambar9.jpg') }}" class="img-fluid animated" alt="Deltizen Corner — Makanan Lezat" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- ===== KEUNGGULAN SECTION ===== -->
<section id="keunggulan" class="section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Kenapa Deltizen Corner?</h2>
        <p><span>Keunggulan</span> <span class="description-title">layanan kami</span></p>
    </div>
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-clock-fill" style="font-size: 2.5rem; color: var(--accent-color);"></i>
                    </div>
                    <h3>Pesan Online</h3>
                    <p>Pesan makanan langsung dari HP tanpa perlu antri di kasir. Hemat waktu, praktis!</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-shield-check" style="font-size: 2.5rem; color: var(--accent-color);"></i>
                    </div>
                    <h3>Pembayaran Aman</h3>
                    <p>Transfer via QRIS atau bank dengan konfirmasi otomatis. Transaksi aman dan transparan.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card text-center p-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-star-fill" style="font-size: 2.5rem; color: var(--accent-color);"></i>
                    </div>
                    <h3>Menu Promo Harian</h3>
                    <p>Setiap hari ada promo spesial dengan harga mahasiswa. Cek promo terbaru di bawah!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== PROMO PRODUK SECTION ===== -->
<section id="menu" class="menu section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>Promo Spesial</h2>
        <p><span>Menu</span> <span class="description-title">promo terbaru kami</span></p>
    </div>
    <div class="container">
        <div class="row gy-5 justify-content-center">
            @forelse($products as $product)
                <div class="col-lg-3 col-md-6 menu-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                    <div class="product-card">
                        <a href="{{ route('product.detail_front', ['id' => $product->id]) }}">
                            <img src="{{ asset($product->image) }}" class="menu-img img-fluid" alt="{{ $product->name }}" loading="lazy">
                        </a>
                        <div class="product-card-body">
                            <h4>{{ $product->name }}</h4>
                            <p class="ingredients">{{ Str::limit($product->description, 60) }}</p>
                            <p class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                            <form action="{{ route('cart.store') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="btn-add-cart" type="submit">
                                    <i class="bi bi-cart-plus"></i> Tambah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-emoji-smile" style="font-size: 3rem; color: var(--accent-color);"></i>
                    <h4 class="mt-3">Belum ada promo saat ini</h4>
                    <p class="text-muted">Cek menu lengkap kami untuk pilihan lainnya.</p>
                    <a href="/menu" class="btn-get-started mt-2">Lihat Menu Lengkap</a>
                </div>
            @endforelse
        </div>

        @if($products->count())
        <!-- Pagination -->
        <div class="pagination mt-5 d-flex justify-content-center" data-aos="fade-up">
            {{ $products->links('vendor.pagination.bootstrap-4') }}
        </div>
        <!-- CTA: Lihat Semua Menu -->
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="/menu" class="btn-get-started">Lihat Semua Menu →</a>
        </div>
        @endif
    </div>
</section>

<!-- ===== TENTANG KAMI SECTION ===== -->
<section id="tentang-kami" class="about section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Tentang Kami</h2>
        <p><span>Cerita</span> <span class="description-title">Deltizen Corner</span></p>
    </div>
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-7 position-relative about-img" data-aos="fade-up" data-aos-delay="150">
                <div class="row gy-4">
                    <div class="col-6">
                        <img src="{{ asset('gambar1.jpg') }}" class="img-fluid rounded-4 shadow" alt="Suasana Deltizen Corner" loading="lazy">
                    </div>
                    <div class="col-6">
                        <div class="row gy-4">
                            <div class="col-12">
                                <img src="{{ asset('gambar2.jpg') }}" class="img-fluid rounded-4 shadow" alt="Menu Deltizen Corner" loading="lazy">
                            </div>
                            <div class="col-12">
                                <img src="{{ asset('gambar4.jpg') }}" class="img-fluid rounded-4 shadow" alt="Makanan Deltizen Corner" loading="lazy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="300">
                <div class="content ps-0 ps-lg-3">
                    <h3>Dari Kampus, Untuk Kampus</h3>
                    <p>
                        Deltizen Corner lahir dari kebutuhan mahasiswa Institut Teknologi Del (IT Del) 
                        akan tempat nongkrong yang nyaman dengan makanan berkualitas dan harga terjangkau.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle-fill"></i> <span>Berlokasi strategis di area kampus IT Del, Balige</span></li>
                        <li><i class="bi bi-check-circle-fill"></i> <span>Menu bervariasi dari makanan berat hingga cemilan</span></li>
                        <li><i class="bi bi-check-circle-fill"></i> <span>Sistem pre-order online untuk kemudahan mahasiswa</span></li>
                        <li><i class="bi bi-check-circle-fill"></i> <span>Harga bersahabat khusus untuk Deltizen</span></li>
                    </ul>
                    <p>
                        Kami berkomitmen menyajikan makanan segar, higienis, dan lezat setiap hari.
                        Pesan melalui website, bayar, dan ambil pesanan Anda di toko!
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="/menu" class="btn-get-started">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CARA PESAN SECTION ===== -->
<section id="cara-pesan" class="section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>Cara Pesan</h2>
        <p><span>Mudah dan</span> <span class="description-title">cepat</span></p>
    </div>
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="step-card text-center p-4">
                    <div class="step-number">1</div>
                    <i class="bi bi-search" style="font-size: 2rem; color: var(--accent-color);"></i>
                    <h4 class="mt-3">Pilih Menu</h4>
                    <p>Jelajahi menu makanan dan minuman kami, pilih yang kamu suka.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="step-card text-center p-4">
                    <div class="step-number">2</div>
                    <i class="bi bi-cart-plus" style="font-size: 2rem; color: var(--accent-color);"></i>
                    <h4 class="mt-3">Masuk Keranjang</h4>
                    <p>Tambahkan pesanan ke keranjang, atur jumlah sesuai kebutuhan.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="step-card text-center p-4">
                    <div class="step-number">3</div>
                    <i class="bi bi-credit-card" style="font-size: 2rem; color: var(--accent-color);"></i>
                    <h4 class="mt-3">Bayar</h4>
                    <p>Transfer via QRIS atau bank, lalu upload bukti pembayaran.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="step-card text-center p-4">
                    <div class="step-number">4</div>
                    <i class="bi bi-bag-check" style="font-size: 2rem; color: var(--accent-color);"></i>
                    <h4 class="mt-3">Ambil Pesanan</h4>
                    <p>Pesanan siap? Datang ke toko dan tunjukkan bukti pesanan.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection