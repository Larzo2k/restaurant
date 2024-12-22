<div class="modal fade" id="crearModalCiudad" tabindex="-1" aria-labelledby="exampleModalCrearCiudades"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCrearCiudades">Agregar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="categoriaForm" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre<span class="required"></span></label>
                        <input type="text" class="form-control form-control-sm " id="nombre" name="nombre"
                            required>
                    </div>
                    {{-- <div class="col-md-3 mb-6">
                        <label for="" class="form-label required">Forma Pago</label>
                        <select name="forma_pago_id" class="form-select form-select-sm" data-control="select2"
                            data-placeholder="Seleccione una opción" required>
                            <option value="durazno">durazno</option>
                            <option value="Manzana">Manzana</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center ms-1 ms-lg-3" style="width: 200px !important;">
                                    <select class="form-select form-select-sm" id="idcondominio_header" name="idcondominio_header"
                                    data-control="select2" data-placeholder="Seleccione un condominio"
                                    style="width: 100% !important;">
                                        <option value="durazno">durazno</option>
                            <option value="Manzana">Manzana</option>
                                    </select>
                                </div> --}}
                    {{-- <div class="mb-3">
                        <label for="nombre" class="form-label">Imagen</label>
                        <input type="file" class="form-control form-control-sm " id="imagen" name="imagen"
                            required>
                    </div> --}}
                    {{-- <div class="col-md-12 mb-5">
                        <label class="form-label">Imagen</label>
                        <div class="image-upload-wrap" id="image-upload-wrap1">
                            <input class="file-upload-input" id="file-upload-input1" type='file' name="imagen"
                                onchange="readURL(this,'1');" accept="image/jpg, image/jpeg,image/png" />
                            <div class="drag-text">
                                <h3>Arrastra la imagen o selecciona</h3>
                            </div>
                        </div>
                        <div class="file-upload-content" id="file-upload-content1">
                            <img class="file-upload-image" id="file-upload-image1" alt="imagen" />
                            <div class="image-title-wrap" id="image-title-wrap1">
                                <button type="button" onclick="removeUpload('1')" class="remove-image"
                                    id="remove-image1">Eliminar</button>
                            </div>
                        </div>
                    </div> --}}

                </div>
                <div class="modal-footer">
                    <a data-bs-dismiss="modal" class="btn btn-secondary btn-sm">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
