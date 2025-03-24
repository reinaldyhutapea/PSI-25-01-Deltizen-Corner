@extends('layouts.admin-template')
@section('content')
@if(session('status'))
    <div class="box-header">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-check"></i> Success! &nbsp;
                    {{ session('status') }}
        </div>
    </div>
@endif
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- <link href="{{ asset('/css/order.css') }}" rel="stylesheet"> --}}
<style>

 
    .btn {
    position: relative;
    display: inline-block;
    height: 41px;
    width: 43px;
    padding: 5px;
}

.btn .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;
  opacity: 0;
  transition: opacity 0.3s;
}

.btn .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.btn:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}

.btn1{
    padding: 5px;
    border-radius: 10px;
}

@media screen and (max-width: 600px) {

 

  #btn2{
      margin-top: 5px;
  }
  #btn3{
      margin-top: 5px;
  }
}
</style>
</head>
    <div class="container-fluid">
      
        <div class="header" style="margin-top: 20px;">
            <h4 style="font-weight: 700" style="margin-bottom: 20px;">Konfirmasi Pesanan</h4>         
        </div>
        <div class="card shadow mb-4" style="padding: 5px;">
            <div class="card-body">
                <div style="overflow: auto;" >
                    <table id="categories" class="table ">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Total Harga</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                             </tr>
                        </thead>

                        @php
                            $no = 1;
                        @endphp

                        @foreach($confirms as $index=>$confirm)
                        <tbody>
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $confirm->user->name }}</td>
                                <td>Rp. {{ number_format($confirm->order->total_price,0) }}</td>
                                <td>{{ $confirm->order->date }}</td>
                                <td>
                                    <button type="button" class="btn bg-warning"><i class='bx bx-time-five' style="font-size: 30px;font-weight: 700;"></i><span class="tooltiptext">Menunggu Verifikasi</span></button> 
                                </td>
                                <td>
                                    <a href="{{ url('upload/confirm/'.$confirm->image) }}" class="btn bg-primary" download><i class='bx bx-download' style="font-size: 30px;font-weight: 700;"></i><span class="tooltiptext">Download Attachment</span></a>
                                </td>
                                <td>
                                    <a href="{{ url('/confirmAdmin/detail/'.$confirm->order_id) }}" id="btn1" class="btn btn-secondary"><i class='bx bx-info-circle' style="font-size: 30px;font-weight: 700;color: #fff;"></i><span class="tooltiptext">Detail Pesanan</span></a>
                                    <a href="{{ url('/confirmAdmin/terima/'.$confirm->order_id) }}" id="btn2" class="btn bg-success"><i class='bx bx-check-circle' style="font-size: 30px;font-weight: 700;"></i><span class="tooltiptext">Terima Pesanan</span></a>
                                    <button type="button" href="{{ url('/confirmAdmin/tolak/'.$confirm->order_id)}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop"  id="btn3" class="btn bg-danger"><i class='bx bx-x-circle' style="font-size: 30px;font-weight: 700;"></i> <span class="tooltiptext">Tolak Pesanan</span></button>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>  
                 </div>
                </div>
            </div>
        </div>
   
    {{-- end of none mobile ui --}}

    </div>
    
        <!-- Modal Create Product -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  " style="height: 200px;">
            <div class="modal-content">     
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Alasan Ditolak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach($confirms as $index=>$confirm)
                    <form role="form" method="get" action="{{ url('/confirmAdmin/tolak/'.$confirm->order_id)}}" enctype="multipart/form-data">
                        @endforeach
                        @csrf
                   <input type="radio" name="detail_status" value="Alamat Terlalu Jauh">Alamat Terlalu Jauh<br>
                    <input type="radio" name="detail_status" value="Bukti Pembayaran Tidak Sesuai">Bukti Pembayaran Tidak Sesuai<br>
                    <input type="radio"  name="detail_status" id="other"  value="other">Other <input  class="form-control" onClick="otherChoice()"  id="inputother" type="text" onchange="changeradioother()" />
                    </div>
                <div class="modal-footer">
                <button type="button" class="btn1 btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn1 btn-success">Tolak</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <script>
                      function otherChoice(){
            a=document.getElementById('other');
            a.checked=true;
            }

            function changeradioother() {
  var other = document.getElementById("other");
  other.value = document.getElementById("inputother").value;
}
            </script>

    @endsection