@extends('admin.layouts.app')

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-header">
            <h3 class="card-title"> <a href="#" class="btn btn-sm btn-icon btn-light-success me-2" data-bs-toggle="tooltip"
                    data-bs-boundary="window" data-bs-placement="top" title="" data-bs-original-title="Atras"
                    aria-label="Atras"><i class="fa fa-arrow-left"></i></a>
                Menu del dia </h3>
            <div class="card-toolbar d-flex justify-content-end align-items-center">
                <div class="d-flex align-items-center position-relative my-1 me-4">
                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                        </svg>
                    </span>
                    <input id="buscador" type="text" class="form-control form-control-solid w-250px ps-14" placeholder="Buscar" />
                </div>
                <div>
                  <a class="btn btn-sm btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#crearModalCiudad">
                    <i class="fa-solid fa-plus me-1"></i> Agregar al menu
                  </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="" id="table">
                @include('admin.daily-menu.table')
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection
@section('modals')
    @include('admin.daily-menu.modal.create')
    @include('admin.daily-menu.modal.edit')
@endsection

@push('scripts')
    <script>
        let product_menu_id = null;
        $(document).ready(function() {
            $('#productForm').submit(function(e) {
              e.preventDefault();

              let form = document.getElementById('productForm');
              if (!form.checkValidity()) {
                  form.reportValidity();
                  return;
              }

              let formData = new FormData(form);

              $.ajax({
                  url: "{{ url('admin/daily-menu/store') }}",
                  type: 'POST',
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function(response) {
                      console.log(response);
                      if (response.codigo == 0) {
                          Toast.fire({
                              icon: 'success',
                              title: response.mensaje,
                          });
                          $('#crearModalCiudad').modal('hide');
                          form.reset();
                          $('#table').html(response.data);
                      } else {
                          Toast.fire({
                              icon: 'error',
                              title: response.mensaje,
                          });
                      }
                  },
                  error: function(error) {
                      console.log(error);
                      Toast.fire({
                          icon: 'error',
                          title: 'Ocurrió un error al guardar el ciudad',
                      });
                  }
              });
            });
            $('#productFormEditar').submit(function(e) {
              e.preventDefault();

              let form = document.getElementById('productFormEditar');
              if (!form.checkValidity()) {
                  form.reportValidity();
                  return;
              }

              let formData = new FormData(form);

              $.ajax({
                  url: "{{ url('admin/daily-menu/update') }}/"+product_menu_id,
                  type: 'POST',
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function(response) {
                      console.log(response);
                      if (response.codigo == 0) {
                          Toast.fire({
                              icon: 'success',
                              title: response.mensaje,
                          });
                          $('#editarModalCiudad').modal('hide');
                          form.reset();
                          $('#table').html(response.data);
                      } else {
                          Toast.fire({
                              icon: 'error',
                              title: response.mensaje,
                          });
                      }
                  },
                  error: function(error) {
                      console.log(error);
                      Toast.fire({
                          icon: 'error',
                          title: 'Ocurrió un error al guardar el ciudad',
                      });
                  }
              });
            });
        });
        function editar(id, nombre, descripcion, precio, stock) {
            product_menu_id = id
            $('#productFormEditar input[name="nombre"]').val(nombre);
            $('#productFormEditar textarea[name="descripcion"]').val(descripcion);
            $('#productFormEditar input[name="precio"]').val(precio);
            $('#productFormEditar input[name="stock"]').val(stock);
            $('#editarModalCiudad').modal('show');
        }
        function eliminar(id, nombre, stock) {
          Swal.fire({
                title: '¿Estás seguro?',
                html: `Esta acción dara de baja al producto: <b>${nombre} con un stock de ${stock}</b>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Dar de baja',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:`{{url('admin/daily-menu/delete')}}/`+id,
                        type: "POST",
                        data:{
                            id_directivo: id,
                            _token: "{{csrf_token()}}",
                        },
                        success:function(response){
                            if(response.codigo == 0){
                                // $('#table').html(response.data);
                                // Toast.fire({
                                //     icon: 'success',
                                //     title: response.mensaje,
                                // });
                                Toast.fire({
                                    icon: 'success',
                                    title: response.mensaje,
                                });

                                setTimeout(() => {
                                    location.reload();
                                }, 1000); // 1 segundos después

                            }else{
                                Toast.fire({
                                    icon: 'error',
                                    title: response.mensaje,
                                });
                            }
                        },
                        error: function(err,err1,err2){

                        }
                    });
                }
            });
        }
    </script>
@endpush