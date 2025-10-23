@extends('layouts.app')

@section('content')

<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-secondary navbar-dark">
            <a href="index.html" class="navbar-brand mx-4 mb-3">
            <img src="{{asset('assets/img/migraciones.png')}}" alt="" style="height: 60px;">
                <!-- <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3> -->
            </a>
            <!-- <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="{{asset('assets/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">{{Auth::user()->name}}</h6>
                    <span>Admin</span>
                </div>
            </div> -->
            <div class="navbar-nav w-100">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>USUARIOS</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/users" class="dropdown-item">Usuarios</a>
                        <a href="/roles" class="dropdown-item">Roles</a>
                    </div>
                </div>
                <a href="/" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2 icolor"></i>PRINCIPAL</a>
                <a href="/soporte" class="nav-item nav-link active"><i class="fa fa-laptop me-2 icolor"></i>DETALLE</a>
                <a href="/especialista" class="nav-item nav-link"><i class="fa fa-th me-2 icolor"></i>ESPECIALISTA</a>
                <a href="/localizacion" class="nav-item nav-link"><i class="fa fa-keyboard me-2 icolor"></i>LOCALIZACIÓN</a>
                <a href="/indicador" class="nav-item nav-link"><i class="fa fa-table me-2 icolor"></i>INDICADOR</a>
                <a href="/tickets" class="nav-item nav-link"><i class="fa fa-chart-bar me-2 icolor"></i>TICKETS</a>
                <a href="/kpi" class="nav-item nav-link"><i class="far fa-file-alt me-2 icolor"></i>KPI</a>
            
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
            <a href="/" class="navbar-brand d-flex d-lg-none me-4">
                <img src="{{asset('assets/img/migraciones-min.png')}}" alt="" style="height: 60px;">
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <div class="navbar-nav align-items-center ms-auto">
                
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-2" src="{{asset('storage/perfiles/'. auth()->user()->image)}}" alt="" style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex">{{Auth::user()->name}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <a href="#" class="dropdown-item">Perfil</a>
                        <a href="#" class="dropdown-item">Configuración</a>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <input style="color: white;" type="submit" class="dropdown-item" value="Cerrar sesion">
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Sale & Revenue Start -->
        <div class="destock">
            <div class="m-0" id="reportContainer" style="height: 100vh; min-height: 880px; max-height: 1200px;"></div>
        </div>

        <div class="mobil">
            <div class="m-0" id="reportContainerMobil" style="height: 1200px;"></div>
        </div>
        <!-- Sale & Revenue End -->
    </div>
    <!-- Content End -->

</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/powerbi-client@2.19.1/dist/powerbi.min.js"></script>
    <script>
        const models = window['powerbi-client'].models;

        const embedConfig = {
            type: 'report',
            id: '{{ $reportId }}',
            embedUrl: '{{ $embedUrl }}',
            accessToken: '{{ $embedToken }}',
            tokenType: models.TokenType.Embed,
            settings: {
                panes: {
                    filters: { visible: false },
                    pageNavigation: { visible: true }
                }
            }
        };

        const reportContainer = document.getElementById('reportContainer');
        powerbi.embed(reportContainer, embedConfig);
    </script>

    <script>
        const modelsMobil = window['powerbi-client'].models;

        const embedConfigMobil = {
            type: 'report',
            id: '{{ $reportIdMobil }}',
            embedUrl: '{{ $embedUrlMobil }}',
            accessToken: '{{ $embedTokenMobil }}',
            tokenType: models.TokenType.Embed,
            settings: {
                panes: {
                    filters: { visible: false },
                    pageNavigation: { visible: true }
                }
            }
        };

        const reportContainerMobil = document.getElementById('reportContainerMobil');
        powerbi.embed(reportContainerMobil, embedConfigMobil);
    </script>
@endpush

@endsection
