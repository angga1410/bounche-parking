

@extends('layouts.login')

@section('content')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
<link rel="stylesheet" href="{{asset('css/animated.css')}}">
<div class="container">
<body class="main-bg">
        <div class="login-container text-c animate__flipInX">
                <div>
                <img class="animate__animated animate__bounce" src="{{asset('img/logo-login.png')}}" width="100%">
                </div>
            
                 
                <div class="container-content">
                <h3 class="text-whitesmoke">Register</h3>
                       
                    <form class="margin-t" method="POST" action="{{ route('register') }}">
                    @csrf
                        <div class="form-group">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="username" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

@error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
                        </div>
                        <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" required autocomplete="new-password">

@error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
                        </div>
                        <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" placeholder="confirm password" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <button type="submit" class="form-button button-l margin-b">Register</button>
        
                      
                    
                                 
                         <br>
                        <a class="text-white" href="{{ route('login') }}"><small>Back to Login</small></a>
                    </form>
                    <p class="margin-t text-whitesmoke"><small> By Angga Pradipta &copy; 2022</small> </p>
                </div>
            </div>
</body>
</div>
@endsection
