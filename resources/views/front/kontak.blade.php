@extends('layouts.frontend')
<script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
<style>

    .container-fluid{
        margin-top:100px;
    }
    .card{
        width: 100%;
      
    }
    @media screen and (max-width: 600px) {
    span.logo.navLogo{
        display: none;
    }

    .searchBox{
        display: none;
    }

    }
</style>
@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <h1>Kontak WR Barokah</h1>
    </div>
    <div class="card-body">
        <p>Untuk informasi lebih lanjut bisa datang atau hubungi kontak berikut :</p>
        <p><i class='bx bx-location-plus'></i>Jalan Bakulan-Imogiri, Jetis, Bantul, Yogyakarta</p>
        <p class="telepon" style="font-size: 20px;"><i class='bx bxs-phone'></i>
        08984730679</p>
        <p class="whatsapp" style="font-size: 20px;"><i class='bx bxl-whatsapp' ></i>
        08984730679</p>
        <p class="instagram" style="font-size: 20px;"><i class='bx bxl-instagram-alt' ></i>
        Coming Soon</p>
        <p class="facebook" style="font-size: 20px;"><i class='bx bxl-facebook-circle'></i>
        Coming Soon</p>
        <p class="twitter" style="font-size: 20px;"><i class='bx bxl-twitter'></i>
        Coming Soon</p>
    </div>
</div>
</div>