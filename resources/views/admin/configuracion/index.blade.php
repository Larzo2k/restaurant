@extends('admin.layouts.app')

@section('content')
    <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Configuraciones</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Account                                      </li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <!--end::Actions-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->                                        
                    
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content  flex-column-fluid ">   
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <!--begin::Basic info-->
                    <div class="card mb-5 mb-xl-10">
                        <!--begin::Card header-->
                        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Datos de la configación</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--begin::Card header-->

                        <!--begin::Content-->
                        <div id="kt_account_settings_profile_details" class="collapse show">
                            <!--begin::Form-->
                            <form action="{{route('configuration.update')}}" method="POST" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="formEditarConfiguracion">
                                @csrf
                                <input type="hidden" id="id" name="id" value="{{$configuraciones->id}}">
                                <!--begin::Card body-->
                                <div class="card-body border-top p-9 " id="datosPersonales">
                                    <!--begin::Input group-->
                                    <!--begin::Image input esta url del primer div no sirbe para nada-->
                                    <div class="d-flex justify-content-center flex-wrap mb-5">
                                        <div class="image-input image-input-outline mt-15" data-kt-image-input="true" style="background-image: url('http://127.0.0.1:8000/metronic/assets/media/svg/avatars/blank.svg');margin-right:40px">
                                                <h4>Logo Tipo</h4>
                                                <!--begin::Preview existing avatar-->
                                                @if ($configuraciones->logotipo	!== "")
                                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset($configuraciones->logotipo) }}'); background-size:100% 120px"></div>
                                                @else
                                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url(	http://127.0.0.1:8000/metronic/assets/media/avatars/300-1.jpg); background-size:100% 120px"></div>
                                                @endif
                                                
                                                <!--end::Preview existing avatar-->

                                                <!--begin::Label-->
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change logotipo" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                                    <svg style="font-size: 8px; width:17px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                                                    <input type="hidden" name="avatar_remove">
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Label-->

                                                <!--begin::Cancel-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                                    <svg style="font-size:5px;width:13px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                                                </span>
                                                <!--end::Cancel-->

                                                <!--begin::Remove-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                                    <svg style="font-size:5px;width:13px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>                            
                                                </span>
                                                <!--end::Remove-->
                                            </div>

                                            <!--favicon-->
                                            <div class="image-input image-input-outline mt-15" data-kt-image-input="true" style="background-image: url('http://127.0.0.1:8000/metronic/assets/media/svg/avatars/blank.svg'); margin-right:40px;">
                                                <h4>favicon</h4>
                                                <!--begin::Preview existing avatar-->
                                                @if ($configuraciones->favicon	!== "")
                                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset($configuraciones->favicon) }}'); background-size:100% 120px"></div>
                                                @else
                                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url(	http://127.0.0.1:8000/metronic/assets/media/avatars/300-1.jpg); background-size:100% 120px"></div>
                                                @endif
                                                
                                                <!--end::Preview existing avatar-->

                                                <!--begin::Label-->
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change favicon" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                                    <svg style="font-size: 8px; width:17px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="favicon" accept=".png, .jpg, .jpeg">
                                                    <input type="hidden" name="avatar_remove">
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Label-->

                                                <!--begin::Cancel-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                                    <svg style="font-size:5px;width:13px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                                                </span>
                                                <!--end::Cancel-->

                                                <!--begin::Remove-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                                    <svg style="font-size:5px;width:13px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>                            
                                                </span>
                                                <!--end::Remove-->
                                            </div>

                                            <!--Imagen menu-->
                                            <div class="image-input image-input-outline mt-15" data-kt-image-input="true" style="background-image: url('http://127.0.0.1:8000/metronic/assets/media/svg/avatars/blank.svg');margin-right:40px">
                                                <h4>Imagen Login</h4>
                                                <!--begin::Preview existing avatar-->
                                                @if ($configuraciones->image_login	!== "")
                                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset($configuraciones->image_login) }}'); background-size:100% 120px"></div>
                                                @else
                                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url(	http://127.0.0.1:8000/metronic/assets/media/avatars/300-1.jpg); background-size:100% 120px"></div>
                                                @endif
                                                
                                                <!--end::Preview existing avatar-->

                                                <!--begin::Label-->
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change imagen_login" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                                    <svg style="font-size: 8px; width:17px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"/></svg>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="imagen_login" accept=".png, .jpg, .jpeg">
                                                    <!--end::Inputs-->
                                                </label>
                                                <!--end::Label-->

                                                <!--begin::Cancel-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                                    <svg style="font-size:5px;width:13px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                                                </span>
                                                <!--end::Cancel-->

                                                <!--begin::Remove-->
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                                    <svg style="font-size:5px;width:13px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>                            
                                                </span>
                                                <!--end::Remove-->
                                            </div>
                                    </div>
                                            
                                    <div class="row mb-6 mt-15">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nombre</label>
                                        <div class="col-lg-8">
                                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                <input type="text" id="name" name="name" class="form-control form-control-lg mb-3 mb-lg-0 input" placeholder="First name" value="{{$configuraciones->name}}" required>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        </div>
                                    </div>
                                    <div class="row mb-6 contenedor">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Código de país</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <select class="orm-control form-control-lg mb-3 mb-lg-0 form-select form-select-sm input" data-control="select2" data-placeholder="Seleccione un país" name="cod_pais"  required id="cod_pais">
                                                <option></option>
                                                @forelse ($paises as $pais)
                                                    <option  value="{{ $pais->dial_code }}" @if($configuraciones->cod == $pais->dial_code) selected @endif>{{ $pais->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                      </div>
                                    </div>
                                    <div class="row mb-6 contenedor">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Telefono</label>
                                        <!--end::Label-->

                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="number" id="telefono" name="telefono" class="form-control form-control-lg input" placeholder="Company name" value="{{$configuraciones->telefono}}" required>
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6 contenedor">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Access Token WhatsApp</label>
                                        <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                            <input type="text" id="telefono" name="access_token_wsp" class="form-control form-control-lg input" placeholder="Access_Token_wsp" value="{{$configuraciones->access_token}}" required>
                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>

                                    </div>
                                </div>

                                <div class="card-footer d-flex justify-content-end py-6 px-9" id="operaciones">
                                    <!--<button type="reset" class="btn btn-light btn-active-light-primary me-2" id="cancelar">Cancelar</button>-->
                                    {{-- @can('editar configuraciones') --}}
                                        <button type="submit" class="btn btn-primary" id="enviar">Actualizar</button>
                                    {{-- @endcan --}}
                                </div>
                                <input type="hidden">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
  <script>
    //envio de la informacion
    $(document).ready(function() {
            /*verificar contra*/
            //----
            $('#formEditarConfiguracion').on('submit', function(event) {
                event.preventDefault();

                var form = $(this)[0];
                if (form.checkValidity()) {
                    var formData = new FormData(form);
                    $.ajax({
                        url: form.action,
                        method: form.method,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response && response.codigo === 0) {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.mensaje,
                                });
                                //window.location.reload();
                                /*Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: response.mensaje,
                                    confirmButtonText: 'OK',
                                })/*;hasta aqui era*//*.then((result) => {
                                    if (result.isConfirmed) {
                                        // Recargar la página
                                        window.location.reload();
                                    }
                                });*/
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.mensaje,
                                });
                                /*Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.mensaje,
                                    confirmButtonText: 'OK',
                                });*/
                            }

                        },
                        error: function(xhr, textStatus, errorThrown) {
                             Toast.fire({
                                icon: 'error',
                                title: 'Se produjo un error en la petición',
                            });
                        }
                    });
                } else {
                    // Mostrar los mensajes de validación
                    form.reportValidity();
                }
            });
        });
  </script>
@endpush