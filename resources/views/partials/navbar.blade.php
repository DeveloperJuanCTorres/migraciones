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
                        <input type="submit" class="dropdown-item" value="Cerrar sesion">
                    </form>
                </div>
            </div>
        </div>
    </nav>
<!-- Navbar End -->