<div class="modal fade" id="editarModalCiudad" tabindex="-1" aria-labelledby="exampleModalEditarCiudad"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalEditarCiudad">Editar Ciudad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="categoriaFormEditar">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre <span class="required"></span></label>
                        <input type="text" class="form-control form-control-sm " name="nombre" required>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="nombre" class="form-label">Imagen</label>
                        <input type="file" class="form-control form-control-sm " id="imagen" name="imagen"
                            required>
                    </div> --}}
                    {{-- <div class="col-md-12 mb-5">
                        <label class="form-label">Fotografía</label>
                        <div class="image-upload-wrap" id="image-upload-wrap2">
                            <input class="file-upload-input" id="file-upload-input2" type='file' name="imagen"
                                onchange="readURL(this,'2');" accept="image/jpg, image/jpeg,image/png" />
                            <div class="drag-text">
                                <h3>Arrastra la imagen o selecciona</h3>
                            </div>
                        </div>
                        <div class="file-upload-content" id="file-upload-content2">
                            <img class="file-upload-image" id="file-upload-image2" src="#" alt="imagen" />
                            <div class="image-title-wrap" id="image-title-wrap2">
                                <button type="button" onclick="removeUpload('2')" class="remove-image"
                                    id="remove-image2">Eliminar</button>
                            </div>
                        </div>
                    </div> --}}

                </div>
                <div class="modal-footer">
                    <a data-bs-dismiss="modal" class="btn btn-secondary btn-sm">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
