@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Bagian Promo --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header bg-success text-white">
                    Promo Minuman
                </div>
                <div class="card-body">
                    <p>Dapatkan minuman gratis dan diskon menarik.</p>
                    <a href="{{ route('promo.minuman') }}" class="btn btn-success">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header bg-warning text-dark">
                    Promo Makanan
                </div>
                <div class="card-body">
                    <p>Diskon 20% untuk semua makanan favorit.</p>
                    <a href="{{ route('promo.makanan') }}" class="btn btn-warning text-white">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-header bg-info text-white">
                    Promo Paket
                </div>
                <div class="card-body">
                    <p>Paket hemat makan siang cuma Rp 25.000!</p>
                    <a href="{{ route('promo.paket') }}" class="btn btn-info text-white">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Bagian Menu Makanan --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Menu Makanan') }}</div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($menu as $item)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama }}">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $item->nama }}</h5>
                                        <p class="card-text">{{ $item->deskripsi }}</p>
                                        <p class="card-text"><strong>Rp {{ number_format($item->harga, 0, ',', '.') }}</strong></p>
                                        <a href="{{ route('tambah.keranjang', $item->id) }}" class="btn btn-primary mt-auto">Tambah ke Keranjang</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($menu->isEmpty())
                        <p class="text-center">Belum ada menu tersedia saat ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection