@extends('layouts.app')

@section('content')

<style>
.reset-bg {
    min-height: 100vh;
    background-image: url("{{ asset('assets/img/fondo-login.jpg') }}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.reset-overlay {
    min-height: 100vh;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.55);
}
</style>

<div class="container-fluid reset-bg p-0 m-0">
    <div class="row h-100 align-items-center justify-content-center reset-overlay g-0">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">

                {{-- LOGO --}}
                <div class="text-center mb-4">
                    <a href="/">
                        <img src="{{ asset('assets/img/migraciones.png') }}" alt="Logo" style="height: 65px;">
                    </a>
                    <h3 class="mt-3 text-white">Restablecer Contraseña</h3>
                </div>

                {{-- FORM --}}
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    {{-- EMAIL --}}
                    <div class="form-floating mb-3">
                        <input id="email" 
                               type="email" 
                               name="email"
                               value="{{ $email ?? old('email') }}"
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

                    {{-- PASSWORD --}}
                    <div class="form-floating mb-3">
                        <input id="password" 
                               type="password" 
                               name="password"
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Nueva contraseña"
                               required 
                               autocomplete="new-password">
                        <label for="password">Nueva contraseña</label>

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- CONFIRM PASSWORD --}}
                    <div class="form-floating mb-4">
                        <input id="password-confirm" 
                               type="password" 
                               name="password_confirmation"
                               class="form-control" 
                               placeholder="Confirmar contraseña"
                               required 
                               autocomplete="new-password">
                        <label for="password-confirm">Confirmar contraseña</label>
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-3">
                        Restablecer contraseña
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
