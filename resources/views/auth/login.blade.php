

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
         
                       
                    <form class="margin-t" method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

@error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
                        </div>
                        <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" required autocomplete="current-password">
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <button type="submit" class="form-button button-l margin-b">Sign In</button>
        
                      
                    
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-white" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                         <br>
                        <a class="text-white" href="{{ route('register') }}"><small>Sign Up</small></a>
                    </form>
                    <p class="margin-t text-whitesmoke"><small> By Angga Pradipta &copy; 2022</small> </p>
                </div>
            </div>
</body>
</div>
@endsection
