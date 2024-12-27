@extends('admin.layouts.app')

@section('content')
    <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4 py-4">

        <!--Mostrar el stock-->

        <form id="form_venta" name="form_venta" class="form-horizontal" method="POST"
          action="" autocomplete="off">

          <div class="form-group">
            <input type="hidden" id="id_producto" name="id_producto" />
            <div class="row">
              <div class="col-12 col-sm-4">
                <div class="row">
                  <label class="form-label">Buscar medicamento?</label>
                </div>
                <div class="input-group mb-3">
                  <input class="form-control" id="medicamento" name="medicamento" type="text"
                    placeholder="Ingrese el nombre del medicamento" autofocus>
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#crearModalCondominio"><i
                      class="fas fa-list-ol"></i></button>
                </div>
              </div>
              <div class="col-12 col-sm-4  mb-3">
                <label class="form-label">Fecha:</label>
                 <input class="form-control" id="fecha" name="fecha" type="date"
                    placeholder="Ingrese el nombre del producto"  value="<?php echo date('Y-m-d'); ?>">
              </div>
              <div class="col-12 col-sm-4  mb-3">
                <div class="ui-widget">
                  <label class="form-label">Proveedor:</label>
                <div class="input-group mb-3">
                  <input class="form-control" id="proveedor" name="proveedor" type="text"
                    placeholder="Ingrese el nombre del proveedor">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#crearModalProveedor"><i
                      class="fas fa-list-ol"></i></button>
                </div>
                    
                </div>
              </div>
              <div class="col-12 col-sm-4  mb-3">
                <div class="ui-widget">
                  <label class="form-label">Cantidad:</label>
                  <div class="input-group mb-3">
                    <input type="number" min="1" class="form-control" id="cantidad" name="cantidad" type="text">
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-4  mb-3">
                <div class="ui-widget">
                  <label class="form-label">Precio compra:</label>
                  <div class="input-group mb-3">
                    <input class="form-control" id="precio_compra" name="precio_compra" type="number">
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-4  mb-3">
                <div class="ui-widget">
                  <label class="form-label">Precio venta:</label>
                  <div class="input-group mb-3">
                    <input class="form-control" id="precio" name="precio_venta" type="number">
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-4  mb-3">
                <div class="ui-widget">
                  <label class="form-label">Subtotal:</label>
                  <div class="input-group mb-3">
                    <input class="form-control" id="subtotal" name="subtotal" type="text" disabled>
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-4 mt-6">
                <div class="container-fluid px-0 py-2">
                  <button class="btn btn-primary" id="agregar_producto" name="agregar_producto" type="button">Agregar
                    producto</button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="table-responsive">
            <table id="tablaProductos" class="table table-bordered table-hover">
              <thead class="table-dark ">
                <th style="color: #fff">#</th>
                <th style="color: #fff">Nombre</th>
                <th style="color: #fff">Descripción</th>
                <th style="color: #fff">Precio</th>
                <th style="color: #fff">Cantidad</th>
                <th style="color: #fff">Subtotal</th>
                <th width="1%"></th>
                <th width="1%"></th>
              </thead>
              <tbody id="table"></tbody>
            </table>
          </div>
          <br>
          <div class="d-grid gap-3 d-md-flex justify-content-md-end  mb-3">
            <label style="font-weight: bold; font-size: 30px; text-align: center;">Total Bs.</label>
            <input type="text" id="total" name="total" size="7" readonly="true" value="0.00"
              style="font-weight: bold; font-size: 30px; text-align: center;" />
            <button class="btn btn-success" type="button" id="completa_venta">COMPRAR</button>
          </div>
        </form>
      </div>
    </main>
  </div>

  <!--Template carrito-->
  <template id="template-carrito">
    <tr>
      <th scope="row">id</th>
      <td>Café</td>
      <td>Bebida</td>
      <td>1</td>
      <td>2$ individual</td>
      <td>BS. <span>500</span></td>
      <td>
        <button class="btn btn-info btn-sm" style="background-color: #fff; border:none"><i class="fa-solid fa-trash-can" style="color:red; font-size:15px"></i></button>
      </td>
    </tr>
  </template>
@endsection

@section('modals')
  @include('admin.compra.modal.product')
  @include('admin.compra.modal.proveedor')
@endsection

