<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function minuman()
    {
        return view('promo.minuman');
    }

    public function makanan()
    {
        return view('promo.makanan');
    }

    public function paket()
    {
        return view('promo.paket');
    }
}
