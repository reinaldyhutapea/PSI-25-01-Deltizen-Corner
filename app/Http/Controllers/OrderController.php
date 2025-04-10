<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Product;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'detail', 'produkData']);
    // }

    public function index()
    {
        if (Auth::check()) {
            // Jika user login, ambil order berdasarkan user_id
            $orders = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        } else {
            // Jika user guest, ambil order berdasarkan visitor_id dari session
            $visitor_id = session('visitor_id');
            $orders = Order::where('visitor_id', $visitor_id)->orderBy('id', 'desc')->get();
        }

        return view('admin.order.index', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::find($id);

        // Pastikan hanya pemilik order yang bisa melihat detailnya
        if (Auth::check()) {
            if ($order->user_id != Auth::id()) {
                abort(403, "Unauthorized Access");
            }
        } else {
            if ($order->visitor_id != session('visitor_id')) {
                abort(403, "Unauthorized Access");
            }
        }

        $details = Order_Product::where('order_id', $id)->get();
        $identity = Order_Product::where('order_id', $id)->first();

        return view('admin.order.detail', compact('details', 'identity', 'id'));
    }

    public function cetak()
    {
        return view('order.cetak_laporan');
    }

    public function cetak_pertanggal($tglawal, $tglakhir)
    {
        if (Auth::check()) {
            $orders = Order::whereBetween('date', [$tglawal, $tglakhir])
                ->where('status', '=', 'dibayar')
                ->where('user_id', Auth::id())
                ->get();
            $sum = Order::whereBetween('date', [$tglawal, $tglakhir])
                ->where('status', '=', 'dibayar')
                ->where('user_id', Auth::id())
                ->sum('total_price');
        } else {
            $visitor_id = session('visitor_id');
            $orders = Order::whereBetween('date', [$tglawal, $tglakhir])
                ->where('status', '=', 'dibayar')
                ->where('visitor_id', $visitor_id)
                ->get();
            $sum = Order::whereBetween('date', [$tglawal, $tglakhir])
                ->where('status', '=', 'dibayar')
                ->where('visitor_id', $visitor_id)
                ->sum('total_price');
        }

        return view('order.laporan_tercetak', compact('orders', 'tglawal', 'tglakhir', 'sum'));
    }

    public function produkData(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $query = DB::table('orders')
                    ->whereBetween('date', array($request->from_date, $request->to_date));
            } else {
                $query = DB::table('orders');
            }

            // Filter berdasarkan user login atau visitor_id
            if (Auth::check()) {
                $query->where('user_id', Auth::id());
            } else {
                $query->where('visitor_id', session('visitor_id'));
            }

            $data = $query->get();

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('admin.order.detail', $data->id) . '" id="btn0" class="btn btn-xs btn-secondary"><i class="fa-solid fa-circle-info"></i></a>';
                })
                ->editColumn('status', function ($data) {
                    switch ($data->status) {
                        case 'belum bayar':
                            return '<button type="button" class="btn btn-maroon"><i class="bx bx-no-entry"></i> Belum Bayar</button>';
                        case 'menunggu verifikasi':
                            return '<button type="button" class="btn btn-warning"><i class="bx bx-time-five"></i> Menunggu Verifikasi</button>';
                        case 'dibayar':
                            return '<button type="button" class="btn btn-success"><i class="bx bx-check-circle"></i> Dibayar</button>';
                        default:
                            return '<button type="button" class="btn btn-danger"><i class="bx bx-x-circle"></i> Ditolak</button>';
                    }
                })
                ->editColumn('total_price', function ($data) {
                    return 'Rp. ' . number_format($data->total_price, 0);
                })
                ->rawColumns(['status', 'action', 'total_price'])
                ->make(true);
        }
    }

    public function records()
    {
        if (Auth::check()) {
            // Jika user login, ambil riwayat pesanan berdasarkan user_id
            $orders = Order::where('user_id', Auth::id())->get();
        } else {
            // Jika guest, ambil berdasarkan visitor_id dari session
            $orders = Order::where('visitor_id', session('visitor_id'))->get();
        }

        return view('order.records', compact('orders'));
    }

    public function laporan_penjualan(Request $request)
    {
        $startDate = $request->input('from_date', now()->subDays(30)->toDateString());
        $endDate = $request->input('to_date', now()->toDateString());

        if ($startDate > $endDate) {
            return redirect()->back()->withErrors(['date' => 'Tanggal awal tidak boleh lebih besar dari tanggal akhir']);
        }

        $totalSales = Order::byDateRange($startDate, $endDate)
            ->byStatus('dibayar')
            ->sum('total_price');
        $orderCount = Order::byDateRange($startDate, $endDate)
            ->byStatus('dibayar')
            ->count();
        $avgOrderValue = $orderCount ? $totalSales / $orderCount : 0;

        $dailySales = Order::byDateRange($startDate, $endDate)
            ->byStatus('dibayar')
            ->selectRaw('DATE(date) as sale_date, SUM(total_price) as total')
            ->groupBy('sale_date')
            ->orderBy('sale_date')
            ->pluck('total', 'sale_date')
            ->toArray();

        $topProducts = Order_Product::whereHas('order', function ($query) use ($startDate, $endDate) {
            $query->byDateRange($startDate, $endDate)->byStatus('dibayar');
        })
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->selectRaw('products.name, SUM(order_product.quantity) as total_quantity, SUM(order_product.subtotal) as total_revenue')
            ->groupBy('products.name')
            ->orderByDesc('total_quantity')
            ->limit(5)
            ->get();

        $statusDistribution = Order::byDateRange($startDate, $endDate)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $stats = [
            'total_sales' => $totalSales,
            'order_count' => $orderCount,
            'avg_order_value' => $avgOrderValue,
            'daily_sales' => $dailySales,
            'top_products' => $topProducts,
            'status_distribution' => $statusDistribution,
        ];

        return view('owner.laporan_penjualan', compact('stats', 'startDate', 'endDate'));
    }
}
