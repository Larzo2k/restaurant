<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/">
    {{-- @if ($configuracion->nombre !== '')
        <title>{{ $configuracion->nombre }}</title>
    @else --}}
        <title>Sistema restaurante</title>
    {{-- @endif --}}

    <meta charset="utf-8" />
    <meta name="description"
        content="Sistema de gestion de condominios" />
    <meta name="keywords"
        content="Sistema de gestion de condominios" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{asset($configuracion->logotipo)}}">
    <meta property="og:type" content="website" />
    <meta property="og:title"
        content="Sistema de gestion de condominios" />
    <meta property="og:url" content="<?php URL()?>" />
    <meta property="og:site_name" content="Sistema de Gestión de Condominios" />
    <meta name="author" content="Desarrollamelo" />
    @include('admin.layouts.styles')
</head>

<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root" id="kt_app_root">

        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px p-10">

                        <form class="form w-100"  action="{{ route('cliente.login.post') }}"  method="POST">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">
                                    Inicio de sesión
                                </h1>
                                <h3 class="text-dark fw-bolder mb-3">
                                    PROPIETARIO
                                </h3>

                            </div>

                            <div class="fv-row mb-8">
                                <input type="email" placeholder="Email" name="email"  
                                    class="form-control bg-transparent" value="{{ old('email') }}" required />
                            </div>

                            <div class="fv-row mb-5 position-relative">
                                <input type="password" id="passwordField" placeholder="Password" name="password"
                                    class="form-control bg-transparent" required />
                                <i id="togglePassword"
                                    class="fas fa-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3 cursor-pointer"></i>
                            </div>

                            @error('error')
                                <div class="fv-row mb-5">
                                    <div class="alert alert-danger d-flex justify-content-center align-items-center"
                                        role="alert">
                                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <div>
                                            {{ $message }}
                                        </div>
                                    </div>
                                </div>
                            @enderror


                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">

                                    <span class="indicator-label">
                                        Iniciar sesión</span>

                                    <span class="indicator-progress">
                                        Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                            <a href="{{ route('cliente.register.get') }}" class="link-primary fs-6 fw-bolder">
                                Crear cuenta?
                            </a>
                        </form>
                    </div>
                </div>

            </div>

            {{-- <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                style="background-image: url(https://preview.keenthemes.com/metronic8/demo1/assets/media/misc/auth-bg.png)">
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <a href="{{ route('login') }}" class="mb-0 mb-lg-12">
                        @if ($configuracion->logotipo !== '')
                            <img alt="Logo" src="{{ $configuracion->logotipo }}" class="h-60px h-lg-75px" />
                        @else
                            <img alt="Logo" src="/metronic8/demo1/assets/media/logos/custom-1.png"
                                class="h-60px h-lg-75px" />
                        @endif
                    </a>

                    @if ($configuracion->imagen_login !== '')
                        <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                            style="margin-top: -30px" src="{{ $configuracion->imagen_login }}" alt="" />
                    @else
                        <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                            style="margin-top: -30px"
                            src="	https://preview.keenthemes.com/metronic8/demo1/assets/media/misc/auth-screens.png"
                            alt="" />
                    @endif

                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7"
                        style="margin-top: -30px">
                        {{ $configuracion->nombre }}
                    </h1>

                    <div class="d-none d-lg-block text-white fs-base text-center">
                        In this kind of post, <a href="#" class="AA5-hover text-warning fw-bold me-1">the
                            blogger</a>

                        introduces a person they’ve intervieA<br /> and provides some background information about

                        <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a>
                        and their <br /> work following this is a transcript of the interview.
                    </div>
                </div>
            </div> --}}
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                style="background-image: url(https://preview.keenthemes.com/metronic8/demo1/assets/media/misc/auth-bg.png)">
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <a href="#" class="mb-0 mb-lg-12">
                        @if ($configuracion->logotipo !== '')
                            <img alt="Logo" src="{{ $configuracion->logotipo }}" class="h-60px h-lg-75px" />
                        @else
                            <img alt="Logo" src="/metronic8/demo1/assets/media/logos/custom-1.png"
                                class="h-60px h-lg-75px" />
                        @endif
                    </a>

                    @if ($configuracion->image_login !== '')
                        <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                            style="margin-top: -30px" src="{{ $configuracion->image_login }}" alt="" />
                    @else
                        <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                            style="margin-top: -30px"
                            src="	https://preview.keenthemes.com/metronic8/demo1/assets/media/misc/auth-screens.png"
                            alt="" />
                    @endif

                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7"
                        style="margin-top: -30px">
                        {{ $configuracion->name }}
                    </h1>

                    <div class="d-none d-lg-block text-white fs-base text-center">
                        Tu lugar de confianza.
                    </div>
                </div>
            </div>
        </div>
    @include('admin.layouts.scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            ocultarOMostrarPassword();
            const form = document.querySelector('.form');
            const submitButton = document.querySelector('#kt_sign_in_submit');
        
            form.addEventListener('submit', function () {
                submitButton.disabled = true;
                submitButton.innerHTML = 'Processing...';
            });
        });

        </script>
</body>

</html>
