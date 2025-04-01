<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CartController extends Controller{
    //
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('front.cart', compact('cartItems'));
    }


    public function addToCart(Request $request){

        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');

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


        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
    public function checkout(Request $request)
    {

        // $this->middleware('role:customer');
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
        
        $user_id = Auth::user()->id;
        $receiver = $request->name;
        $address = $request->address;
        $total_bayar = 0;

        $getTotal=\Cart::getTotal();
        $keranjang = \Cart::getContent();
        // foreach ($keranjang as $cart){
        //     $total_bayar += $cart->$getTotal;
        // }

        $order = new Order;
        $order->user_id = $user_id;
        $order->receiver = $receiver;
        $order->address = $address;
        $order->total_price = $getTotal;
        $order->date = Carbon::now();
        $order->save();

        foreach ($keranjang as $cart){
            $order_product = new Order_Product;
            $order_product->order_id = $order->id;
            $order_product->product_id = $cart->id;
            $order_product->quantity = $cart->quantity;
            $order_product->subtotal = \Cart::getTotal();
            $order_product->save();
        }

        
        \Cart::clear();

        return redirect('/invoice/list')->with('status','Anda berhasil melakukan checkout');
    }
   
    
    
    }

   
