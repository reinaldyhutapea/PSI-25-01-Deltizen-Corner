<?php
namespace App\Http\Controllers;
use App\Models\Confirm;
use App\Models\Order;
use App\Models\Order_Product;
use Illuminate\Http\Request;
use Session;
class ConfirmAdminController extends Controller{
      public function __construct(){
        $this->middleware('auth');}
      public function index(){
        $title = 'List Konfirmasi Pembayaran Customer';
        $confirms = Confirm::where('status_order','menunggu verifikasi')
                         ->orderBy('id','desc')->get();
        return view('confirm.index', compact('confirms', 'title'));
    }
    public function terima($order_id){
        $order = Order::where('id', $order_id)->first();
        $order->status = 'dibayar';
        $order->save();
        $confirm = Confirm::where('order_id',$order_id)->first();
        $confirm->status_order = 'dibayar';
        $confirm->save();
        Session::flash('status','Berhasil di konfirmasi dengan status di terima');
        return redirect()->route('confirmAdmin');
    }
    public function tolak(Request $request,$order_id){
        $order = Order::where('id', $order_id)->first();
        $order->status = 'ditolak';
        $order->detail_status = $request->input('detail_status');
        $order->save();
        $confirm = Confirm::where('order_id',$order_id)->first();
        $confirm->status_order = 'ditolak';
        $confirm->save();
        Session::flash('status','Berhasil di konfirmasi dengan status di tolak');
        return redirect()->route('confirmAdmin');
    }
    public function detail($id){
        $details = Order_Product::where('order_id',$id)->get();
        $identity = Order_Product::where('order_id',$id)->first();
        return view('confirm.detail', compact('details', 'identity'));
    }
}
