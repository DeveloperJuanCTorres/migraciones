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
                    <h6 class="mb-0">Auth::user()->name</h6>
                    <span>Admin</span>
                </div>
            </div> -->
            <div class="navbar-nav w-100">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-item nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>USUARIOS</a>
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
    <div class="content content-wrapper">
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
                        <a href="/perfil" class="dropdown-item">Perfil</a>
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
<!-- <script>
    let token = $('meta[name="csrf-token"]').attr('content');
    $(function(){
        $(".registrar").on('click',function () {
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
</script> -->
@endpush

@endsection
