@extends('layouts.frontend')
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/invoice.css') }}">
</head>
@section('content')
    <div class="container-fluid">
        
        <div class="card">
    <table class="table">
                       <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Waktu Pemesanan</th>
                            <th>Status</th>
                       </thead>
                       <tbody>
                        @foreach($order_product as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->receiver }}</td>
                                <td>{{ $order->quantity}}</td>
                                <td>{{ $order->total_price}}</td>
                                <td>{{ $order->date}}</td>
                                <td>{{ $order->status}}</td>
                            </tr>
                        @endforeach    
                    </tbody>
                    </table>
                    <p>Silahkan lakukan Pembayaran Secara langung di kasir ya,</p>
                    <p>Atau bisa melalui scan Qris di bawah ini</p>
                    <p>Silahkan klik tombol lanjutkan untuk konfirmasi pembayaran</p>
                    <p>dan melihat rincian pesanan</p>
                    <br>
                    <a href="{{ url('/invoice/list/')}}"  class="btn btn-primary">Lanjutkan Pembayaran</a>
            </div>
        </div>

        
                     
@endsection


