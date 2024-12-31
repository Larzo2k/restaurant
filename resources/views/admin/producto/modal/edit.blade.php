<div class="modal fade" id="editarModalCiudad" tabindex="-1" aria-labelledby="exampleModalCrearCiudades" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCrearCiudades">Editar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="productoFormEditar" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre<span class="required"></span></label>
                            <input type="text" class="form-control form-control-sm " id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido" class="form-label">Código<span class="required"></span></label>
                            <input type="number" class="form-control form-control-sm " id="codigo" name="codigo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="descripcion" class="form-label">Descripción<span class="required"></span></label>
                            <textarea class="form-control form-control-sm" id="descripcion" name="descripcion" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="almacen_id" class="form-label">Almacen<span class="required"></span></label>
                            <select class="form-select form-select-sm" data-control="select2" data-placeholder="Seleccione un almacen" name="almacen_id" required>
                                <option value=""></option>
                                @forelse ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}"> {{ $almacen->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="categoria_id" class="form-label">Categoría<span class="required"></span></label>
                            <select class="form-select form-select-sm" data-control="select2" data-placeholder="Seleccione una categoría" name="categoria_id" required>
                                <option value=""></option>
                                @forelse ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"> {{ $categoria->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label">Precio<span class="required"></span></label>
                            <input type="number" class="form-control form-control-sm" name="precio" required>
                        </div> --}}
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">Stock<span class="required"></span></label>
                            <input type="number" class="form-control form-control-sm " id="stock" name="stock" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="stock" class="form-label">Código de barra <span class="required"></span></label>
                            <div class="d-flex justify-content-center">
                                <!-- Contenedor para el código de barras -->
                                {{-- <svg id="barcode" style="border: 1px solid #ddd; padding: 10px;"></svg> --}}
                                 <img id="barcodeImageEdit" src="" alt="Código de barras" style="display:none;">
                            </div>
                        </div>

                        <!-- Botón para generar el código de barras -->
                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn btn-primary" onclick="generateBarcode()">Generar Código de Barra</button>
                        </div>
                        <div class="col-md-12 mb-5">
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
                                    <button type="button" onclick="removeUpload('2')" class="remove-image" id="remove-image2">Eliminar</button>
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
