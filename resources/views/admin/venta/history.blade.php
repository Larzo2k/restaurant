@extends('admin.layouts.app')

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-header">
            <h3 class="card-title"> <a href="#" class="btn btn-sm btn-icon btn-light-success me-2"
                    data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title=""
                    data-bs-original-title="Atras" aria-label="Atras"><i class="fa fa-arrow-left"></i></a>
                Historial de ventas </h3>
            <div class="card-toolbar d-flex justify-content-end align-items-center">
                <div class="d-flex align-items-center position-relative my-1 me-4">
                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <input id="buscador" type="text" class="form-control form-control-solid w-250px ps-14"
                        placeholder="Buscar" />
                </div>
                {{-- <div>
                    <a class="btn btn-sm btn-primary d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#crearModalCiudad">
                        <i class="fa-solid fa-plus me-1"></i> Nuevo
                    </a>
                </div> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="" id="table">
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
                                        <th class="sorting_disabled" rowspan="1" colspan="1">
                                            Cliente</th>
                                        {{-- <th class="sorting_disabled" rowspan="1" colspan="1">
                                            email</th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1">
                                            telefono</th> --}}
                                        <th class="min-w-70px text-end sorting_disabled" rowspan="1" colspan="1">
                                            Opciones</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="text-gray-600">
                                    @forelse ($ventas as $venta)
                                        <tr class="odd">
                                            <td class="col-1">{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $venta->nro_recibo }}</td> --}}
                                            <td>{{ \Carbon\Carbon::parse($venta->fecha)->locale('es')->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                    Bs. {{ number_format($venta->total, 2, ',', '.') }}
                                                </span>
                                            </td>
                                            <td>{{ $venta->customer->name }} {{ $venta->customer->address }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('venta.pdf', $venta->id) }}"
                                                    class="btn btn-icon btn-flex btn-active-light-primary w-30px h-30px me-3"
                                                    data-bs-toggle="tooltip" title="" data-kt-action="product_remove"
                                                    data-bs-original-title="Ver pdf">
                                                    <i class="fa-solid fa-file-pdf"></i>
                                                    {{-- <i class="fa-solid fa-trash"></i> --}}
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
                    {{ $ventas->links() }}
                </div>
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection
