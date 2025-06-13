<div class="table-responsive">
  @php
      use Carbon\Carbon;
  @endphp
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
                    <th class="sorting_disabled" rowspan="1" colspan="1">
                        Estado</th>
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
                    <td class="text-center">
                      @php
                          $createdAt = Carbon::parse($item->created_at);
                          $puedeCancelar = now()->diffInMinutes($createdAt) < 5;
                      @endphp
                      @switch($item->is_pago)
                          @case(1)
                            <span class="badge bg-success rounded-pill px-3 py-2">
                                PAGADO
                            </span>
                              @break
                          @case(0)
                            <span class="badge bg-danger rounded-pill px-3 py-2">
                                No PAGADO
                            </span>
                              @break
                          @default
                              
                      @endswitch
                    </td>
                    <td class="text-end">
                        @switch($item->is_pago)
                            @case(1)
                              <a href="{{ route('cliente.pedido.pdf', $item->id) }}"
                                class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3"
                                data-bs-toggle="tooltip" title="" data-kt-action="product_remove"
                                data-bs-original-title="Ver pdf">
                                  <i class="fa-solid fa-file-pdf"></i>
                              </a>
                                @break
                            @case(0)
                              <a onclick="verQr(`{{ optional($item->payment)->path_qr }}`)"
                                class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3"
                                data-bs-toggle="tooltip" title="" data-kt-action="product_remove"
                                data-bs-original-title="Ver pdf">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                              </a>
                                {{-- @if($puedeCancelar) --}}
                                    <!-- Botón cancelar -->
                                    <a onclick="cancelarPedido(`{{ $item->id }}`)"
                                        class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3"
                                        data-bs-toggle="tooltip"
                                        title="Cancelar pedido">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22"/></svg>
                                    </a>
                                {{-- @endif --}}
                                @break
                            @default
                        @endswitch
                    </td>
                </tr>
            @empty
                <tr class="odd">
                    <td colspan="3"> No hay pedidos</td>
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
