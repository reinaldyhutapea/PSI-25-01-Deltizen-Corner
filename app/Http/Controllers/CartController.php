<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


class CartController extends Controller
{

    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('front.cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash(
            'success',
            'Produk berhasil ditambahkan kedalam keranjang !'
        );
        return redirect()->route('cart.list');
    }
    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        session()->flash('success', 'Produk berhasil diperbarui!');
        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Produk berhasil dihapus dari keranjang  !');
        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();
        session()->flash('success', 'Keranjang Berhasil Dikosongkan !');

        return redirect()->route('cart.list');
    }
    public function checkout(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        return view('customer.checkout');
    }

    public function bayar(Request $request)
    {
        // Cek apakah user login
        $user_id = Auth::check() ? Auth::id() : null;
        $visitor_id = session('visitor_id'); // Ambil visitor_id dari session (cookies)

        $receiver = $request->name;
        $address = $request->address;
        $catatan = $request->catatan ?? 'Tidak Ada Catatan'; // Default catatan jika kosong
        $detail_status = 'belum bayar';
        $total_bayar = \Cart::getTotal();
        $keranjang = \Cart::getContent();

        // Simpan order
        $order = new Order;
        $order->user_id = $user_id;
        $order->visitor_id = $visitor_id;
        $order->receiver = $receiver;
        $order->address = $address;
        $order->catatan = $catatan;
        $order->detail_status = 'belum bayar'; // Ini OK
        $order->status = 'belum bayar'; // Tambahin ini
        $order->total_price = $total_bayar;
        $order->date = Carbon::now();
        $order->save();

        // Simpan produk dalam pesanan
        foreach ($keranjang as $cart) {
            $order_product = new Order_Product;
            $order_product->order_id = $order->id;
            $order_product->product_id = $cart->id;
            $order_product->quantity = $cart->quantity;
            $order_product->subtotal = $cart->quantity * $cart->price;
            $order_product->save();
        }

        // Bersihkan keranjang setelah checkout
        \Cart::clear();

        return redirect()->route('confirm.index', $order->id)
    ->with('success', 'Pemesanan berhasil, silahkan upload bukti pembayaran');
    }
}