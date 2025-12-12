@extends('layouts.app')

<style>
    html, body {
        height: 100%;
    }

    /* CONTENEDOR PRINCIPAL */
    .login-wrapper {
        min-height: 100vh;
        width: 100%;
        display: flex;
    }

    /* PANEL IZQUIERDO AZUL */
    .login-left {
        width: 35%;
        min-height: 100vh;
        background-color: #094780 ; /* Azul institucional */
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    /* LINEA DIVISORIA CELESTE */
    .login-divider {
        width: 6px;
        background: linear-gradient(to bottom, #0ea5e9, #0ea5e9);
    }
    .login-divider1 {
        width: 6px;
        background: linear-gradient(to bottom, #094780, #094780);
    }

    /* IMAGEN DERECHA */
    .login-right {
        width: 65%;
        min-height: 100vh;
        background-image: url("{{ asset('assets/img/migraciones-fondo.jpeg') }}");
        background-size: cover;
        background-position: center;
        position: relative;
    }

    /* OVERLAY SOBRE IMAGEN */
    .login-right::after {
        content: "";
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.45);
    }

    /* TARJETA LOGIN */
    .login-card {
        width: 90%;
        max-width: 400px;
        z-index: 10;
        background: #252525;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .login-left {
            width: 100%;
        }

        .login-divider,
        .login-right {
            display: none;
        }
    }
</style>

@section('content')

<div class="login-wrapper">

    <!-- PANEL IZQUIERDO -->
    <div class="login-left">
        <div class="login-card bg-secondary rounded p-4 p-sm-5">

            <!-- LOGO -->
            <div class="text-center mb-4">
                <img src="{{ asset('assets/img/migraciones.png') }}" style="height: 90px;">
            </div>

            <!-- FORMULARIO -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- TOKEN reCAPTCHA v3 -->
                <input type="hidden" name="recaptcha_token" id="recaptcha_token">

                <div class="form-floating mb-3">
                    <input id="email" name="email"
                        value="{{ old('email') }}"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="name@example.com" required>
                    <label>Email</label>
                </div>

                <div class="form-floating mb-4">
                    <input id="password" name="password"
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" required>
                    <label>Password</label>
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <div class="form-check text-white">
                        <input type="checkbox" class="form-check-input" name="remember">
                        <label class="form-check-label">Recordar</label>
                    </div>
                </div>

                <button class="btn btn-primary w-100 py-3 mb-3">
                    Iniciar Sesión
                </button>

                <a href="{{ route('password.request') }}" class="text-center d-block text-info">
                    ¿Olvidaste tu contraseña?
                </a>
            </form>
        </div>
    </div>

    <!-- LINEA DIVISORIA -->
    <div class="login-divider"></div>
    <div class="login-divider1"></div>

    <!-- IMAGEN DERECHA -->
    <div class="login-right"></div>

</div>

<!-- SCRIPT DE GOOGLE reCAPTCHA v3 -->
<script src="https://www.google.com/recaptcha/api.js?render={{ env('NOCAPTCHA_SITEKEY') }}"></script>

<script>
grecaptcha.ready(function () {
    grecaptcha.execute('{{ env('NOCAPTCHA_SITEKEY') }}', {action: 'login'}).then(function (token) {
        document.getElementById('recaptcha_token').value = token;
    });
});
</script>

@endsection
