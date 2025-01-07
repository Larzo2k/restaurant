@extends('admin.layouts.app')

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="card-header">
            <h3 class="card-title"> <a href="#" class="btn btn-sm btn-icon btn-light-success me-2" data-bs-toggle="tooltip"
                    data-bs-boundary="window" data-bs-placement="top" title="" data-bs-original-title="Atras"
                    aria-label="Atras"><i class="fa fa-arrow-left"></i></a>
                Lista de Proveedores </h3>
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
                    <i class="fa-solid fa-plus me-1"></i> Nuevo
                  </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="" id="table">
                @include('admin.proveedor.table')
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection

@section('modals')
    @include('admin.proveedor.modal.create')
    @include('admin.proveedor.modal.edit')
@endsection


@push('scripts')
    <script>
      let currentRequestAjax = null;   
        $(document).ready(function() {
          console.log("Script cargado correctamente.");
          //guardar directivos
          $('#proveedorForm').submit(function(e) {
              e.preventDefault();

              let form = document.getElementById('proveedorForm');
              if (!form.checkValidity()) {
                  form.reportValidity();
                  return;
              }

              let formData = new FormData(form);

              $.ajax({
                  url: "{{ url('admin/proveedor/store') }}",
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

          //editar directivo
          $('#proveedorFormEditar').submit(function(e) {
              e.preventDefault();

              let form = document.getElementById('proveedorFormEditar');
              if (!form.checkValidity()) {
                  form.reportValidity();
                  return;
              }

              let formData = new FormData(form);
              let id = $('#clienteFormEditar input[name="id"').val();
              $.ajax({
                  url: "{{ url('admin/proveedor/update') }}/"+id,
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

          //buscador
          $('#buscador').keyup(function(e) {
              console
                  page = 1;
                  currentRequestAjax = $.ajax({
                      type: "GET",
                      url: "{{ url('admin/proveedor') }}" + '?page=' + page,
                      data: {
                          buscador: $('#buscador').val(),
                      },
                      beforeSend: function() {
                          if (currentRequestAjax != null) {
                              currentRequestAjax.abort();
                          }
                      },
                      success: function(response) {
                          $('#table').html(response.data);
                          KTMenu.createInstances();
                      },
                      error: function(xhr, ajaxOptions, thrownError) {
                          console.log(xhr);
                      }
                  });

          });
        })
        function editar(id, name, address, email, cod, phone, image) {
          $('#proveedorFormEditar input[name="id"]').val(id);
          $('#proveedorFormEditar input[name="nombre"]').val(name);
          $('#proveedorFormEditar input[name="apellido"]').val(address);
          $('#proveedorFormEditar input[name="email"]').val(email);
          $('#proveedorFormEditar select[name="cod_pais"]').val(cod).change();
          $('#proveedorFormEditar input[name="telefono"]').val(phone);
          if (image != null && image!='') {
            console.log(image);
              $('#file-upload-image2').attr('src', `{{ asset('`+image+`') }}`);
              $('#image-upload-wrap2').hide();
              $('#file-upload-content2').show();
          } else{
              $('#image-upload-wrap2').show();
              $('#file-upload-content2').hide();
          }
          $('#editarModalCiudad').modal('show');
        }
        function eliminar(id, nombre, apellido) {
          Swal.fire({
                title: '¿Estás seguro?',
                html: `Esta acción dara de baja al directivo: <b>${nombre} ${apellido}</b>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Dar de baja',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:`{{url('admin/proveedor/delete')}}/`+id,
                        type: "POST",
                        data:{
                            id_directivo: id,
                            _token: "{{csrf_token()}}",
                        },
                        success:function(response){
                            if(response.codigo == 0){
                                $('#table').html(response.data);
                                Toast.fire({
                                    icon: 'success',
                                    title: response.mensaje,
                                });
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