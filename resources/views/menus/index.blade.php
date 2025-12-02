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
    <div class="content content-wrapper">
        
        @include('partials.navbar')


        <!-- Sale & Revenue Start -->
        <section class="content-header mx-4 my-2 mb-4">
            <h3 style="font-size: 22px;">Menú
                <small style="font-size: 16px;color: #777;">Administracion de Dashboards</small>
            </h1>
        </section>

        <section class="container">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Todos los dashboard</h3>
                    <div class="box-tools">
                        <a href="#" class="btn btn-principal m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fa fa-plus">Añadir</i>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="menus-table" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">ReportId Destock</th>
                                    <th scope="col">ReportId Movil</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sale & Revenue End -->

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar deshboard</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombreLabel" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombreLabel" class="form-label">Tipo</label>
                                <select class="form-control" id="tipo">
                                    <option value="dashboard">Dashboard</option>
                                    <option value="sistema">Sistema</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="repotIdDestockLabel" class="form-label">ReportId Destock</label>
                                <input type="text" class="form-control" id="report_id_destock">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="reportIdMovilLabel" class="form-label">ReportId Movil</label>
                                <input type="text" class="form-control" id="report_id_movil">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-principal registrar">Registrar</button>
                </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->

        <!-- MODAL EDITAR -->
         <div class="modal fade" id="modalEditar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                <form id="formEditar">
                    @csrf
                    <div class="modal-header">
                    <h5 class="modal-title">Editar Dashboard</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                    <input type="hidden" id="edit_id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Nombre</label>
                                <input type="text" id="edit_nombre" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Tipo</label>
                                <select class="form-control" id="edit_tipo">
                                    <option value="dashboard">Dashboard</option>
                                    <option value="sistema">Sistema</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>ReportId Destock</label>
                                <input type="text" id="edit_report_id_destock" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label>ReportId Movil</label>
                                <input type="text" id="edit_report_id_movil" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-principal">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!-- FIN MODAL EDITAR -->

        <!-- Footer Start -->
        
        <!-- Footer End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    let table = $('#menus-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('menus.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nombre', name: 'nombre' },
            { data: 'tipo', name: 'tipo' },
            { data: 'report_id_destock', name: 'report_id_destock' },
            { data: 'report_id_movil', name: 'report_id_movil' },
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

    $(function(){
        $(".registrar").on('click',function () {
            let token = $('meta[name="csrf-token"]').attr('content');
            var nombre = $("#nombre").val();
            var tipo = $("#tipo").val();
            var report_id_destock = $("#report_id_destock").val();
            var report_id_movil = $("#report_id_movil").val();

            if (nombre == '') {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "warning",
                title: "El nombre es requerido"
                });
                $('#nombre').focus();
                return false;
            }
            if (report_id_destock == '') {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "warning",
                title: "El ReportId Destock es requerido"
                });
                $('#report_id_destock').focus();
                return false;
            }
            if (report_id_movil == '') {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "warning",
                title: "El ReportId Movil es requerido"
                });
                $('#report_id_movil').focus();
                return false;
            }

            Swal.fire({
                header: '...',
                title: 'loading...',
                allowOutsideClick:false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: "/addmenu",
                method: "post",
                dataType: 'json',
                data: {
                    _token: token,
                    nombre: nombre,
                    tipo: tipo,
                    report_id_destock: report_id_destock,
                    report_id_movil: report_id_movil
                },
                success: function (response) {   
                    if (response.status) {
                        const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "success",
                        title: response.msg
                        });
                        let modalElement = document.getElementById('staticBackdrop');
                        let modalInstance = bootstrap.Modal.getInstance(modalElement);
                        modalInstance.hide();
                        table.ajax.reload();
                        return false;                 
                    } else {
                        const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "error",
                        title: response.msg
                        });
                        return false;
                    }
                },
                error: function (response) {
                    const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                    });
                    Toast.fire({
                    icon: "error",
                    title: response.msg
                    });
                    return false;
                }
            });
        });
    })
</script>

<script>
   $(function(){
        $(".eliminar").on('click',function () {
            let token = $('meta[name="csrf-token"]').attr('content');
            const boton = document.getElementById("delet");
            const dataId = boton.getAttribute("data-id");
            
           
            // Swal.fire({
            //     header: '...',
            //     title: 'loading...',
            //     allowOutsideClick:false,
            //     didOpen: () => {
            //         Swal.showLoading()
            //     }
            // });

            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "success",
            title: dataId
            });
            let modalElement = document.getElementById('staticBackdrop');
            let modalInstance = bootstrap.Modal.getInstance(modalElement);            
        });
    }) 
</script>

<script>
    // Abrir modal y cargar usuario
    $(document).on('click', '.editar', function() {
        let id = $(this).data('id');
        
        $.get('/menus/getMenu/' + id, function(menu) {
            $('#edit_id').val(menu.id);
            $('#edit_nombre').val(menu.nombre);
            $('#edit_tipo').val(menu.tipo);
            $('#edit_report_id_destock').val(menu.report_id_destock);
            $('#edit_report_id_movil').val(menu.report_id_movil);

            $('#modalEditar').modal('show');
        });
    });

    // Guardar cambios
    $('#formEditar').submit(function(e){
        e.preventDefault();

        let id = $('#edit_id').val();
        let data = {
            nombre: $('#edit_nombre').val(),
            tipo: $('#edit_tipo').val(),
            report_id_destock: $('#edit_report_id_destock').val(),
            report_id_movil: $('#edit_report_id_movil').val(),
            _token: $('input[name="_token"]').val()
        };

        Swal.fire({
            header: '...',
            title: 'loading...',
            allowOutsideClick:false,
            didOpen: () => {
                Swal.showLoading()
            }
        });

        $.post('/menus/updateMenu/' + id, data, function(response) {
            if(response.status) {
                $('#modalEditar').modal('hide');

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                icon: "success",
                title: response.msg
                });
                table.ajax.reload();
                return false;  
            } else {
                alert('Error: ' + response.msg);
            }
        });
    });
</script>

<script>
    // Eliminar usuario
    $(document).on('click', '.eliminar', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    url: "/menus/deleteMenu/" + id,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if(response.status) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                            icon: "success",
                            title: response.msg
                            });
                            table.ajax.reload();
                            return false; 
                        } else {
                            Swal.fire('Error', response.msg, 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'No se pudo eliminar', 'error');
                    }
                });

            }
        });
    });
</script>

@endpush

@endsection
