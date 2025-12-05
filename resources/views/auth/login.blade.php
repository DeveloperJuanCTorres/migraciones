@extends('layouts.app')
<style>
    .login-bg {
        min-height: 100vh;
        background-image: url("{{ asset('assets/img/migraciones-fondo.jpeg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0 !important;
        padding: 0 !important;
    }
    .login-overlay {
        min-height: 100vh;
        width: 100vw;
        /* background-color: rgba(0, 0, 0, 0.15); */
        margin: 0;
        padding: 0;
    }
</style>

@section('content')

<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sign In Start -->
    <div class="container-fluid login-bg">
        <div class="row h-100 align-items-center justify-content-center login-overlay g-0" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="text-center mb-3">
                        <a href="/" class="">
                            <img src="{{asset('assets/img/migraciones.png')}}" alt="" style="height: 80px;">
                        </a>
                        <!-- <h3 class="text-white">Login</h3> -->
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input id="email" name="email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" required autocomplete="email" autofocus>
                            <label for="floatingInput">Email address</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
                            <label for="floatingPassword">Password</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="exampleCheck1">Recordar</label>
                            </div>
                            <!-- <a href="">Olvidé la contraseña</a> -->
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Iniciar Sesión</button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link d-block text-center text-white" href="{{ route('password.request') }}">
                                Olvidaste la contraseña?
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
</div>
@endsection
