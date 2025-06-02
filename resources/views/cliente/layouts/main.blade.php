<!DOCTYPE html>
<html lang="es">

<head>
    <base href="/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $configuracion->name ?: 'Condominio Onix' }}</title>
    <meta name="description" content="Sistema de gestión de condominios">
    <meta name="keywords" content="Condominio, Gestión, Sistema, Bolivia">
    <meta name="author" content="Desarrollamelo">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="Sistema de Gestión de Condominios">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:locale" content="es_ES">
    <meta property="og:site_name" content="Sistema de Gestión de Condominios">
    <meta property="og:image" content="{{ asset($configuracion->logotipo) }}">

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Estilos globales --}}
    @include('admin.layouts.styles')
</head>

<body id="kt_body" class="header-fixed aside-fixed" style="--kt-toolbar-height:55px;">
    {{-- @include('cliente.layouts.navbar') --}}
    {{-- Loader al iniciar --}}
    <div id="loading" class="page-loader flex-column" style="background-color:rgba(0,0,0,0.39); z-index:1060;">
        <span class="spinner-border text-primary" role="status"></span>
        <span class="text-muted fs-6 fw-semibold mt-5"
              style="padding: 5px; border-radius: 30px; background:black; color:white;">
            Cargando...
        </span>
    </div>

    <div class="page-loader flex-column" id="loadingAnimated"
    style="display: none; background-color:rgba(0,0,0,0.39); justify-content: center; align-items: center; flex-flow: column; z-index: 1060; position: fixed; top: 0; left: 0; width: 100%; height: 100%;">
        
        <!-- Aquí irá la animación SVG -->
        <div id="lottieLoader" style="width: 500px; height: 500px;"></div>

        <!-- Texto opcional debajo -->
        <span class="text-muted fs-6 fw-semibold mt-5"
            style="padding: 5px; border-radius: 30px 30px; background-color:black; color: white;">
            Cargando...
        </span>
    </div>

    {{-- Comienza estructura principal --}}
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">

            {{-- Contenedor principal --}}
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                {{-- Encabezado --}}
                <header id="kt_header" class="header align-items-stretch">
                    <div class="container-fluid d-flex justify-content-between align-items-stretch">

                        {{-- Logo móvil --}}
                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                            <a href="{{ route('index') }}" class="d-lg-none">
                                <img src="{{ $configuracion->logotipo ?: '/metronic/assets/media/logos/logo-2.svg' }}"
                                     alt="Logo" class="h-30px">
                            </a>
                        </div>

                        {{-- Botón menú móvil --}}
                        <div class="d-flex align-items-center d-lg-none ms-n2 me-2">
                            <button class="btn btn-icon btn-active-light-primary" id="kt_aside_mobile_toggle">
                                <i class="bi bi-list"></i>
                            </button>
                        </div>

                        {{-- Menú y usuario --}}
                        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                            {{-- Menú superior (puedes incluirlo aquí si deseas) --}}
                            <nav class="d-flex align-items-stretch" id="kt_header_nav">
                                @include('cliente.layouts.menu-top')
                            </nav>

                            {{-- Menú usuario --}}
                            <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                                     data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <img src="/metronic/assets/media/avatars/300-1.jpg" alt="user">
                                </div>

                                {{-- Dropdown de usuario --}}
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                     data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <div class="symbol symbol-50px me-5">
                                                <img src="/metronic/assets/media/avatars/300-1.jpg" alt="user">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bolder fs-5">
                                                    {{ Auth::user()->name ?? 'Usuario' }}
                                                    <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span>
                                                </div>
                                                <a href="#" class="fw-bold text-muted text-hover-primary fs-7">
                                                    {{ Auth::user()->email ?? '' }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="separator my-2"></div>

                                    <div class="menu-item px-5">
                                        <a href="#" class="menu-link px-5">Mi Perfil</a>
                                    </div>

                                    <div class="separator my-2"></div>

                                    <div class="menu-item px-5">
                                        <a href="{{ route('cliente.logout') }}" class="menu-link px-5">Cerrar sesión</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                {{-- Toolbar (puedes agregar títulos de sección, botones, etc.) --}}
                @yield('toolbar')

                {{-- Contenido principal --}}
                <main class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <section class="post d-flex flex-column-fluid" id="kt_post">
                        <div class="container-xxl" id="kt_content_container">
                            @yield('content')
                        </div>
                    </section>
                </main>

                {{-- Pie de página --}}
                <footer class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <span class="text-muted fw-semibold me-1">© {{ date('Y') }} Condominio Onix</span>
                        <a href="#" class="text-muted text-hover-primary fw-bold">Desarrollado por Desarrollamelo</a>
                    </div>
                </footer>

            </div>
        </div>
    </div>

    {{-- Scripts globales --}}
    @include('admin.layouts.scripts')
    @stack('scripts')

</body>
</html>
