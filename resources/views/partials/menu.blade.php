<!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-secondary navbar-dark">
            <a href="/" class="navbar-brand mx-4 mb-3">
                <img src="{{asset('assets/img/migraciones.png')}}" alt="" style="height: 60px;">
            </a>

            <div class="navbar-nav w-100">

         
            @if(
                auth()->user()->can('ver_3') ||
                auth()->user()->can('ver_4') ||
                auth()->user()->can('ver_5')
            )
            <div class="nav-item dropdown">
                <a href="#" 
                    class="nav-item nav-link dropdown-toggle 
                    {{ Request::is('users*') || Request::is('roles*') ? 'active' : '' }}" 
                    data-bs-toggle="dropdown">
                    <i class="fa fa-users me-2"></i>Configuración
                </a>

                <div class="dropdown-menu bg-transparent border-0 
                    {{ Request::is('users*') || Request::is('roles*') || Request::is('menus*') ? 'show' : '' }}">

                    {{-- DASHBOARD --}}
                    @can('ver_3')
                    <a href="/menus" 
                        class="dropdown-item {{ Request::is('menus*') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    @endcan

                    {{-- USUARIOS --}}
                    @can('ver_4')
                    <a href="/users" 
                        class="dropdown-item {{ Request::is('users*') ? 'active' : '' }}">
                        Usuarios
                    </a>
                    @endcan

                    {{-- ROLES --}}
                    @can('ver_5')
                    <a href="/roles" 
                        class="dropdown-item {{ Request::is('roles*') ? 'active' : '' }}">
                        Roles
                    </a>
                    @endcan

                </div>
            </div>
            @endif


            {{-- PRINCIPAL --}}
            @can('ver_6')
            <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2 icolor"></i>PRINCIPAL
            </a>
            @endcan

            {{-- DETALLE --}}
            @can('ver_7')
            <a href="/soporte" class="nav-item nav-link {{ Request::is('soporte') ? 'active' : '' }}">
                <i class="fa fa-laptop me-2 icolor"></i>DETALLE
            </a>
            @endcan

            {{-- ESPECIALISTA --}}
            @can('ver_8')
            <a href="/especialista" class="nav-item nav-link {{ Request::is('especialista') ? 'active' : '' }}">
                <i class="fa fa-th me-2 icolor"></i>ESPECIALISTA
            </a>
            @endcan

            {{-- LOCALIZACIÓN --}}
            @can('ver_9')
            <a href="/localizacion" class="nav-item nav-link {{ Request::is('localizacion') ? 'active' : '' }}">
                <i class="fa fa-map me-2 icolor"></i>LOCALIZACIÓN
            </a>
            @endcan

            {{-- INDICADOR --}}
            @can('ver_10')
            <a href="/indicador" class="nav-item nav-link {{ Request::is('indicador') ? 'active' : '' }}">
                <i class="fa fa-table me-2 icolor"></i>INDICADOR
            </a>
            @endcan

            {{-- TICKETS --}}
            @can('ver_11')
            <a href="/tickets" class="nav-item nav-link {{ Request::is('tickets') ? 'active' : '' }}">
                <i class="fa fa-chart-bar me-2 icolor"></i>TICKETS
            </a>
            @endcan

            {{-- KPI --}}
            @can('ver_12')
            <a href="/kpi" class="nav-item nav-link {{ Request::is('kpi') ? 'active' : '' }}">
                <i class="far fa-file-alt me-2 icolor"></i>KPI
            </a>
            @endcan

        </div>

            <!-- <div class="navbar-nav w-100">
                <div class="nav-item dropdown">
                    <a href="#" 
                        class="nav-item nav-link dropdown-toggle 
                        {{ Request::is('users*') || Request::is('roles*') ? 'active' : '' }}" 
                        data-bs-toggle="dropdown"
                        aria-expanded="{{ Request::is('users*') || Request::is('roles*') ? 'true' : 'false' }}">
                        <i class="fa fa-users me-2"></i>Configuración
                    </a>

                    <div class="dropdown-menu bg-transparent border-0 
                        {{ Request::is('users*') || Request::is('roles*') || Request::is('menus*') ? 'show' : '' }}">

                        <a href="/menus" 
                            class="dropdown-item {{ Request::is('menus*') ? 'active' : '' }}">
                            Dashboard
                        </a>
                        
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
                <a href="/soporte" class="nav-item nav-link {{ Request::is('soporte') ? 'active' : '' }}"><i class="fa fa-laptop me-2 icolor"></i>DETALLE</a>
                <a href="/especialista" class="nav-item nav-link {{ Request::is('especialista') ? 'active' : '' }}"><i class="fa fa-th me-2 icolor"></i>ESPECIALISTA</a>
                <a href="/localizacion" class="nav-item nav-link {{ Request::is('localizacion') ? 'active' : '' }}"><i class="fa fa-keyboard me-2 icolor"></i>LOCALIZACIÓN</a>
                <a href="/indicador" class="nav-item nav-link {{ Request::is('indicador') ? 'active' : '' }}"><i class="fa fa-table me-2 icolor"></i>INDICADOR</a>
                <a href="/tickets" class="nav-item nav-link {{ Request::is('tickets') ? 'active' : '' }}"><i class="fa fa-chart-bar me-2 icolor"></i>TICKETS</a>
                <a href="/kpi" class="nav-item nav-link {{ Request::is('kpi') ? 'active' : '' }}"><i class="far fa-file-alt me-2 icolor"></i>KPI</a>
            
            </div> -->
        </nav>
    </div>
<!-- Sidebar End -->