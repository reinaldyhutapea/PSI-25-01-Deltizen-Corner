<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    public function index()
    {
        $order_product = DB::table('order_product')
            ->join('orders', 'order_product.order_id', '=', 'orders.id')
            ->select('order_product.', 'orders.')
            ->get();
        return view('customer.invoice', ['order_product' => $order_product]);
    }
    public function list()
    {
        if (Auth::check()) {
            // Jika user login, ambil pesanan berdasarkan user_id
            $user_id = Auth::user()->id;
            $orders = Order::where('user_id', $user_id)
                ->orderBy('status', 'asc')
                ->get();
        } else {
            // Jika user guest, ambil pesanan berdasarkan visitor_id
            $visitor_id = session('visitor_id');
            $orders = Order::where('visitor_id', $visitor_id)
                ->orderBy('status', 'asc')
                ->get();
        }

        return view('customer.list_invoice', compact('orders'));
    }

    public function detail($id)
    {
        $visitorId = session('visitor_id'); // Ambil visitor_id dari session
        $userId = auth()->check() ? auth()->id() : null; // Ambil user_id jika login

        $details = DB::table('order_product')
            ->join('orders', 'order_product.order_id', '=', 'orders.id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->select('order_product.*', 'orders.*', 'products.*')
            ->where('order_product.order_id', $id)
            ->where(function ($query) use ($userId, $visitorId) {
                if ($userId) {
                    $query->where('orders.user_id', $userId);
                } else {
                    $query->where('orders.visitor_id', $visitorId);
                }
            })
            ->get();
        if ($details->isEmpty()) {
            abort(404, 'Pesanan tidak ditemukan atau tidak memiliki akses.');
        }

        return view('customer.invoice_detail', compact('details'));
    }
}