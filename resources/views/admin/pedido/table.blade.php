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
                      <th class="sorting_disabled" rowspan="1" colspan="1">
                          Total</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1">
                            Fecha</th>
                        <th class="sorting_disabled" rowspan="1" colspan="1">
                              Estado</th>
                      <th class="min-w-70px text-end sorting_disabled" rowspan="1" colspan="1">Opciones</th>
                  </tr>
              </thead>
              <!--end::Table head-->
              <!--begin::Table body-->
              <tbody class="text-gray-600">
                  @forelse ($pedidos as $item)
                      <tr class="odd">
                          <td class="col-1">{{ $loop->iteration }}</td>
                          <td>{{ $item->total }}</td>
                          <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('es')->translatedFormat('l, d F Y') }}</td>
                          <td>@switch($item->is_pago)
                              @case(1)
                                  <span class="badge bg-success rounded-pill px-3 py-2">PAGADO</span>
                                  @break
                              @case(0)
                                  <span><span class="badge bg-danger rounded-pill px-3 py-2">NO PAGADO</span>
                                  @break
                              @default
                              <span><span class="badge bg-danger rounded-pill px-3 py-2">NO PAGADO</span>
                          @endswitch</td>
                          <td class="text-end">
                                <a onclick="showPedido(`{{$item->id}}`" class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="tooltip" title="" data-kt-action="product_remove" data-bs-original-title="Dar de baja">
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
  {{-- {{$pedidos->links()}} --}}
</div>
