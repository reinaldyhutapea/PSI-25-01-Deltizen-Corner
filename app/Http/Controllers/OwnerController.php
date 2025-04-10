<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Order_Product;
use App\Models\Product;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class OwnerController extends Controller{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profil()
    {
        return view('owner.profil');
    }   

    public function store(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->route('owner.profil')
        ->with('success','Password berhasil diubah');
    }

    public function index0(){
        $products = Product::all();
        $orders = Order::all();
        $orders2 = Order::orderBy('date','DESC')
                    ->limit(5)
                    ->get();
        $users1 = User::where('role','=','customer');
        $users2 = User::where('role','=','admin');
        $terlaris = Order_Product::join('products','order_product.product_id','=','products.id')
        ->select('products.name',DB::raw('count(order_product.quantity) as total'))
        ->groupBy('products.name')
        ->orderBy('total','DESC')
        ->take(5)
        ->get();

        $pemesan = Order_Product::join('orders','order_product.order_id','=','orders.id')
        ->select('orders.receiver',DB::raw('count(order_product.quantity) as total'),
        DB::raw('SUM(order_product.subtotal) as subtotal'))
        ->groupBy('orders.receiver')
        ->orderBy('total','DESC')
        ->take(5)
        ->get();

        $visitor = Order::select(
            DB::raw("DATE_FORMAT(date, '%M') as month"), 
            DB::raw('SUM(total_price) as total')
        )
        ->groupBy(DB::raw("DATE_FORMAT(date, '%M')"))
        ->orderBy(DB::raw("MIN(date)"))
        ->get();
    

        $data = [];
        foreach($visitor as $row) {
            $data['label'][] = $row->month;
            $data['data'][] = (int) $row->total;
        }
        $data['chart_data'] = json_encode($data);
        return view('owner.index',$data,
        compact('products','orders','users1','users2','terlaris','orders2','pemesan'));
    }

    public function index(){
        $orders = Order_Product::join('orders','order_product.order_id','=','orders.id')
                ->join ('products','order_product.product_id','=','products.id')
                ->select('order_product.id','products.name','products.price','order_product.quantity',
                'order_product.subtotal','orders.date','orders.status','orders.created_at')
                ->get();
        return view('owner.laporan_penjualan', compact('orders'));
    }

    public function index2(){
        $orders = Order::orderBy('id','desc')->get();
        return view('owner.laporan_pesanan', compact('orders'));
    }

    public function index3(){
        $products = Product::orderBy('name','asc')->get();
        $categories = Category::orderBy('name','asc')->get();
        return view('owner.data_produk', compact('products','categories'));
    }

    public function index4(){
        $user = User::where('role','=','customer')
        ->orderBy('name','asc')
        ->get();
        return view('owner.data_pelanggan', compact('user'));
    }

    public function index5(){
        $user = User::where('role','=','admin')
        ->orderBy('name','asc')
        ->get();
        return view('owner.data_admin', compact('user'));
    }

    public function penjualanLaporan (Request $request){
        if (request()->ajax()){
            if(!empty($request->from_date)){
                $data = Order_Product::join('orders','order_product.order_id','=','orders.id')
                ->join ('products','order_product.product_id','=','products.id')
                ->select('order_product.id','products.name','products.price','order_product.quantity',
                'order_product.subtotal','orders.date','orders.status','orders.created_at')
                ->whereBetween('orders.date',array($request->from_date, $request->to_date))
                ->get();
            }else{
                $data = Order_Product::join('orders','order_product.order_id','=','orders.id')
                ->join ('products','order_product.product_id','=','products.id')
                ->select('order_product.id','products.name','products.price','order_product.quantity',
                'order_product.subtotal','orders.date','orders.status','orders.created_at')
               ->get();
            }
            return Datatables::of($data)
            ->editColumn('price', function($data){
                return 'Rp. '.number_format($data->price,0).' ';
            })
            ->editColumn('subtotal', function($data){
                return 'Rp. '.number_format($data->subtotal,0).' ';
            })
            ->make(true);
        }
        }
        public function pesananLaporan (Request $request){
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
                            $detail = '<a href="'.route('admin.order.detail',$data->id).
                            '" class="btn btn-xs btn-warning"><i class="fa-solid fa-circle-info"></i></a>';
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
                        ->rawColumns(['status','action','total_price','number'])->make(true);
            }
            }
            public function produkOwner (){
                $data = Product::join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.id', 'products.name as pname', 'categories.name as cname', 'products.description',
                'products.price','products.stoks', 'products.image');
                return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function($data){
                    return '<img src=" '.url($data->image).' "/>';
                })
                ->editColumn('stoks', function($data){
                    if ($data->stoks == 0) {
                        $actiona = '<a href="#'.route('change.stoks',$data->id).'" class="btn btn-xs btn-danger" >Habis</a>';        
                    } else {
                        $actiona = '<a href="#'.route('change.stoks',$data->id).'" class="btn btn-xs btn-primary" >Ada</a>';
                    }
                    return $actiona;
                })
                ->rawColumns(['image','stoks'])
                ->make(true);
                }

            public function pelangganOwner (){
                $data = User::where('role','=','customer')
                 ->select('id','name','email', DB::raw("DATE_FORMAT(created_at, '%d-%b-%Y') as month"))
                ->orderBy('name','asc')
                ->get();
                return Datatables::of($data)->make(true);
                }

            public function adminOwner (){
                $data = User::where('role','=','admin')
                 ->select('id','name','email', DB::raw("DATE_FORMAT(created_at, '%d-%b-%Y') as month"))
                ->orderBy('name','asc')
                ->get();
                return Datatables::of($data)->make(true);
                }

            public function penjualan_cetak (){
                $category=Category::get();
                return view('owner.cetak_laporan_penjualan',compact('category'));
                }

            public function pesanan_cetak (){
                return view('owner.cetak_laporan_pesanan');
                }