@push('scripts')
    <script>
    carrito=[];
    //variables
    let id_proveedor;
    //variable producto
    let id_producto, nombre_producto, precio_producto, cantidad_producto, subtotal_producto, stock_producto;
    const completarVenta = document.getElementById('completa_venta');
    let id_empleado;


     $(document).ready(function(){
      //aqui vamos a poner lo de 
        $('#cantidad').on('input', function() {
            let cantidad = parseInt($('#cantidad').val());
            let subtotal = cantidad * parseFloat($('#precio').val());
            
            cantidad_producto=cantidad;
            subtotal_producto=subtotal;

            // Mostrar el subtotal en el campo correspondiente
            $('#subtotal').val(subtotal.toFixed(2));
        });
     })

     function agregarAdata(id,nombre, apellido) {
        id_proveedor=id;
        $('#crearModalProveedor').modal('hide');
        $('#proveedor').val(nombre + ' ' + apellido);
     }
     function cargarProducto(id,nombre,precio,stock){
      $('#id_producto').val(id);
      $('#medicamento').val(nombre);
      $('#precio').val(precio);
      $('#cantidad').val('1');

      // Multiplicar la cantidad por el precio para obtener el subtotal
      let cantidad = parseInt($('#cantidad').val());
      let subtotal = cantidad * parseFloat(precio);
      
      // Mostrar el subtotal en el campo correspondiente
      $('#subtotal').val(subtotal.toFixed(2)); // Redondear el subtotal a 2 decimales
      $('#crearModalCondominio').modal('hide');
      //agregar a las variables
      id_producto=id;
      nombre_producto=nombre;
      precio_producto=precio;
      cantidad_producto=cantidad;
      subtotal_producto=subtotal;
      stock_producto=stock
    }

    //parte para agregar al carrito
    agregar_producto.addEventListener('click', function () {
      if(inputCompletado()){
        subtotal=parseFloat($('#cantidad').val())*parseFloat($('#precio_compra').val());
          if(existeElDato(carrito,$('#medicamento').val())==false){
            const producto = {
              nombre:$('#medicamento').val(),
              precio_venta:$('#precio').val(),
              cantidad:$('#cantidad').val(),
              precio:$('#precio_compra').val(),
              subtotal:parseFloat($('#cantidad').val())*parseFloat($('#precio_compra').val()),
            }
            console.log(producto);
            // Obtener el valor actual del total
              let totalActual = parseFloat($('#total').val());
              // Calcular el nuevo total sumando el subtotal
              let nuevoTotal = totalActual + parseFloat(subtotal);
              // Actualizar el valor del input con el nuevo total
              $('#total').val(nuevoTotal.toFixed(2));
            // Agregar el producto al carrito
            carrito.push(producto);
            console.log(carrito);
          }
          pintarCarrito();
          limpiarImput();
      }else{
        Swal.fire({
          icon: "error",
          title: "Rellenar Todos los campos",
          text: "Por favor rellenar los campos!",
        });
      }
      
    });

    // Función para dibujar el carrito
    const tabla = document.getElementById("table");

    const pintarCarrito = () => {
      // Limpiamos lo que tiene la tabla
      tabla.innerHTML = "";

      const template = document.getElementById("template-carrito").content;
      const fragment = document.createDocumentFragment();

      carrito.forEach((producto) => {
        template.querySelector("th").textContent = producto.id_producto;
        template.querySelectorAll("td")[0].textContent = producto.nombre;
        template.querySelectorAll("td")[2].textContent = producto.precio;
        template.querySelectorAll("td")[3].textContent = producto.cantidad;
        template.querySelector("span").textContent = producto.precio * producto.cantidad;

        // Botones
        template.querySelector(".btn-info").dataset.id = producto.id_producto;

        const clone = template.cloneNode(true);
        fragment.appendChild(clone);
      });

      tabla.appendChild(fragment);
    }

    //verificar si el dato ingresando ya existe
  function existeElDato(carrito,id){
    let existe=false;
    carrito.forEach(element => {
      if(element.id_producto==id){
        existe=true;
      }
    });
    return existe;
  }

  //incrementar la cantidad si es que ya existe el datos
  function incrementarCantidad(carrito, id, cantidad,subtotal){
    carrito.forEach(element => {
      if(element.id_producto==id){
        element.cantidad=parseFloat(element.cantidad)+parseFloat(cantidad);
        element.subtotal = parseFloat(element.subtotal)+parseFloat(subtotal);
      }
    });
    return carrito;
  }
  function inputCompletado(){
      let bandera=false;
      if($('#medicamento').val()!="" && $('#fecha').val()!="" && $('#precio').val()>0 && $('#precio_compra').val()>0 && $('#cantidad').val()>0){
        bandera=true
      }
      return bandera;
  }
  function limpiarImput(){
      $('#medicamento').val('');
      $('#precio_compra').val('');
      $('#precio').val('');
      $('#cantidad').val('');
      $('#almacen').val('');
      $('#subtotal').val('');
  }
  completarVenta.addEventListener('click', function () {
      const extra = {
        id_empleado:id_empleado,
        id_proveedor: id_proveedor,
        fecha:fecha.value,
        total: total.value,
        productos : carrito,
      };
      console.log(extra);
      $.ajax({
        url: "{{ url('api/nota_compra/store') }}",
        type: 'POST',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('accessToken')
        },
        contentType: 'application/json', // Cambiamos a application/json
        processData: false, // No procesar los datos
        data: JSON.stringify(extra), // Convertimos los datos a JSON
        success: function(response) {
            if (response.codigo === 0) {
                Swal.fire({
                    text: response.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Error al crear la compra',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            }
        },
        error: function(error) {
            console.error(error);
            Swal.fire({
                title: 'Error!',
                text: 'Error al crear la compra',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
        }
      });
      //limpiar la tabla y el total
      tabla.innerHTML = "";
      total.value='0.00';
    });
    
  </script>
@endpush