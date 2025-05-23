<div class="modal fade" id="crearModalCiudad" tabindex="-1" aria-labelledby="exampleModalCrearCiudades" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCrearCiudades">Agregar clientes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="clienteForm" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre<span class="required"></span></label>
                            <input type="text" class="form-control form-control-sm " id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido" class="form-label">Apellido<span class="required"></span></label>
                            <input type="text" class="form-control form-control-sm " id="apellido" name="apellido" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cod_pais" class="form-label">Código de país<span class="required"></span></label>
                            <select class="form-select form-select-sm" data-control="select2" data-placeholder="Seleccione un pais" name="cod_pais" required>
                                <option value=""></option>
                                @forelse ($paises as $pais)
                                    <option value="{{ $pais->dial_code }}"> {{ $pais->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="correo" class="form-label">Teléfono</label>
                            <input type="text" class="form-control form-control-sm" name="telefono">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido" class="form-label">Correo<span class="required"></span></label>
                            <input type="email" class="form-control form-control-sm " id="email" name="email" required>
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password<span class="required"></span></label>
                            <input type="password" class="form-control form-control-sm " id="email" name="email" required>
                        </div> --}}
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password<span class="required"></span></label>
                            <div class="position-relative">
                                <input type="password" class="form-control form-control-sm pr-5" id="password" name="password" required>
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="eye-icon"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12 mb-5">
                            <label class="form-label">Imagen</label>
                            <div class="image-upload-wrap" id="image-upload-wrap1">
                                <input class="file-upload-input" id="file-upload-input1" type='file' name="imagen" onchange="readURL(this,'1');" accept="image/jpg, image/jpeg,image/png" />
                                <div class="drag-text">
                                    <h3>Arrastra la imagen o selecciona</h3>
                                </div>
                            </div>
                            <div class="file-upload-content" id="file-upload-content1">
                                <img class="file-upload-image" id="file-upload-image1" alt="imagen" />
                                <div class="image-title-wrap" id="image-title-wrap1">
                                    <button type="button" onclick="removeUpload('1')" class="remove-image" id="remove-image1">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a data-bs-dismiss="modal" class="btn btn-secondary btn-sm">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
