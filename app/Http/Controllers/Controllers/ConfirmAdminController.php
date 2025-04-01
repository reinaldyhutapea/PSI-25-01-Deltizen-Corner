<?php

namespace App\Http\Controllers;
use App\Models\Confirm;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\product;
// use Session;


class ConfirmAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        $title = 'List Konfirmasi Pembayaran Customer';
        $confirms = Confirm::where('status_order','menunggu verifikasi')->orderBy('id','desc')->get();
        return view('confirm.index', compact('confirms', 'title'));
    }

    public function terima($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $order->status = 'dibayar';
        $order->save();

        $confirm = Confirm::where('order_id',$order_id)->first();
        $confirm->status_order = 'dibayar';
        $confirm->save();
     
        $order_product = Order_Product::findOrFail($order_id);
        $product = Product::findOrFail($order_product->product_id);
        // echo "result qty ".$order_product->quantity." - ".$product->stock." = ".
        $product->stock -= $order_product->quantity;
        // $product->update(['stock' => $product->stock -= $order_product->quantity]);
        $product->save(); 

        // Session::flash('status','Berhasil di konfirmasi dengan status di terima');
        return redirect()->route('confirmAdmin');
        
    }

    public function tolak($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $order->status = 'ditolak';
        $order->save();

        $confirm = Confirm::where('order_id',$order_id)->first();
        $confirm->status_order = 'ditolak';
        $confirm->save();

        Session::flash('status','Berhasil di konfirmasi dengan status di tolak');
        return redirect()->route('confirmAdmin');
    }

    public function detail($id)
    {
        $details = Order_Product::where('order_id',$id)->get();
        $identity = Order_Product::where('order_id',$id)->first();
        return view('confirm.detail', compact('details', 'identity'));
    }
}
