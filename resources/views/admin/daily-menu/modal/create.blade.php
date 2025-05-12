<div class="modal fade" id="crearModalCiudad" tabindex="-1" aria-labelledby="exampleModalCrearCiudades" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCrearCiudades">Sacar  a la venta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="productForm" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Seleccionar</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productosNoEnMenu as $item)
                                <tr>
                                    <td><input type="checkbox" name="productos[]" value="{{ $item->id }}"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td><input type="text" name="stock[]" class="form-control"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a data-bs-dismiss="modal" class="btn btn-secondary btn-sm">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
