<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Order_Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    //
    public function index()    {
        $order_product = DB::table('order_product')
        ->join('orders','order_product.order_id','=','orders.id')
        ->select('order_product.*','orders.*')
        ->get();
       
        return view('customer.invoice',['order_product' => $order_product]);
      
    }
 
    public function list(){
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id',$user_id)
            ->orderBy('status','asc')
            ->get();
        return view('customer.list_invoice', compact('orders'));
    }

    public function detail($id){
        $details = Order_Product::where('order_id',$id)->get();
        return view('customer.invoice_detail',compact('details'));
}
}