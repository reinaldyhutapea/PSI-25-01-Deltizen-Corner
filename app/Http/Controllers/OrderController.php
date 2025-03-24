<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Order_Product;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class OrderController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $orders = Order::orderBy('id','desc')->get();
        return view('order.index', compact('orders'));
    }
    public function detail($id){
        $details = Order_Product::where('order_id',$id)->get();
        $identity = Order_Product::where('order_id',$id)->first();
        $id = DB::table('order_product')
        ->select('order_id')->get();
        return view('order.detail', compact('details', 'identity','id'));
    }
    public function cetak(){
        return view('order.cetak_laporan');
    }
    public function cetak_pertanggal($tglawal, $tglakhir){
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
    public function produkData (Request $request){
        if (request()->ajax()){
            if(!empty($request->from_date)){
                $data = DB::table('orders')
                ->whereBetween('date',array($request->from_date, $request->to_date))
                ->get();
            }else{
                $data = DB::table('orders')
                ->get();
            }
            return Datatables::of($data)
            ->addColumn('action', function ($data) {
                        $detail = '<a href="'.route('order.detail',$data->id).
                        '" id="btn0" class="btn btn-xs btn-secondary"><i class="fa-solid fa-circle-info"></i></a>';
                        return $detail;
                    })
                    ->addIndexColumn()
                    ->editColumn('status', function($data){
                        if($data->status=='belum bayar'){
                        $btn1='<button type="button" id="btn1" class="btn btn-maroon"><i class="bx bx-no-entry">
                             </i><span class="tooltiptext">Belum Bayar</span></button>';
                        $btn2='<button type="button" id="btn2" class="btn btn-maroon">'.$data->status.'</button>';
                        return $btn1.$btn2;
                        }elseif($data->status=='menunggu verifikasi'){
                            $btn1='<button type="button" id="btn1" class="btn btn-warning"><i class="bx bx-time-five">
                                  </i><span class="tooltiptext">Menunggu Verifikasi</span></button>';
                            $btn2='<button type="button" id="btn2" class="btn btn-warning">'.$data->status.'</button>';
                            return $btn1.$btn2;
                        }elseif($data->status=='dibayar'){
                            $btn1='<button type="button" id="btn1" class="btn btn-success"><i class="bx bx-check-circle">
                                   </i><span class="tooltiptext">Dibayar</span></button>';
                            $btn2='<button type="button" id="btn2" class="btn btn-success">'.$data->status.'</button>';
                            return $btn1.$btn2;
                        }else{
                            $btn1='<button type="button" id="btn1" class="btn btn-danger"><i class="bx bx-x-circle" >
                                  </i><span class="tooltiptext">Ditolak</span></button>';
                            $btn2='<button type="button" id="btn2" class="btn btn-danger">'.$data->status.'</button>';
                            return $btn1.$btn2;
                        }
                    })
                    ->editColumn('total_price', function($data){
                        return 'Rp. '.number_format($data->total_price,0).' ';
                    })
                    ->rawColumns(['status','action','total_price','number']) ->make(true);
        }
    }
}
