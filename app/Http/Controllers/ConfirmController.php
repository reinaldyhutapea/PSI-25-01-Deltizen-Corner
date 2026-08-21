<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confirm;
use App\Models\Order;

class ConfirmController extends Controller
{
    public function index($id)
    {
        $order = Order::findOrFail($id);
        return view('customer.confirm', compact('order'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB, hanya gambar
        ], [
            'image.required' => 'Bukti pembayaran wajib diupload',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus JPG, JPEG, atau PNG',
            'image.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        $order_id = $request->order_id;
        $confirm = new Confirm;

        // Upload gambar dengan nama yang aman
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $newName = 'confirm_' . $order_id . '_' . time() . '.' . $ext;
        $file->move(public_path('upload/confirm'), $newName);

        // Pakai helper currentCustomer()
        $customer = currentCustomer();

        if ($customer) {
            $confirm->user_id = $customer->id;
            $order = Order::where('id', $order_id)
                ->where('user_id', $customer->id)
                ->first();
        } else {
            $visitor_id = session('visitor_id');
            $confirm->visitor_id = $visitor_id;
            $order = Order::where('id', $order_id)
                ->where('visitor_id', $visitor_id)
                ->first();
        }

        // Pastikan order ditemukan dan milik user/visitor ini
        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan atau bukan milik Anda.');
        }

        // Simpan data konfirmasi
        $confirm->order_id = $order_id;
        $confirm->image = $newName;
        $confirm->status_order = 'menunggu verifikasi';
        $confirm->save();

        // Update status order
        $order->status = 'menunggu verifikasi';
        $order->save();

        return redirect('/invoice/list')
            ->with('success', 'Pembayaran berhasil, admin akan verifikasi pesananmu!');
    }
}
