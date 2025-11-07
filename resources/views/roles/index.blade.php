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


    @include('partials.menu')


    <!-- Content Start -->
    <div class="content">
        
        @include('partials.navbar')


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
    </div>
    <!-- Content End -->


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
