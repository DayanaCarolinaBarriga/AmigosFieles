<div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
       aria-label="Open user menu">
        <span class="avatar avatar-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="12" cy="12" r="9" />
                <circle cx="12" cy="10" r="3" />
                <path d="M6.75 18a8.5 8.5 0 0 1 10.5 0" />
            </svg>
        </span>
        <div class="d-none d-xl-block ps-2">
            <div>{{ Auth()->user()->name }}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <!-- Enlace a la vista show del usuario autenticado -->
        <a href="{{ route('users.show', Auth()->user()->id) }}" class="dropdown-item">Perfil</a>
        <!-- Enlace a la vista edit del usuario autenticado -->
        <a href="{{ route('users.edit', Auth()->user()->id) }}" class="dropdown-item">Configuración</a>
        <div class="dropdown-divider"></div>
        <!-- Botón de logout -->
        <a class="dropdown-item"
           href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-fw fa-power-off text-red"></i>
            Cerrar Sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
