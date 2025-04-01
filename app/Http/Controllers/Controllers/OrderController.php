<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Product;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::orderBy('id','desc')->get();
        return view('order.index', compact('orders'));
    }

    public function detail($id)
    {
        $details = Order_Product::where('order_id',$id)->get();
        $identity = Order_Product::where('order_id',$id)->first();
        $id = DB::table('order_product')
        ->select('order_id')->get();
        return view('order.detail', compact('details', 'identity','id'));
    }

    public function cetak()
    {
        return view('order.cetak_laporan');
    }

    public function cetak_pertanggal($tglawal, $tglakhir)
    {
        $Tglawal = $tglawal;
        $Tglakhir = $tglakhir;

        $orders = Order::whereBetween('date',[$tglawal,$tglakhir])
        ->where('status','=','dibayar')
        ->get();
        $sum = Order::whereBetween('date',[$tglawal,$tglakhir])
        ->where('status','=','dibayar')
        ->sum('total_price');
       
       return view('order.laporan_tercetak', compact('orders','Tglawal','Tglakhir','sum'));
    }

    public function produkData (){
        $data = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.id','orders.receiver','orders.address', 'orders.total_price','orders.date','orders.status');
        return Datatables::of($data)
        ->addColumn('action', function ($data) {
            $detail = '<a href="'.route('order.detail',$data->id).'" class="btn btn-xs btn-warning"><i class="fa-solid fa-circle-info"></i></a>';
            return $detail;
        })
        ->addIndexColumn()
        ->editColumn('status', function($data){
            
            if($data->status=='belum bayar'){
            // return '<img src=" '.url($data->status).' "/>';
                return '<button type="button" class="btn bg-maroon">'.$data->status.'</button>';
            }elseif($data->status=='menunggu verifikasi'){
                return '<button type="button" class="btn bg-orange">'.$data->status.'</button>';
            }elseif($data->status=='dibayar'){
                return '<button type="button" class="btn btn-success">'.$data->status.'</button>';
            }else{
                return '<button type="button" class="btn bg-danger">'.$data->status.'</button>';   
            
            }
        })
        ->editColumn('total_price', function($data){
            return 'Rp. '.number_format($data->total_price,0).' ';
        })
        ->rawColumns(['status','action','total_price','number'])
        ->make(true);
        }
        
        
}
