<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Deltizen Corner</title>
    <!--===============================================================================================-->	
	<link rel="icon" type="{{ asset('/log/image/png')}}" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/log/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/log/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/log/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/log/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="{{ asset('/log/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/log/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/log/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="{{ asset('/log/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('/log/css/util.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/log/css/main.css')}}">
    <!--===============================================================================================-->
    <style>
        .form-control {
            position: relative;
            border: 0;
      
        }

    </style>
</head>
<body>
    <div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('customer.login.submit') }}">
                @csrf
                <span class="login100-form-title p-b-26">
                    Selamat Datang di Deltizen Corner !
                </span>
                <span class="login100-form-title p-b-48">
                    <i class="zmdi zmdi-blogger"></i>
                </span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                    <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="focus-input100" data-placeholder="Email"></span>
                   
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>

                <div class="input100" style="text-align: center">
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Lupa Password ?') }}
                    </a>
                @endif

                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </div>

                <div class="text-center p-t-75">
                    <span class="txt1">
                        Belum Punya Akun ?
                    </span>

                    <a class="txt2" href="{{ route('register') }}">
                        Daftar disini 
                    </a>
                </div>
                
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>



	
<!--===============================================================================================-->
	<script src="{{ asset('/log/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('/log/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('/log/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{ asset('/log/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('/log/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('/log/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{ asset('/log/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('/log/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('/log/js/main.js')}}"></script>

{{-- @endsection --}}
<body>
    
</html>