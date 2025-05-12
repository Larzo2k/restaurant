@extends('admin.layouts.app')

@section('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.36.3/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@section('toolbar')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Dashboard</h1>
                {{-- <!--end::Title-->
            <!--begin::Separator-->
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="../../demo1/dist/index.html"
                        class="text-muted text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Utilities</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Modals</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">General</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-dark">Invite Friends</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb--> --}}
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                {{-- <div class="m-0">
                <!--begin::Menu toggle-->
                <a href="#"
                    class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none">
                            <path
                                d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Filter
                </a>
                <!--end::Menu toggle-->
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                    data-kt-menu="true" id="kt_menu_6244761e325a6">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Menu separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Menu separator-->
                    <!--begin::Form-->
                    <div class="px-7 py-5">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-bold">Status:</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div>
                                <select class="form-select form-select-solid"
                                    data-kt-select2="true" data-placeholder="Select option"
                                    data-dropdown-parent="#kt_menu_6244761e325a6"
                                    data-allow-clear="true">
                                    <option></option>
                                    <option value="1">Approved</option>
                                    <option value="2">Pending</option>
                                    <option value="2">In Process</option>
                                    <option value="2">Rejected</option>
                                </select>
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-bold">Member Type:</label>
                            <!--end::Label-->
                            <!--begin::Options-->
                            <div class="d-flex">
                                <!--begin::Options-->
                                <label
                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                    <input class="form-check-input" type="checkbox"
                                        value="1" />
                                    <span class="form-check-label">Author</span>
                                </label>
                                <!--end::Options-->
                                <!--begin::Options-->
                                <label
                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox"
                                        value="2" checked="checked" />
                                    <span class="form-check-label">Customer</span>
                                </label>
                                <!--end::Options-->
                            </div>
                            <!--end::Options-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label fw-bold">Notifications:</label>
                            <!--end::Label-->
                            <!--begin::Switch-->
                            <div
                                class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value=""
                                    name="notifications" checked="checked" />
                                <label class="form-check-label">Enabled</label>
                            </div>
                            <!--end::Switch-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset"
                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                data-kt-menu-dismiss="true">Reset</button>
                            <button type="submit" class="btn btn-sm btn-primary"
                                data-kt-menu-dismiss="true">Apply</button>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Menu 1-->
            </div> --}}
                <!--end::Filter menu-->
                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                {{-- <a href="../../demo1/dist/.html" class="btn btn-sm btn-primary"
                data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a> --}}
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <!-- Primera fila -->
                    <div class="row justify-content-center m-7">
                        <div class="col-md-3 m-3"
                            style="background-color: rgb(39, 48, 215); color:#fff; height:auto; padding:10px; border-radius:10px">
                            <h5 style="color: #fff">Total Producto </h5>
                            <p style="margin-top: 10px; margin-left:10px"> <b
                                    id="cantdadMedicamento">{{ $totalProductos }}</b> Productos</p>
                            <a href="{{ route('productos') }}" style="margin-top: 10px; color:#fff">Ver
                                detalles</a>
                        </div>
                        <div class="col-md-3 m-3"
                            style="background-color: green; color:#fff; height:auto; padding:10px; border-radius:10px">
                            <h5 style="color: #fff">Venta del día</h5>
                            <p style="margin-top: 10px; margin-left:10px"><b id="ventaDelDia">{{ $ventaTotal }}</b> BS</p>
                            <a href="" target="_blank" style="margin-top: 10px; color:#fff">Ver detalles</a>
                        </div>
                        <div class="col-md-3 m-3"
                            style="background-color: red; color:#fff; height:auto; padding:10px; border-radius:10px">
                            <h5 style="color: #fff">Producto Stock</h5>
                            <p style="margin-top: 10px; margin-left:10px"><b
                                    id="stockProducto">{{ $productosConStockCero }}</b> Producto con stock minimo</p>
                            <a href="" target="_blank" style="margin-top: 10px; color:#fff">Ver detalles</a>
                        </div>
                    </div>
                    <!-- Segunda fila -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center"
                                style="color: #5667af; font-size:30px; font-weight: 900; margin-top:20px">Venta Mes</div>
                            <div class="card-body">
                                <canvas id="myChart" style="width: 700px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            dibujarGrafica();
        });

        function dibujarGrafica() {
            $.ajax({
                url: `{{ url('admin/chart') }}`,
                type: "GET",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(response.chart);
                    dibujarGrafico(response.chart);
                    // if(response.codigo == 0){
                    //     $('#table').html(response.data);
                    // Toast.fire({
                    //     icon: 'success',
                    //     title: response.mensaje,
                    // });
                    // }else{
                    //     Toast.fire({
                    //         icon: 'error',
                    //         title: response.mensaje,
                    //     });
                    // }
                },
                error: function(err, err1, err2) {

                }
            });
        }

        function dibujarGrafico(grafico) {
            // Extraer nombres y valores para las etiquetas del gráfico
            var nombres = grafico.map(function(item) {
                return item.nombre;
            });

            var valores = grafico.map(function(item) {
                return item.total_vendido;
            });

            // Obtener el contexto del canvas
            var ctx = document.getElementById('myChart').getContext('2d');

            // Crear el gráfico
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: nombres, // Etiquetas de los nombres de los medicamentos
                    datasets: [{
                        label: 'Cantidad vendida',
                        data: valores, // Datos de cantidad vendida
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endpush
