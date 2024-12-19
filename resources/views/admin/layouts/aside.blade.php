<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto " id="kt_aside_logo">
        <!--begin::Logo-->
        <div class="aside-logo flex-column-auto d-flex align-items-center justify-content-center">
            <a href="{{route('index')}}" class="d-flex justify-content-center">
                {{-- @if ($configuracion->logotipo!="")
                    <img alt="Logo" src="{{$configuracion->logotipo}}"class="h-50px logo" />                    
                @else --}}
                    <img alt="Logo" src="/metronic8/demo1/assets/media/logos/default-dark.svg" width="80px" class="h-25px logo" /> 
                {{-- @endif --}}
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
                {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                        fill="currentColor" />
                                    <path
                                        d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                        fill="currentColor" />
                                    <path opacity="0.3"
                                        d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                        fill="currentColor" />
                                    <path opacity="0.3"
                                        d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Widgets</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a class="menu-link" href="../../demo1/dist/widgets/lists.html">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Lists</span>
                            </a>
                        </div>
                    </div>
                </div> --}}
                <div data-kt-menu-trigger="click" class="menu-item  menu-accordion mb-1">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
                            {{-- <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3"
                                        d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span> --}}
                            <i class="fas fa-briefcase"></i>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Gestión Administrativa</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        @can('listar condominios')
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('admin/condominios') || Request::is('admin/condominios/*') ? 'active' : '' }}"
                                    href="{{ route('index.condominio') }}">
                                    {{-- <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span> --}}
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-building"></i>
                                    </span>
                                    <span class="menu-title">Condominios</span>
                                </a>
                            </div>
                        @endcan
                        @can('ver unidades')
                            <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/unidades') || Request::is('admin/unidad/*') ? 'active' : '' }}"
                                href="{{ route('unidades.index') }}">

                                {{-- <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span> --}}
                                <span class="menu-icon">
                                    <i class="fa-solid fa-house-chimney"></i>
                                </span>
                                <span class="menu-title"> Unidades</span>
                            </a>
                        </div>
                        @endcan
                        
                        @can('listar contactos')
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('admin/contactos') || Request::is('admin/contactos/*') ? 'active' : '' }}"
                                    href="{{ route('index.contacto') }}">

                                    {{-- <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span> --}}
                                    <div class="menu-icon">
                                        <i class="fa-solid fa-address-book"></i>
                                    </div>
                                    <span class="menu-title">Contactos</span>
                                </a>
                            </div>
                        @endcan

                        @can('listar proveedores')
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('admin/proveedores') || Request::is('admin/proveedores/*') ? 'active' : '' }}"
                                    href="{{ route('proveedores.index') }}">
                                    {{-- <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span> --}}
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-users-rectangle"></i>
                                    </span>
                                    <span class="menu-title">Proveedores</span>
                                </a>
                            </div>
                        @endcan
                        {{-- <div class="menu-item">
                                <a class="menu-link"
                                    href="{{ route('proveedores.index') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-building-user"></i>
                                    </span>
                                    <span class="menu-title">Empleados</span>
                                </a>
                            </div> --}}

                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/ciudades') || Request::is('admin/ciudad/*') ? 'active' : '' }}"
                                href="{{ route('ciudades.index') }}">
                                {{-- <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span> --}}
                                <span class="menu-icon">
                                    <i class="fa-solid fa-city"></i>
                                </span>
                                <span class="menu-title"> Ciudades</span>
                            </a>
                        </div>

                        @can('listar directivos')
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('admin/directivo') || Request::is('admin/directivo/*') ? 'active' : '' }}"
                                    href="{{ route('directivo.index') }}">
                                    {{-- <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span> --}}
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </span>
                                    <span class="menu-title"> Directivos</span>
                                </a>
                            </div>
                        @endcan

                        @can('listar documentos')
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('admin/documento') || Request::is('admin/documento/*') ? 'active' : '' }}"
                                    href="{{ route('documento.index') }}">
                                    {{-- <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span> --}}
                                    <span class="menu-icon">
                                        <i class="fa-regular fa-folder-open"></i>
                                    </span>
                                    <span class="menu-title"> Documento</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item  menu-accordion mb-1">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
                            {{-- <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3"
                                        d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span> --}}
                            <i class="fas fa-cog"></i>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Configuraciones</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        @can('listar tipos de documentos')
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('admin/tipodocumento') || Request::is('admin/tipodocumento/*') ? 'active' : '' }}"
                                    href="{{ route('index.tipodocumento') }}">
                                    {{-- <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span> --}}
                                    <span class="menu-icon">
                                        <i class="fas fa-id-card"></i>
                                    </span>
                                    <span class="menu-title">Tipo Documento</span>
                                </a>
                            </div>
                        @endcan

                        @can('listar relaciones')
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('admin/relaciones') || Request::is('admin/relaciones/*') ? 'active' : '' }}"
                                    href="{{ route('index.relacion') }}">
                                    {{-- <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span> --}}
                                    <span class="menu-icon">
                                        <i class="fas fa-user-friends"></i>
                                    </span>
                                    <span class="menu-title">Relaciones</span>
                                </a>
                            </div>
                        @endcan
                        <!--configuracion-->
                           @can('ver configuraciones')
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::is('admin/configuraciones') || Request::is('admin/configuraciones/*') ? 'active' : '' }}"
                                        href="{{ route('index.configuracion') }}">
                                        {{-- <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span> --}}
                                            <span class="menu-icon">
                                                <i class="fas fa-cogs"></i>
                                            </span>
                                        </span>
                                        <span class="menu-title">Configuracion</span>
                                    </a>
                                </div>
                           @endcan
                    </div>
                </div>

                <!--envio notificacion-->
                <div data-kt-menu-trigger="click" class="menu-item  menu-accordion mb-1">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-bell"></i>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Notificaciones</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            @can('listar notificaciones por whatsapp')
                                <a class="menu-link {{ Request::is('admin/notificaciones/whatsapp') || Request::is('admin/notificaciones/whatsapp*') ? 'active' : '' }}"
                                    href="{{route('notificacion.whatsapp.index')}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Notificaciones por WhatsApp</span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item  menu-accordion mb-1">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
                            {{-- <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3"
                                        d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span> --}}
                            <i class="fa-solid fa-money-check-dollar"></i>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">Financiero</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        @can('listar cuentas')
                            <div class="menu-item">
                                <a class="menu-link {{ Request::is('admin/rubros') || Request::is('admin/rubro/*') ? 'active' : '' }}"
                                    href="{{ route('rubros.index') }}">
                                    {{-- <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span> --}}
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-sack-dollar"></i>
                                    </span>
                                    <span class="menu-title">Cuentas</span>
                                </a>
                            </div>
                        @endcan
                        <div class="menu-item">
                            <a class="menu-link {{ Request::is('admin/cajas') || Request::is('admin/caja/*') ? 'active' : '' }}"
                                href="{{ route('cajas.index') }}">
                                {{-- <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span> --}}
                                <span class="menu-icon">
                                    <i class="fa-solid fa-landmark"></i>
                                </span>
                                <span class="menu-title">Cajas o Bancos</span>
                            </a>
                        </div>
                    </div>
                </div>

                @can('listar ingresos')
                    <div class="menu-item">
                        <a class="menu-link {{ Str::is(['admin/ingresos'], request()->path()) ? 'active' : '' }}"
                            href="{{ route('ingresos.index') }}">
                            <span class="menu-icon">
                                <i class="far fa-money-bill-alt"></i>
                            </span>
                            <span class="menu-title">Ingresos</span>
                        </a>
                    </div>
                @endcan
                @can('listar egresos')
                    <div class="menu-item">
                        <a class="menu-link {{ Str::is(['admin/egresos'], request()->path()) ? 'active' : '' }}"
                            href="{{ route('egresos.index') }}">
                            <span class="menu-icon">
                                <i class="fas fa-hand-holding-usd"></i>
                            </span>
                            <span class="menu-title">Egresos</span>
                        </a>
                    </div>
                @endcan
                @role('Super-Admin')
                    <div data-kt-menu-trigger="click" class="menu-item  menu-accordion mb-1">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
                                {{-- <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3"
                                            d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span> --}}
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
                                    {{-- <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span> --}}
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <span class="menu-title">Usuarios</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ Str::is(['admin/roles'], request()->path()) ? 'active' : '' }}"
                                    href="{{ url('admin/roles') }}">
                                    {{-- <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span> --}}
                                    <span class="menu-icon">
                                        <i class="fas fa-user-tag"></i>
                                    </span>
                                    <span class="menu-title">Roles</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endrole
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    {{-- <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
        <a href="../../demo1/dist/documentation/getting-started.html" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
            <span class="btn-label">Docs &amp; Components</span>
            <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
            <span class="svg-icon btn-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="currentColor" />
                    <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
                    <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
                    <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </a>
    </div> --}}
    <!--end::Footer-->
</div>
<!--end::Aside-->
