  @extends('layouts.frontend')
  <head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" >
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/f4cf3b69a5.js" crossorigin="anonymous"></script>
  <link href="{{ asset('/css/cart.css') }}" rel="stylesheet">
  </head>
  @section('content')
  <div class="container-fluid" style="margin-top: 90px;">
  <div class="menu-web">
    <div class="card"> 
      @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p class="text-green-800">{{ $message }}</p>
        </div>
      @endif

      <div class="card-head">
        <h3>Keranjang</h3>
      </div>
    
      <div class="card-body">
        <p>Informasi Pesanan </p>
            <table class="table ">
              <thead>
                <tr >
                  <th></th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cartItems as $item)
                <tr>
                  <td>
                    <a class="image-active" href="#">
                      <img src="{{ $item->attributes->image }}" alt="Thumbnail">
                    </a>
                  </td>
                  <td>
                    <a href="#" style="text-decoration: none;color: black;">
                      <p>{{ $item->name }}</p>
                    </a>
                  </td>
                  <td>
                    <span>
                      Rp. {{ number_format( $item->price,0) }}
                    </span>
                  </td>
                  <td class="qty">
                    <form action="{{ route('cart.update') }}" method="POST">
                      @csrf
                      <input type="hidden" name="id" value="{{ $item->id}}" >
                      <div class="quantity">
                        <input type="number" name="quantity" min="1" max="100" step="1" value="{{ $item->quantity }}">
                      </div>
                      <button type="submit" class="btn"><i class="fa-solid fa-rotate"></i></button>
                    </form>
                  </td>
                  <td>
                    <form action="{{ route('cart.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $item->id }}" name="id">
                    <button class="close">
                      <span aria-hidden="true"><i class="fa fa-close"></i></span>
                    </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          <div class="total" style="float: right;">
            <h5 style="font-size: 20px">Total:</h5>
            <h5 style="font-weight: 700">Rp. {{ number_format( Cart::getTotal(),0) }}</h5>
          </div>
      </div>

        <div class="action">
          <form class="btn1" action="{{ route('cart.checkout') }}" method="GET">
            @csrf
            <button id="btn2" class="btn" style="color: white">Checkout</button>
          </form>
          <form class="btn2" action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button id="btn1" class="btn" style="color: white"><i style="font-size: 24px" class="fa-regular fa-trash-can" aria-hidden="true"></i></button>
          </form>
      </div>
      <a href="/home" style="text-decoration: none; font-size: 16px; background-color: rgb(54, 64, 255);width: 169px;padding: 8px;color: white;border-radius: 5px;text-align: center;" ><i class="fa-solid fa-arrow-left" style="margin-right: 5px;" aria-hidden="true"></i>Lanjut Belanja</a>
        
  {{-- starts v2 --}}


  {{-- starts v2 --}}
      

    </div>
  </div>
    <div class="menu-mobile" >
      <h1 style="margin-top: -15px;margin-bottom: 25px;">Keranjang Saya</h1>
      
      @foreach ($cartItems as $item)
      <div class="card2">
        <div class="left">
          <img src="{{ $item->attributes->image }}" alt="Thumbnail">
        </div>
        <div class="right">
          <h3 style="font-weight: 600;font-size: 20px;margin-bottom: 3px;">{{ $item->name }}</h3>
        <p style="font-size: 16px;font-weight: 400;margin-bottom: 5px;">  Rp. {{ number_format( $item->price,0) }}</p>
          <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id}}" >
            <div class="quantity">
              <input type="number" id="qty" name="quantity" min="1" max="100" step="1" value="{{ $item->quantity }}">
            </div>
            <button type="submit" class="btn"><i class="fa-solid fa-rotate"></i></button>
          </form>
        
        </div>
        <form action="{{ route('cart.remove') }}" method="POST">
          @csrf
          <input type="hidden" value="{{ $item->id }}" name="id">
          <button class="close">
            <span aria-hidden="true"><i class="fa fa-close"></i></span>
          </button>
          </form>
      </div>
      @endforeach
      
      <div class="card3">
        <h3 class="title" style="font-size: 20px;">Subtotal</h3>
        <hr>
        <h4 class="subtitle" id="qty" style="font-size: 18px;">Jumlah Item <span style="float: right">{{ Cart::getTotalQuantity()}}</span></h4>
        <hr>
        <h4 class="subtitle" style="font-size: 18px;">Total Harga <span style="float: right">Rp. {{ number_format( Cart::getTotal(),0) }}</span> </h4>
        <hr>
      
      </div>
      <div class="action" style="margin-top: 30px;padding: 10px;">
        <form class="btn1" action="{{ route('cart.checkout') }}" method="GET">
          @csrf
          <button id="btn2" class="btn" style="color: white">Checkout</button>
        </form>
        <form class="btn2" action="{{ route('cart.clear') }}" method="POST">
          @csrf
          <button id="btn1" class="btn" style="color: white"><i style="font-size: 24px" class="fa-regular fa-trash-can" aria-hidden="true"></i></button>
        </form>
      </div>
      <a href="/home" class="back" style="text-decoration: none;font-size: 16px; background-color: rgb(54, 64, 255);width: 169px;padding: 8px;color: white;border-radius: 5px;text-align: center;"><i class="fa-solid fa-arrow-left" style="margin-right: 5px" aria-hidden="true"></i>Lanjut Belanja</a>
      
      </div>
      
  </div>
  @endsection
  <script>
    $("#qty").bind('keyup mouseup', function () {
      alert("changed");            
  });
  </script>