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
            <h3 style="font-size: 22px;">Usuarios
                <small style="font-size: 16px;color: #777;">Administracion de usuarios</small>
            </h1>
        </section>

        <section class="container">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Todos los usuarios</h3>
                    <div class="box-tools">
                        <a href="#" class="btn btn-principal m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fa fa-plus">Añadir</i>
                        </a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="users-table" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
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

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Rol</label>
                        <select name="rol" id="rol" class="form-control">
                            <option value="">Seleccionar</option>
                        </select>
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
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                    <input type="hidden" id="edit_id">

                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" id="edit_email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña (opcional)</label>
                        <input type="password" id="edit_password" class="form-control">
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

    let table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('users.data') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
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

    $(function(){
        $(".registrar").on('click',function () {
            let token = $('meta[name="csrf-token"]').attr('content');
            var nombre = $("#nombre").val();
            var apellidos = $("#apellidos").val();
            var name = nombre + " " + apellidos;
            var email = $("#email").val();
            var password = $("#password").val();

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
            if (apellidos == '') {
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
                title: "Los apellidos son requeridos"
                });
                $('#apellidos').focus();
                return false;
            }
            if (email == '') {
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
                title: "El email es requerido"
                });
                $('#email').focus();
                return false;
            }
            if (password == '') {
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
                title: "La contraseña es requerida"
                });
                $('#password').focus();
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
                url: "/adduser",
                method: "post",
                dataType: 'json',
                data: {
                    _token: token,
                    name: name,
                    email: email,
                    password: password
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

            // $.ajax({
            //     url: "/adduser",
            //     method: "post",
            //     dataType: 'json',
            //     data: {
            //         _token: token,
            //         name: name,
            //         email: email,
            //         password: password
            //     },
            //     success: function (response) {   
            //         if (response.status) {
            //             const Toast = Swal.mixin({
            //             toast: true,
            //             position: "top-end",
            //             showConfirmButton: false,
            //             timer: 3000,
            //             timerProgressBar: true,
            //             didOpen: (toast) => {
            //                 toast.onmouseenter = Swal.stopTimer;
            //                 toast.onmouseleave = Swal.resumeTimer;
            //             }
            //             });
            //             Toast.fire({
            //             icon: "success",
            //             title: response.msg
            //             });
            //             let modalElement = document.getElementById('staticBackdrop');
            //             let modalInstance = bootstrap.Modal.getInstance(modalElement);
            //             modalInstance.hide();
            //             table.ajax.reload();
            //             return false;                 
            //         } else {
            //             const Toast = Swal.mixin({
            //             toast: true,
            //             position: "top-end",
            //             showConfirmButton: false,
            //             timer: 3000,
            //             timerProgressBar: true,
            //             didOpen: (toast) => {
            //                 toast.onmouseenter = Swal.stopTimer;
            //                 toast.onmouseleave = Swal.resumeTimer;
            //             }
            //             });
            //             Toast.fire({
            //             icon: "error",
            //             title: response.msg
            //             });
            //             return false;
            //         }
            //     },
            //     error: function (response) {
            //         const Toast = Swal.mixin({
            //         toast: true,
            //         position: "top-end",
            //         showConfirmButton: false,
            //         timer: 3000,
            //         timerProgressBar: true,
            //         didOpen: (toast) => {
            //             toast.onmouseenter = Swal.stopTimer;
            //             toast.onmouseleave = Swal.resumeTimer;
            //         }
            //         });
            //         Toast.fire({
            //         icon: "error",
            //         title: response.msg
            //         });
            //         return false;
            //     }
            // });
        });
    }) 
</script>

<script>
    // Abrir modal y cargar usuario
    $(document).on('click', '.editar', function() {
        let id = $(this).data('id');
        
        $.get('/users/getUser/' + id, function(user) {
            $('#edit_id').val(user.id);
            $('#edit_name').val(user.name);
            $('#edit_email').val(user.email);
            $('#edit_password').val('');

            $('#modalEditar').modal('show');
        });
    });

    // Guardar cambios
    $('#formEditar').submit(function(e){
        e.preventDefault();

        let id = $('#edit_id').val();
        let data = {
            name: $('#edit_name').val(),
            email: $('#edit_email').val(),
            password: $('#edit_password').val(),
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

        $.post('/users/updateUser/' + id, data, function(response) {
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
                    url: "/users/deleteUser/" + id,
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
