@extends('layouts.frontend')
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" >        
    <script src="https://kit.fontawesome.com/f4cf3b69a5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('/css/invoice.css') }}">
</head>
@section('content')
    <div class="desktop">
        <div class="container-fluid" style="margin-top: 80px;">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">  
                <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @if ($message = Session::get('warning'))
            <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>	
              <strong>{{ $message }}</strong>
            </div>
            @endif

            <div class="card">
                <div class="box-header">
                    <h3>Ringkasan Pesanan</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table"> 
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Penerima</th>
                                <th>Alamat</th>
                                <th>Total Bayar</th>
                                <th>Tanggal</th>
                                <th>Kode Pesanan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            @if ($orders->isNotEmpty()) {{-- Pastikan orders tidak kosong --}}
                                @foreach($orders as $index=>$order)
                                    <tbody>
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $order->receiver }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>Rp. {{ number_format($order->total_price,0) }}</td>
                                        <td>{{ $order->date }}</td>
                                        <td>{{ optional($order)->id }}</td> {{-- Mencegah error jika null --}}
                                        <td>
                                            @if($order->status == 'belum bayar')
                                                <p><i class="fa fa-circle" style="margin-right: 5px;color:yellow"></i>{{ ucwords($order->status) }}</p>
                                            @elseif($order->status == 'menunggu verifikasi')
                                                <p><i class="fa fa-circle" style="margin-right: 5px;color:orange"></i>{{ ucwords($order->status) }}</p>
                                            @elseif($order->status == 'dibayar')
                                                <p><i class="fa fa-circle" style="margin-right: 5px;color:green"></i>{{ ucwords($order->status) }}</p>
                                            @else
                                                <p><i class="fa fa-circle" style="margin-right: 5px;color:red"></i>{{ ucwords($order->status) }}</p>
                                            @endif
                                        </td>
                                        <td class="action">
                                            @if(optional($order)->id) {{-- Cegah error jika id null --}}
                                                <a href="{{ route('invoice.detail', ['id' => $order->id]) }}" class="button-61">Detail</a>
                                                @if($order->status == 'belum bayar')
                                                    <a href="{{ route('confirm.index', ['id' => $order->id]) }}" class="button-62">Konfirmasi Pembayaran</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            @else
                                <tbody>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada pesanan.</td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
