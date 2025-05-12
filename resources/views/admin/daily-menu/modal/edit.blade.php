<div class="modal fade" id="editarModalCiudad" tabindex="-1" aria-labelledby="exampleModalCrearCiudades" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCrearCiudades">Editar stock producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="productFormEditar" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre<span class="required"></span></label>
                            <input type="text" class="form-control form-control-sm " id="nombre" name="nombre" required disabled>
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label for="apellido" class="form-label">descripcion<span class="required"></span></label>
                            <input type="text" class="form-control form-control-sm " id="descripcion" name="descripcion" required disabled>
                        </div> --}}
                        <div class="col-md-6 mb-3">
                            <label for="descripcion" class="form-label">Descripción<span class="required"></span></label>
                            <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" required disabled></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="correo" class="form-label">Precio</label>
                            <input type="text" class="form-control form-control-sm" name="precio" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido" class="form-label">Stock<span class="required"></span></label>
                            <input type="number" class="form-control form-control-sm " id="stock" name="stock" required>
                        </div>
                        {{-- <div class="col-md-12 mb-5">
                            <label class="form-label">Imagen</label>
                            <div class="image-upload-wrap" id="image-upload-wrap2">
                                <input class="file-upload-input" id="file-upload-input2" type='file' name="imagen" onchange="readURL(this,'2');" accept="image/jpg, image/jpeg,image/png" />
                                <div class="drag-text">
                                    <h3>Arrastra la imagen o selecciona</h3>
                                </div>
                            </div>
                            <div class="file-upload-content" id="file-upload-content2">
                                <img class="file-upload-image" id="file-upload-image2" alt="imagen" />
                                <div class="image-title-wrap" id="image-title-wrap2">
                                    <button type="button" onclick="removeUpload('2')" class="remove-image" id="remove-image1">Eliminar</button>
                                </div>
                            </div>
                        </div> --}}
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
