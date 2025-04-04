@extends('layouts.frontend')
<head>
    <link rel="stylesheet" href="{{ asset('/css/checkout.css') }}">
</head>
@section('content')
    <div class="container-fluid" >
        <div class="card" style="margin-top: 30px;">
        <h3 class="card-header">Checkout</h3>
            <form role="form" method="post" action="{{ route('cart.bayar')  }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Pemesan" required>                    
                    </div>
                    <br>
                    <div class="form-group">
                        <label>No telepon yang dapat dihubungi</label>
                       <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan No telepon yang dapat dihubungi" autofocus required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea type="text" class="form-control" name="catatan" id="catatan" placeholder="Masukkan Catatan Pesanan" cols="30" rows="5"></textarea>
                    </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
            </form>

        </div>
 
    </div>
</div>
    @endsection

