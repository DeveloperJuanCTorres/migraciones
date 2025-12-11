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
            <h3 style="font-size: 22px;">
                <i class="fas fa-user "></i> Editar perfil
            </h1>
        </section>

        <section class="container">
            <div class="box box-primary">               
                <div class="box-header">
                    <!-- <h3 class="box-title">Todos los usuarios</h3> -->
                    <div class="box-tools">
                        <button type="submit" class="btn btn-principal m-2 actualizar">
                            Guardar
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row mt-4">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" readonly value="{{ auth()->user()->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password">
                                <span>Dejar vacío para mantener el mismo</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <img id="preview" src="{{ auth()->user()->image ? asset('storage/perfiles/' . auth()->user()->image) : '#' }}" class="m-auto" alt="Vista previa de imagen" style="width: 100%; display: block; border: 1px solid #ccc; padding: 5px;" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Seleccionar imagen</label>
                                <input type="file" accept="image/*" class="form-control" id="image" onchange="mostrarImagen(event)">
                            </div>
                        </div>
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

<script>
    const perfilUpdateUrl = "{{ route('perfil.update') }}";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function mostrarImagen(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function(){
        $(".actualizar").on('click',function () {
            let token = $('meta[name="csrf-token"]').attr('content');
            let formData = new FormData();

            formData.append("_token", token);
            formData.append("name", $("#name").val());
            formData.append("email", $("#email").val());
            formData.append("password", $("#password").val());

            // Adjuntar archivo si se seleccionó
            let fileInput = $('#image')[0];
            if (fileInput.files.length > 0) {
                formData.append("image", fileInput.files[0]);
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
                url: perfilUpdateUrl,
                method: "post",
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
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

@endsection
