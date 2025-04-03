<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
class HomeController extends Controller{
    public function welcome(){
          return view('front.home');

    }
    public function all(){
          $products = DB::table('products')
         ->select('id','name','description','price','stoks','image')
        ->orderBy('category_id','ASC')
         ->get();
          return view('front.menu', ['products' => $products]);
    }
    public function cari(Request $request){
        $cari = $request->cari;
        $products = DB::table('products')
        ->select('id','name','description','price','stock','image')
         ->where('name','like',"%".$cari."%")
         ->get();
        return view('front.menu',['products' => $products]);
    }
    public function makanan(){
        $products = DB::table('products')
        ->select('*')
         ->where('category_id','=','1')
         ->get();
        return view('front.menu',['products' => $products]);
    }
    public function minuman(){
        $products = DB::table('products')
        ->select('*')
         ->where('category_id','=','2')
         ->get();
        return view('front.menu',['products' => $products]);
    }

    public function detail_front($id){
        $product = Product::findOrFail($id);
        return view('front.detail_product',compact('product'));
    }
    public function pembayaran(){
        return view('front.pembayaran');
    }
}