<!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-secondary navbar-dark">
            <a href="index.html" class="navbar-brand mx-4 mb-3">
            <img src="{{asset('assets/img/migraciones.png')}}" alt="" style="height: 60px;">
            </a>
            <div class="navbar-nav w-100">
                <div class="nav-item dropdown">
                    <a href="#" 
                        class="nav-item nav-link dropdown-toggle 
                        {{ Request::is('users*') || Request::is('roles*') ? 'active' : '' }}" 
                        data-bs-toggle="dropdown"
                        aria-expanded="{{ Request::is('users*') || Request::is('roles*') ? 'true' : 'false' }}">
                        <i class="fa fa-users me-2"></i>USUARIOS
                    </a>

                    <div class="dropdown-menu bg-transparent border-0 
                        {{ Request::is('users*') || Request::is('roles*') ? 'show' : '' }}">
                        
                        <a href="/users" 
                            class="dropdown-item {{ Request::is('users*') ? 'active' : '' }}">
                            Usuarios
                        </a>

                        <a href="/roles" 
                            class="dropdown-item {{ Request::is('roles*') ? 'active' : '' }}">
                            Roles
                        </a>

                    </div>
                </div>
                <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2 icolor"></i>PRINCIPAL</a>
                <a href="/soporte" class="nav-item nav-link {{ Request::is('/soporte') ? 'active' : '' }}"><i class="fa fa-laptop me-2 icolor"></i>DETALLE</a>
                <a href="/especialista" class="nav-item nav-link {{ Request::is('/especialista') ? 'active' : '' }}"><i class="fa fa-th me-2 icolor"></i>ESPECIALISTA</a>
                <a href="/localizacion" class="nav-item nav-link {{ Request::is('/localizacion') ? 'active' : '' }}"><i class="fa fa-keyboard me-2 icolor"></i>LOCALIZACIÓN</a>
                <a href="/indicador" class="nav-item nav-link {{ Request::is('/indicador') ? 'active' : '' }}"><i class="fa fa-table me-2 icolor"></i>INDICADOR</a>
                <a href="/tickets" class="nav-item nav-link {{ Request::is('/tickets') ? 'active' : '' }}"><i class="fa fa-chart-bar me-2 icolor"></i>TICKETS</a>
                <a href="/kpi" class="nav-item nav-link {{ Request::is('/kpi') ? 'active' : '' }}"><i class="far fa-file-alt me-2 icolor"></i>KPI</a>
            
            </div>
        </nav>
    </div>
<!-- Sidebar End -->