public function cari(Request $request){
    $produk = Category::all();
    $start_date = Carbon::parse($request->start_date)->toDateTimeString();
    $end_date = Carbon::parse($request->end_date)->toDateTimeString();
    $category = $request->category;
    $name = $request->name;
    $orders = Order_Product::join('orders','order_product.order_id','=','orders.id')
    ->join ('products','order_product.product_id','=','products.id')
    ->select('order_product.id','products.name','products.price','products.category_id',
    'order_product.quantity','order_product.subtotal','orders.date','orders.status')
    ->where('orders.status','=','dibayar');
    if ($category != '---Pilih Kategori---') {
        $orders = $orders->where('products.category_id','=',$category);
        $sum = $orders->where('products.category_id','=',$category)
                      ->sum('order_product.subtotal');
        $sum2 = $orders->where('products.category_id','=',$category)
                      ->sum('products.price');
        $sum3 = $orders->where('products.category_id','=',$category)
                      ->sum('order_product.quantity');
    }
    if ($name != '---Pilih Nama---') {
        $orders = $orders->where('products.id','=',$name);
        $sum = $orders->where('products.category_id','=',$category)
                      ->sum('order_product.subtotal');
        $sum2 = $orders->where('products.category_id','=',$category)
                      ->sum('products.price');
        $sum3 = $orders->where('products.category_id','=',$category)
                    ->sum('order_product.quantity');
    }
    if (!empty($request->start_date) && !empty($request->end_date)) {
        $orders = $orders->whereBetween('orders.date',[$start_date,$end_date]);
        $sum = $orders->sum('order_product.subtotal');
        $sum2 = $orders->sum('products.price');
        $sum3 = $orders->sum('order_product.quantity');
        }
        $orders = $orders->get();
        return view('owner.new_laporan_tercetak', compact('orders','produk','sum','sum2',
        'sum3','start_date','end_date'));
        }
        
        public function kategori(Request $request){
            $category = Product::where("category_id",$request->category_id)->pluck('id','name');
            return response()->json($category);
        }

    public function cari2(Request $request){
        $start_date = Carbon::parse($request->start_date)->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->toDateTimeString();
        $name = $request->name;
        $orders = Order_Product::join('orders','order_product.order_id','=','orders.id')
        ->select('orders.id','orders.user_id','orders.receiver','orders.address',
        'orders.total_price','orders.date','order_product.quantity')
        ->where('status','=','dibayar');
            if (!empty($name)) {
                $orders = $orders->where('receiver','=',$name);
                    $sum = $orders->where('receiver','=',$name)
                    ->sum('total_price');
                    }
            if (!empty($request->start_date) && !empty($request->end_date)) {
                $orders = $orders->whereBetween('orders.date',[$start_date,$end_date]);
                    $sum = $orders->sum('total_price');
                    }
                    $orders = $orders->get();
                    return view('owner.new_laporan_tercetak_pemesanan', 
                    compact('orders','sum','start_date','end_date'));
                }
}
