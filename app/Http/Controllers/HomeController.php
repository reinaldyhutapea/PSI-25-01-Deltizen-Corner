<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;


class HomeController extends Controller
{
    public function welcome()
    {
        $products = Product::where('stoks', 1)
            ->where('category_id', 3)
            ->paginate(12);
        return view('front.home', compact('products'));
    }

    public function index()
    {
        $products = Product::where('stoks', 1)
            ->where('category_id', 3)
            ->paginate(12);
        return view('front.home', compact('products'));
    }

    public function makanan()
    {
        $products = Product::where('stoks', 1)
            ->where('category_id', 1)
            ->get();
        return view('front.menu', compact('products'));
    }

    public function minuman()
    {
        $products = Product::where('stoks', 1)
            ->where('category_id', 2)
            ->get();
        return view('front.menu', compact('products'));
    }

    public function promo()
    {
        $products = Product::where('stoks', 1)
            ->where('category_id', 3)
            ->get();
        return view('front.menu', compact('products'));
    }

    public function semua()
    {
        $products = Product::where('stoks', 1)->get();
        return view('front.menu', compact('products'));
    }

    public function all()
    {
        $products = Product::where('stoks', 1)
            ->orderBy('category_id', 'ASC')
            ->get();
        return view('front.menu', compact('products'));
    }

    /**
     * Pencarian produk — menggunakan Eloquent (aman dari SQL injection)
     */
    public function cari(Request $request)
    {
        $request->validate([
            'cari' => 'nullable|string|max:100',
        ]);

        $cari = $request->input('cari', '');

        // SECURITY: Menggunakan Eloquent dengan parameter binding (aman dari SQL injection)
        $products = Product::where('stoks', 1)
            ->when($cari, function ($query, $cari) {
                return $query->where('name', 'like', '%' . $cari . '%');
            })
            ->get();

        $message = $products->isEmpty() ? 'Produk tidak ditemukan.' : null;

        return view('front.menu', compact('products', 'message'));
    }

    public function detail_front($id)
    {
        $product = Product::findOrFail($id);
        return view('front.detail_product', compact('product'));
    }

    /**
     * Halaman pembayaran — dengan otorisasi kepemilikan order
     */
    public function pembayaran($id)
    {
        $order = Order::findOrFail($id);

        // SECURITY: Cek apakah order milik user yang sedang login atau guest yang benar
        $customer = currentCustomer();
        $visitor_id = session('visitor_id');

        if ($customer) {
            // User login — pastikan order milik user ini
            if ($order->user_id !== $customer->id) {
                abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
            }
        } elseif ($visitor_id) {
            // Guest — pastikan order milik visitor ini
            if ($order->visitor_id !== $visitor_id) {
                abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
            }
        } else {
            // Tidak ada identitas sama sekali
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }

        return view('front.pembayaran', compact('order'));
    }
}
