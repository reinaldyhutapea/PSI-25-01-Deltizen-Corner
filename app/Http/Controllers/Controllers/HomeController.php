<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use FontLib\Table\Type\name;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            $products = Product::all();
            return view('front.home', compact('products'));

    }
    

    public function profil()
    {
            return view('admin.profil');
        
    }

    public function cari(Request $request)
    {
        //
        $cari = $request->cari;
        $products = DB::table('products')
        ->select('id','name','description','price','stock','image')
         ->where('name','like',"%".$cari."%")
         ->get();
        return view('front.home',['products' => $products]);
        
    }
    public function makanan()
    {
        //

        $products = DB::table('products')
        ->select('*')
         ->where('category_id','=','1')
         ->get();
        return view('front.home',['products' => $products]);
    }
    public function minuman()
    {
        //

        $products = DB::table('products')
        ->select('*')
         ->where('category_id','=','2')
         ->get();
        return view('front.home',['products' => $products]);
    }
    public function detail_front($id)
    {
     
        $product = Product::findOrFail($id);
        return view('front.detail_product',compact('product'));
    }

    public function tentang()
    {
        return view('front.tentang');
    }
    public function kontak()
    {
        return view('front.kontak');
    }




}
