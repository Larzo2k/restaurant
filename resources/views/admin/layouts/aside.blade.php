<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto " id="kt_aside_logo">
        <!--begin::Logo-->
        <div class="aside-logo flex-column-auto d-flex align-items-center justify-content-center">
            <a href="{{ route('index') }}" class="d-flex justify-content-center">
                @if ($configuracion->logotipo != '')
                    <img alt="Logo" src="{{ $configuracion->logotipo }}"class="h-50px logo" />
                @else
                    <img alt="Logo" src="{{ asset('/metronic/assets/media/logos/logo-2.svg') }}" width="80px"
                        class="h-25px logo" />
                @endif
            </a>
        </div>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('configuration') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-gear"></i>
                        </span>
                        <span class="menu-title">Configuración</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('clientes') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <span class="menu-title">Clientes</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('categorias') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-cubes"></i>
                        </span>
                        <span class="menu-title">categorias</span>
                    </a>
                </div>
                {{-- <div class="menu-item">
                    <a class="menu-link" href="{{ route('productos') }}">
                        <span class="menu-icon">
                            <i class="fa fa-cube"></i>
                        </span>
                        <span class="menu-title">Productos</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('daily_menus') }}">
                        <span class="menu-icon">
                            <i class="fa fa-shopping-bag"></i>
                        </span>
                        <span class="menu-title">Menu del dia</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('ventas') }}">
                        <span class="menu-icon">
                            <i class="fa fa-money-bill-alt"></i> <!-- Billete -->
                        </span>
                        <span class="menu-title">Venta</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('venta.history') }}">
                        <span class="menu-icon">
                            <i class="fa fa-money-bill-alt"></i> <!-- Billete -->
                        </span>
                        <span class="menu-title">Venta del dia</span>
                    </a>
                </div> --}}
                {{-- @role('Super-Admin') --}}
                    {{-- <div data-kt-menu-trigger="click" class="menu-item  menu-accordion mb-1">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="fas fa-user-cog"></i>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Gestión de usuarios</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <div class="menu-item">
                                <a class="menu-link {{ Str::is(['admin/usuarios'], request()->path()) ? 'active' : '' }}"
                                    href="{{ url('admin/usuarios') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <span class="menu-title">Usuarios</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Str::is(['admin/roles'], request()->path()) ? 'active' : '' }}"
                                    href="{{ url('admin/roles') }}">
                                    <span class="menu-icon">
                                        <i class="fas fa-user-tag"></i>
                                    </span>
                                    <span class="menu-title">Roles</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                {{-- @endrole --}}
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>

</div>
<!--end::Aside-->
