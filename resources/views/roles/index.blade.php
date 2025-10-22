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
            
            <div class="navbar-nav w-100">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Usuarios</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/users" class="dropdown-item">Usuarios</a>
                        <a href="/roles" class="dropdown-item">Roles</a>
                    </div>
                </div>
            
                <a href="/" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2 icolor"></i>PRINCIPAL</a>
                <a href="/soporte" class="nav-item nav-link"><i class="fa fa-laptop me-2 icolor"></i>DETALLE</a>
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
                            <input type="submit" class="dropdown-item" value="Cerrar sesion">
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Sale & Revenue Start -->
        <section class="content-header mx-4 my-4 mb-4">
            <h3 style="font-size: 22px;">Roles
                <small style="font-size: 16px;color: #777;">Administracion de roles</small>
            </h1>
        </section>

        <section class="container">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Todos los roles</h3>
                    <div class="box-tools">
                        <a href="{{route('roles.create')}}" class="btn btn-principal m-2">
                            <i class="fa fa-plus">Añadir</i>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="roles-table" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Fecha de creación</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sale & Revenue End -->

        <!-- Footer Start -->
        
        <!-- Footer End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let table = $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('roles.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        }
    });

    $('#refreshBtn').click(function() {
        table.ajax.reload(); // 🔄 actualiza sin recargar página
    });
</script>
@endsection
