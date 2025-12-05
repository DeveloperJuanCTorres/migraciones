@extends('layouts.app')

@section('content')

<style>
.forgot-bg {
    min-height: 100vh;
    background-image: url("{{ asset('assets/img/fondo1.jpeg') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.forgot-overlay {
    min-height: 100vh;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.45);
}
</style>

<div class="container-fluid forgot-bg p-0 m-0">
    <div class="row h-100 align-items-center justify-content-center forgot-overlay g-0">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">

                {{-- LOGO --}}
                <div class="text-center mb-4">
                    <a href="/">
                        <img src="{{ asset('assets/img/migraciones.png') }}" alt="Logo" style="height: 65px;">
                    </a>
                    <h3 class="mt-3 text-white">Recuperar Contraseña</h3>
                    <small class="text-light">
                        Ingresa tu correo y te enviaremos el enlace de recuperación
                    </small>
                </div>

                {{-- MENSAJE DE ESTADO --}}
                @if (session('status'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="form-floating mb-4">
                        <input id="email" 
                               type="email" 
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror" 
                               placeholder="correo@correo.com"
                               required 
                               autocomplete="email" 
                               autofocus>
                        <label for="email">Correo electrónico</label>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-3">
                        Enviar enlace de recuperación
                    </button>

                    {{-- VOLVER --}}
                    <a href="{{ route('login') }}" class="btn btn-link d-block text-center text-white">
                        Volver al login
                    </a>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
