@extends('layouts.frontend')

<head>
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: url('{{ asset('gambar5.jpg') }}') no-repeat center center/cover;
            color: white;
        }

        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 100px 20px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            margin: 50px auto;
            max-width: 90%;
        }

        .hero h1 {
            font-size: 3em;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .btn-custom {
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 1.2em;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-custom:hover {
            transform: scale(1.05);
        }

        .section {
            text-align: center;
            padding: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            margin: 30px auto;
            max-width: 90%;
        }

        .section h2 {
            color: #000000;
            font-size: 2.5em;
            margin-bottom: 15px;
        }

        .section p {
            color: #ddd;
            font-size: 1.1em;
        }
    </style>
</head>

@section('content')
    <div class="hero">
        <h1>Selamat Datang di Deltizen Corner</h1>
        <p>Nikmati suasana nyaman dengan berbagai hidangan lezat dan minuman segar. Tempat sempurna untuk bersantai dan berkumpul bersama teman.</p>
    </div>

    <div class="hero">
        <h1>Makanan Lezat</h1>
        <p>Sajian nikmat dari menu lokal hingga inovatif, siap memanjakan lidahmu.</p>
        <div>
            <a href="menu/makanan" class="btn btn-success btn-custom">Explore Makanan</a>
        </div>
    </div>

    <div class="hero">
        <h1>Minuman Segar </h1>
        <p>Kopi, teh, dan minuman segar lainnya untuk menemani hari-harimu.</p>
        <div>
            <a href="menu/minuman" class="btn btn-success btn-custom">Explore Minuman</a>
        </div>
    </div>

    <div class="section">
        <h2 class="text-dark"><strong>Promo Spesial</strong></h2>
        <div class="row">
            <!-- Promo Minuman -->
            <div class="col-md-4">
                <div class="card" style="background-color: #1A4733; color: white; border-radius: 200px;">
                    <img class="card-img-top rounded-pill" src="{{ asset('gambar6.jpg') }}" alt="Promo Minuman">
                    <div class="card-body text-center">
                        <h5 class="card-title">Beli 1 Gratis 1 Minuman</h5>
                        <p class="card-text">Segarkan hari Anda dengan promo menarik ini.</p>
                        <a href="{{ route('promo.minuman') }}" class="btn btn-success btn-custom">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Promo Makanan -->
            <div class="col-md-4">
                <div class="card" style="background-color: #1A4733; color: white; border-radius: 200px;">
                    <img class="card-img-top rounded-pill" src="{{ asset('gamabar7.jpg') }}" alt="Promo Makanan">
                    <div class="card-body text-center">
                        <h5 class="card-title">Diskon 20% untuk Semua Makanan</h5>
                        <p class="card-text">Nikmati hidangan favorit Anda dengan harga spesial.</p>
                        <a href="{{ route('promo.makanan') }}" class="btn btn-success btn-custom">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <!-- Promo Paket Hemat -->
            <div class="col-md-4">
                <div class="card" style="background-color: #1A4733; color: white; border-radius: 200px;">
                    <img class="card-img-top rounded-pill" src="{{ asset('gambar8.jpg') }}" alt="Promo Paket">
                    <div class="card-body text-center">
                        <h5 class="card-title">Paket Hemat Makan Siang</h5>
                        <p class="card-text">Dapatkan paket lengkap dengan harga terjangkau.</p>
                        <a href="{{ route('promo.paket') }}" class="btn btn-success btn-custom">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var li_links = document.querySelectorAll(".links ul li");
        var view_wraps = document.querySelectorAll(".view_wrap");
        var list_view = document.querySelector(".list-view");
        var grid_view = document.querySelector(".grid-view");

        li_links.forEach(function(link) {
            link.addEventListener("click", function() {
                li_links.forEach(function(link) {
                    link.classList.remove("active");
                });

                link.classList.add("active");

                var li_view = link.getAttribute("data-view");

                view_wraps.forEach(function(view) {
                    view.style.display = "none";
                });

                if (li_view == "list-view") {
                    list_view.style.display = "block";
                } else {
                    grid_view.style.display = "block";
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
@endsection
