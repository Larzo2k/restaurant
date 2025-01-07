<div class="table-responsive">
    <!--begin::Table-->
    <div id="kt_subscription_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
        <div class="table-responsive">
            <table class="table align-middle table-row-dashed fs-6 fw-bold gy-4 dataTable no-footer"
                id="kt_subscription_products_table">
                <!--begin::Table head-->
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="sorting_disabled" >#</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1">Imagen</th>
                        <!-- <th class="sorting_disabled" rowspan="1" colspan="1">Codigo barra</th> -->
                        <th class="sorting_disabled" rowspan="1" colspan="1">
                            Nombre</th>
                            <th class="sorting_disabled" rowspan="1" colspan="1">
                            Descripción</th>
                            <!-- <th class="sorting_disabled" rowspan="1" colspan="1">
                            precio</th>
                            <th class="sorting_disabled" rowspan="1" colspan="1">
                            stock</th> -->
                        <th class="min-w-70px text-end sorting_disabled" rowspan="1" colspan="1">Opciones</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600">
                    @forelse ($productos as $producto)
                        <tr class="odd">
                            <td class="col-1">{{ $loop->iteration }}</td>
                            <td class="col-1">
                                <img src="{{asset($producto->image)}}" height="40" alt="">
                            </td>
                            <!-- <td class="col-1">
                                <img src="{{asset($producto->getCidogoBarraPng())}}" height="30" width="50" alt="">
                            </td> -->
                            <td>{{ $producto->name }}</td>
                            <td>{{ $producto->description }}</td>
                            <!-- <td>{{ $producto->price }}</td>
                            <td>{{ $producto->stock }}</td> -->
                            <td class="text-end">
                                {{-- @can('editar directivos') --}}
                                    <a onclick="editar(`{{$producto->id}}`,`{{$producto->name}}`, `{{$producto->description}}`, `{{$producto->image}}`, `{{$producto->price}}`, `{{$producto->stock}}`, `{{$producto->cod}}`, `{{$producto->diametro}}`, `{{$producto->longitud}}`, `{{$producto->category_id}}`, `{{$producto->wherehouse_id}}`)"
                                    class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3"
                                    data-bs-toggle="tooltip" title="" data-kt-action="product_remove"
                                    data-bs-original-title="Editar">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3"
                                                    d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </a>
                                {{-- @endcan --}}
                                  <a onclick="eliminar(`{{$producto->id}}`, `{{$producto->name}}`, `{{$producto->address}}`)" class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="" data-kt-action="product_remove" data-bs-original-title="Dar de baja">
                                    <i class="fa-solid fa-trash"></i>
                                  </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="odd">
                            <td colspan="3"> No se encontraron datos</td>
                        </tr>
                    @endforelse
                </tbody>
                <!--end::Table body-->
            </table>
        </div>
    </div>
    <!--end::Table-->
    {{$productos->links()}}
</div>
