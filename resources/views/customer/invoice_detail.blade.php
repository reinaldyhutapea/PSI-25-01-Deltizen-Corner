    @extends('layouts.frontend')
    <!doctype html>
    <html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href=" {{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }} ">
    <link href="{{ asset('/css/invoice_detail.css') }}" rel="stylesheet">
    </head>
    @section('content')
<div class="container-fluid" style="margin-top: 100px;position: relative;">
        <div class="web-ui">
            <a href="{{ route('invoice.list') }}" class="buton" style="margin-left:101px ;text-decoration: none;color: white;">Kembali</a>
            <div class="card">
             
                <div class="card-header" style="font-size: 20px;"><h3>Detail Pesanan</h3></div>
                <div class="card-body">
                    <div class="row" style="justify-content: center;">
                        @foreach($details as $detail)
                        <div class="col-2">
                            <div style="text-align: left;">
                                <img style="height: 150px;width: 150px;padding-bottom:25px;padding-left:15px;" src="{{ url($detail->image) }}" >
                            </div>
                        </div>
                        <div class="col-10">
                            <table style="margin-bottom: 20px;"> 
                                <tr>
                                    <td class="title">Nama Produk<span style="float: right;">:</span></td>
                                    <td><div style="font-size: 25px;">{{ $detail->name }}</div></td>
                                </tr>
                                <tr>
                                    <td class="title">Jumlah <span style="float: right;">:</span></td>
                                    <td><div style="font-size: 25px;">{{ $detail->quantity }}</div></td>
                                </tr>
                                <tr>
                                    <td class="title">Subtotal <span style="float: right;">:</span></td>
                                    <td><div style="font-size: 25px;">
                                    Rp. {{ number_format($detail->price,0) }}
                                    </div></td>
                                </tr>
                                <tr>
                                    <td class="title">Catatan <span style="float: right;">:</span></td>
                                    <td><div style="font-size: 25px;">
                                    {{ $detail->catatan }}
                                    </div></td>
                                </tr>
                                <tr>
                                    <td class="title">Detail Status <span style="float: right;">:</span></td>
                                    <td><div style="font-size: 25px;"> 
                                        @if($detail->status == 'belum bayar')
                                        <p><i class="fa fa-circle" style="margin-right: 5px;color:yellow;margin-top: 25px;"></i>{{ ucwords($detail->detail_status) }}</p>
                                    @elseif($detail->status == 'menunggu verifikasi')
                                        <p><i class="fa fa-circle" style="margin-right: 5px;color:orange;margin-top: 25px;"></i>{{ ucwords($detail->status) }}</p>
                                    @elseif($detail->status == 'dibayar')
                                        <p><i class="fa fa-circle" style="margin-right: 5px;color:green;margin-top: 25px;"></i>{{ ucwords($detail->status) }}</p>
                                    @else
                                        <p ><i class="fa fa-circle"  style="margin-right: 5px;color:red;margin-top: 25px;"></i >{{ ucwords($detail->status) }} Karena {{ ucwords($detail->detail_status) }}</p>
                                    @endif
                                    </div></td>
                                </tr>
                            </table>
                         <hr>
                    </div>
                @endforeach
            </div>
            <h3 style="margin-left: 170px;">Total : 
                Rp. {{ number_format($detail->subtotal,0) }}
            </h3>
        </div>
        <div class="card-footer">
  
            
    </div>
    
    </div>
   
    <h1 style="visibility: hidden">Foooter</h1>
</div>
    

    <div class="mobile-ui">
        <a href="{{ route('invoice.list') }}" class="buton" style="margin-bottom: 10px;text-align: center;text-decoration: none;color: white;">Kembali</a>
      
        <div class="card mb-4">
            <div class="card-header" style="margin-bottom: 10px;">
                <h2>Detail Produk</h2>
            </div>
              @foreach($details as $detail)
              <div class="card-body">
            <div class="row" style="align-items: center;" >
                <div class="col-4">
            <img style="text-align: center;height: 125px;width: 125px; padding: 0px;" src="{{ url($detail->image) }}" >
        </div>
       
        <div class="col-8">
                <table style="margin-bottom: 20px;"  width="100%"> 
                    <tr>
                        <td class="subtitle" style="font-size: 20px;font-weight: 500; float: right;">{{ $detail->name }}</td>
                    </tr>
                    <tr>
                        <td class="subtitle" style="font-size: 20px; float: right;">{{ $detail->quantity}}x</td>
                    </tr>
                    <tr>
                        <td class="subtitle" style="font-size: 20px; float: right;">Rp. {{ $detail->price}}</td>
                    </tr>
                    <tr>
                        <td class="subtitle" style="font-size: 20px; float: right;">{{ $detail->catatan}}</td>
                    </tr>
                    <tr>
                        <td class="subtitle" style="font-size: 20px; float: right;">

                            @if($detail->detail_status == 'belum bayar')
                            <p><i class="fa fa-circle" style="color:yellow;"></i>{{ ucwords($detail->detail_status) }}</p>
                        @elseif($detail->status == 'menunggu verifikasi')
                            <p><i class="fa fa-circle" style="color:orange;"></i>{{ ucwords($detail->status) }}</p>
                        @elseif($detail->status == 'dibayar')
                            <p><i class="fa fa-circle" style="color:green;"></i>{{ ucwords($detail->status) }}</p>
                        @else
                            <p ><i class="fa fa-circle"  style="color:red;"></i >{{ ucwords($detail->status) }} Karena {{ ucwords($detail->detail_status) }}</p>
                        @endif
                        </td>
                    </tr>
       
                </table> 
            </div>
        </div>
            </div>
            <hr>
            @endforeach

        <h2 style="font-size: 25px;padding: 10px;">Subtotal : Rp. {{ number_format($detail->subtotal)}}</h2>
            
   </div>

   <h1 style="visibility: hidden">Foooter</h1>

    @endsection