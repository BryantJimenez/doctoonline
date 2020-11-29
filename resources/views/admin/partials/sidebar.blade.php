<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{ image_exist('/admins/img/', 'logoadmin.png', false, false) }}" width="90" height="90" alt="logo">
                <h6 class="">Doctoonline</h6>
                <p class="">Sistema de Gestión</p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ active('admin') }}">
                <a href="{{ route('admin') }}" aria-expanded="{{ menu_expanded('admin') }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> Inicio</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/administradores', 0) }}">
                <a href="{{ route('administradores.index') }}" aria-expanded="{{ menu_expanded('admin/administradores', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-user-tie"></i> Administradores</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/pacientes', 0) }}">
                <a href="{{ route('pacientes.index') }}" aria-expanded="{{ menu_expanded('admin/pacientes', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-user-injured"></i> Pacientes</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/medicos', 0) }}">
                <a href="{{ route('medicos.index') }}" aria-expanded="{{ menu_expanded('admin/medicos', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-user-md"></i> Médicos</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/informes', 0) }}">
                <a href="{{ route('informes.index') }}" aria-expanded="{{ menu_expanded('admin/informes', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-file-medical"></i> Informes</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/banners', 0) }}">
                <a href="{{ route('banners.index') }}" aria-expanded="{{ menu_expanded('admin/banners', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-image"></i> Banners</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/categorias', 0) }}">
                <a href="{{ route('categorias.index') }}" aria-expanded="{{ menu_expanded('admin/categorias', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fab fa-dropbox"></i> Categorías</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/noticias', 0) }}">
                <a href="{{ route('noticias.index') }}" aria-expanded="{{ menu_expanded('admin/noticias', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-newspaper"></i> Noticias</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/servicios', 0) }}">
                <a href="{{ route('servicios.index') }}" aria-expanded="{{ menu_expanded('admin/servicios', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-shopping-cart"></i> Servicios</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/farmacias', 0) }}">
                <a href="{{ route('farmacias.index') }}" aria-expanded="{{ menu_expanded('admin/farmacias', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-pills"></i> Farmacias</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/convenios', 0) }}">
                <a href="{{ route('convenios.index') }}" aria-expanded="{{ menu_expanded('admin/convenios', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-link"></i> Convenios</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active(['admin/categoria-agenda', 'admin/subcategorias-agenda'], 0) }}">
                <a href="#diaryExams" data-toggle="collapse" aria-expanded="{{ menu_expanded(['admin/categoria-agenda', 'admin/subcategorias-agenda'], 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-hospital"></i> Examenes de Agenda</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu(['admin/categoria-agenda', 'admin/subcategorias-agenda'], 0) }} }}" id="diaryExams" data-parent="#accordionExample">
                    <li {{ submenu('admin/categoria-agenda') }}>
                        <a href="{{ route('categorias.agenda.index') }}"> Categorías</a>
                    </li>
                    <li {{ submenu('admin/subcategorias-agenda') }}>
                        <a href="{{ route('subcategorias.agenda.index') }}"> Subcategorías</a>
                    </li>
                </ul>
            </li>

            <li class="menu {{ active('admin/reservas', 0) }}">
                <a href="{{ route('reservas.index') }}" aria-expanded="{{ menu_expanded('admin/reservas', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-calendar"></i> Reservas</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active('admin/bolsa-de-trabajo', 0) }}">
                <a href="{{ route('solicitudes.index') }}" aria-expanded="{{ menu_expanded('admin/bolsa-de-trabajo', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-briefcase"></i> Bolsa de Trabajo</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ active(['admin/especialidades', 'admin/aseguradoras', 'admin/profesiones', 'admin/categoria-examenes', 'admin/subcategorias', 'admin/examenes', 'admin/enfermedades', 'admin/operaciones', 'admin/medico-agenda', 'admin/regiones', 'admin/provincias', 'admin/comunas', 'admin/quienes-somos', 'admin/contactos', 'admin/terminos'], 0) }}">
                <a href="#cog" data-toggle="collapse" aria-expanded="{{ menu_expanded(['admin/especialidades', 'admin/aseguradoras', 'admin/profesiones', 'admin/categoria-examenes', 'admin/subcategorias', 'admin/examenes', 'admin/enfermedades', 'admin/operaciones', 'admin/medico-agenda', 'admin/regiones', 'admin/provincias', 'admin/comunas', 'admin/quienes-somos', 'admin/contactos', 'admin/terminos'], 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-cogs"></i> Ajustes</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu(['admin/especialidades', 'admin/aseguradoras', 'admin/profesiones', 'admin/categoria-examenes', 'admin/subcategorias', 'admin/examenes', 'admin/enfermedades', 'admin/operaciones', 'admin/medico-agenda', 'admin/regiones', 'admin/provincias', 'admin/comunas', 'admin/quienes-somos', 'admin/contactos', 'admin/terminos'], 0) }} }}" id="cog" data-parent="#accordionExample">
                    <li {{ submenu('admin/especialidades') }}>
                        <a href="{{ route('especialidades.index') }}"> Especialidades</a>
                    </li>
                    <li {{ submenu('admin/aseguradoras') }}>
                        <a href="{{ route('aseguradoras.index') }}"> Aseguradoras de Salud</a>
                    </li>
                    <li {{ submenu('admin/profesiones') }}>
                        <a href="{{ route('profesiones.index') }}"> Profesiones</a>
                    </li>
                    <li {{ submenu('admin/categoria-examenes') }}>
                        <a href="{{ route('categorias.examenes.index') }}"> Categorías de Examen</a>
                    </li>
                    <li {{ submenu('admin/subcategorias') }}>
                        <a href="{{ route('subcategorias.index') }}"> Subcategorías de Examen</a>
                    </li>
                    <li {{ submenu('admin/examenes') }}>
                        <a href="{{ route('examenes.index') }}"> Examenes</a>
                    </li>
                    <li {{ submenu('admin/enfermedades') }}>
                        <a href="{{ route('enfermedades.index') }}"> Enfermedades</a>
                    </li>
                    <li {{ submenu('admin/operaciones') }}>
                        <a href="{{ route('operaciones.index') }}"> Operaciones Quirurgicas</a>
                    </li>
                    <li {{ submenu('admin/medico-agenda') }}>
                        <a href="{{ route('medicos.agenda.index') }}"> Médicos de Agenda</a>
                    </li>
                    <li {{ submenu('admin/regiones') }}>
                        <a href="{{ route('regiones.index') }}"> Regiones</a>
                    </li>
                    <li {{ submenu('admin/provincias') }}>
                        <a href="{{ route('provincias.index') }}"> Provincias</a>
                    </li>
                    <li {{ submenu('admin/comunas') }}>
                        <a href="{{ route('comunas.index') }}"> Comunas</a>
                    </li>
                    <li {{ submenu('admin/quienes-somos') }}>
                        <a href="{{ route('nosotros.edit') }}"> Quienes Somos</a>
                    </li>
                    <li {{ submenu('admin/contactos') }}>
                        <a href="{{ route('contactos.edit') }}"> Contactos</a>
                    </li>
                    <li {{ submenu('admin/terminos') }}>
                        <a href="{{ route('terminos.edit') }}"> Términos y Condiciones</a>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>

</div>