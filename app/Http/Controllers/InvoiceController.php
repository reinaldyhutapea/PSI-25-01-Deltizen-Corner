<?php
namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class InvoiceController extends Controller{

    public function index() {
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
              $details = DB::table('order_product')
        ->join('orders','order_product.order_id','=','orders.id')
        ->join('products','order_product.product_id','=','products.id')
        ->select('order_product.*','orders.*','products.*')
        ->where('order_id',$id)
        ->get();
        return view('customer.invoice_detail',compact('details'));
}
}