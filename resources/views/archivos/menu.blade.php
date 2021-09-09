<div class="card">
    <div class="card-header">Menú</div>
    <div class="panel-body">
        @if(auth()->check())
                <div class="list-group">
                    <a href="/home" class="list-group-item @if(request()->is('home')) active @endif">Dashboard</a>
                    @if(!auth()->user()->is_client)
                        <a href="/list" class="list-group-item @if(request()->is('list')) active @endif">Ver incidencias</a>
                    @endif
                    <a href="/reportar" class="list-group-item @if(request()->is('reportar')) active @endif">Crear incidencias</a>
                    @if(auth()->user()->is_admin)
                        <a class="list-group-item nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administrador</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/usuario">Usuarios</a>
                                <a class="dropdown-item" href="/proyecto">Proyectos</a>
                                <a class="dropdown-item" href="/config">Configuración</a>
                            </div>
                    @endif
                </div>
        @else 
                <div class="list-group">
                    <a href="/" class="list-group-item @if(request()->is('/')) active @endif">Bienvenido</a>
                    <a href="/howto" class="list-group-item @if(request()->is('howto')) active @endif">Modo de uso</a>
                    <a href="/about-us" class="list-group-item @if(request()->is('about-us')) active @endif">Acerca de</a>
                </div>
        @endif
    </div>
</div>