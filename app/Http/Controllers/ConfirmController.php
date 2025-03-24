<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Confirm;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
class ConfirmController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index($id){
        $order = Order::findOrFail($id);
        return view('customer.confirm', compact('order'));
    }
    public function store(Request $request){
        $user_id = Auth::user()->id;
        $order_id = $request->order_id;
            $confirm = new Confirm;
            $file = $request->file('image');
            $ext = $file->getClientOriginalName();
            $newName = rand(100000,1001238912).".".$ext;
            $file->move('upload/confirm', $newName);

            $confirm->user_id       = $user_id;
            $confirm->order_id      = $order_id;
            $confirm->image         = $newName;
            $confirm->status_order  = 'menunggu verifikasi';
            $date_now = Carbon::now('Asia/Jakarta');
            if($date_now->hour < 16) {
                $confirm->status_order = 'menunggu verifikasi';
            
            } else {
                $confirm->status_order = 'ditolak';
            
            }
                $confirm->save();
        $order = Order::where('id',$order_id)->first();
        $order->status = 'menunggu verifikasi';
        $date_now = Carbon::now('Asia/Jakarta');
        if($date_now->hour < 16) {
            $order->status = 'menunggu verifikasi';
            $msg = 'Pembayaran berhasil, admin akan verifikasi pesananmu !';
            $order->save();
            return redirect('/invoice/list')->with('success',$msg);
        } else {
            $order->status = 'ditolak';
            $msg1= 'Pembayaran gagal, batas waktu konfirmasi pembayaran telah terlewati !';  
            $order->save();
            return redirect('/invoice/list')->with('warning',$msg1);
        }
        $order->save();
    }
}
