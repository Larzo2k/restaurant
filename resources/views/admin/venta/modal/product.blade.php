<div class="modal fade" id="crearModalCondominio" tabindex="-1" aria-labelledby="exampleModalCrearMedicamento" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCrearMedicamento">Lista Productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="medicamentoForm" method="post">
                <div class="modal-body">
                    @csrf
                    <table class="border-dark">
                        <thead>
                            <tr>
                                <th width="1%">Imagen</th>
                                <th>Nombre</th>
                                <th>Descrip.</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                {{-- <th>Longitud</th>
                                <th>Diametro</th> --}}
                                {{-- <th>Categoria</th> --}}
                                {{-- <th>Almacen</th> --}}
                                <th width="1%"></th>
                            </tr>
                        </thead>
                        <tbody id="tablaMedicamento">
                          @forelse ($productos as $item)
                              <tr>
                                <td><div style="margin-left: 10px"><img src="{{asset($item->image)}}" height="40" alt=""></div></td>
                                <td><div style="margin-left: 10px">{{$item->name}}</div></td>
                                <td><div style="margin-left: 10px">{{$item->description}}</div></td>
                                <td><div style="margin-left: 10px">{{$item->dailyMenuProduct->stock}}</div></td>
                                <td><div style="margin-left: 10px">{{$item->price}}</div></td>
                                {{-- <td><div style="margin-left: 10px">{{$item->longitud}}</div></td>
                                <td><div style="margin-left: 10px">{{$item->diametro}}</div></td> --}}
                                {{-- <td><div style="margin-left: 10px">{{$item->category->name}}</div></td> --}}
                                {{-- <td><div style="margin-left: 10px">{{$item->wherehouse->name}}</div></td> --}}
                                <td>
                                    <a onclick="cargarProducto(`{{$item->id}}`,`{{$item->name}}`,`{{$item->dailyMenuProduct->stock}}`,`{{$item->price}}`)" class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="Editar" style="background-color:green">
                                        <i class="fa-solid fa-check" style="color:#fff"></i>
                                    </a>
                                </td>
                            </tr>
                          @empty
                              <tr><td>No se encontraron datos</td></tr>
                          @endforelse
                            
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a data-bs-dismiss="modal" class="btn btn-secondary btn-sm">Cancelar</a>
                    {{-- <button type="submit" class="btn btn-primary btn-sm">Guardar</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>
