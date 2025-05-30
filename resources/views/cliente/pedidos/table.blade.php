<div class="table-responsive">
  <!--begin::Table-->
  <div id="kt_subscription_products_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
      <div class="table-responsive">
          <table class="table align-middle table-row-dashed fs-6 fw-bold gy-4 dataTable no-footer"
              id="kt_subscription_products_table">
              <!--begin::Table head-->
              <thead>
                  <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="sorting_disabled">#</th>
                    <th class="sorting_disabled" rowspan="1" colspan="1">Fecha</th>
                    <th class="sorting_disabled text-center" rowspan="1" colspan="1">
                        Monto</th>
                    {{-- <th class="sorting_disabled" rowspan="1" colspan="1">
                        Cliente</th> --}}
                    <th class="min-w-70px text-end sorting_disabled" rowspan="1" colspan="1">
                        Opciones</th>
                </tr>
              </thead>
              <!--end::Table head-->
              <!--begin::Table body-->
              <tbody class="text-gray-600">
                @forelse ($pedidos as $item)
                <tr class="odd">
                    <td class="col-1">{{ $loop->iteration }}</td>
                    {{-- <td>{{ $venta->nro_recibo }}</td> --}}
                    <td>{{ \Carbon\Carbon::parse($item->fecha)->locale('es')->translatedFormat('l, d F Y') }}
                    </td>
                    <td class="text-center">
                        <span class="badge bg-success rounded-pill px-3 py-2">
                            Bs. {{ number_format($item->total, 2, ',', '.') }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('cliente.pedido.pdf', $item->id) }}"
                            class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3"
                            data-bs-toggle="tooltip" title="" data-kt-action="product_remove"
                            data-bs-original-title="Ver pdf">
                            <i class="fa-solid fa-file-pdf"></i>
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
  {{-- {{$productoEnMenu->links()}} --}}
</div>
