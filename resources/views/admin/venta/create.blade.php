@extends('admin.layouts.app')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 py-4">

                <!--Mostrar el stock-->

                <form id="form_venta" name="form_venta" class="form-horizontal" method="POST" action="" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="row">
                                    <label class="form-label">Buscar producto?</label>
                                </div>
                                <div class="input-group mb-3">
                                    <input class="form-control" id="medicamento" name="medicamento" type="text"
                                        placeholder="Ingrese el nombre del producto" autofocus>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#crearModalCondominio"><i class="fas fa-list-ol"></i></button>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4  mb-3">
                                <label class="form-label">Fecha:</label>
                                <input class="form-control" id="fecha" name="fecha" type="date"
                                    placeholder="Ingrese el nombre del producto" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="col-12 col-sm-4  mb-3">
                                <div class="ui-widget">
                                    <label class="form-label">Cliente:</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control" id="cliente2" name="cliente2" type="text"
                                            placeholder="Ingrese el nombre del cliente" required>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#crearModalCliente"><i class="fas fa-list-ol"></i></button>
                                    </div>

                                </div>
                            </div>
                            <input type="hidden" name="id_producto" id="id_producto">
                            <div class="col-12 col-sm-4  mb-3">
                                <div class="ui-widget">
                                    <label class="form-label">Cantidad:</label>
                                    <div class="input-group mb-3">
                                        <input type="number" min="1" class="form-control" id="cantidad"
                                            name="cantidad" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4  mb-3">
                                <div class="ui-widget">
                                    <label class="form-label">Precio:</label>
                                    <div class="input-group mb-3">
                                        <input class="form-control" id="precio" name="precio" type="text" disabled>
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

                            <div class="col-12 col-sm-4">
                                <div class="container-fluid px-0 py-2">
                                    <button class="btn btn-primary" id="agregar_producto" name="agregar_producto"
                                        type="button">Agregar
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
                                <th style="color: #fff">Precio</th>
                                <th style="color: #fff">Cantidad</th>
                                <th style="color: #fff">Subtotal</th>
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
                        <button class="btn btn-success" type="button" id="completa_venta">VENDER</button>
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
            <td>1</td>
            <td>2$ individual</td>
            <td>BS. <span>500</span></td>
            <td>
                <button class="btn btn-info btn-sm" style="background-color: #fff; border:none"><i
                        class="fa-solid fa-trash-can" style="color:red; font-size:15px"></i></button>
            </td>
        </tr>
    </template>
@endsection

@section('modals')
    @include('admin.venta.modal.customer')
    @include('admin.venta.modal.product')
@endsection

@push('scripts')
    <script>
        carrito = [];
        //variables
        let id_cliente;
        //variable producto
        let id_producto, nombre_producto, precio_producto, cantidad_producto, subtotal_producto, stock_producto;
        const completarVenta = document.getElementById('completa_venta');
        let id_empleado;
        //proveedor
        let id_proveedor = "";


        $(document).ready(function() {
            //aqui vamos a poner lo de 
            $('#cantidad').on('input', function() {
                let cantidad = parseInt($('#cantidad').val());
                let subtotal = cantidad * parseFloat($('#precio').val());

                cantidad_producto = cantidad;
                subtotal_producto = subtotal;

                // Mostrar el subtotal en el campo correspondiente
                $('#subtotal').val(subtotal.toFixed(2));
            });
        })

        function agregarAdata(id, nombre, apellido) {
            id_proveedor = id;
            $('#crearModalCliente').modal('hide');
            $('#cliente2').val(nombre + ' ' + apellido);
        }

        function cargarProducto(id, nombre, stock, precio) {
            $('#id_producto').val(id);
            $('#medicamento').val(nombre);
            $('#precio').val(precio);
            $('#cantidad').val('1');
            $('#cantidad').attr('max', stock);
            controlarInput();

            // Multiplicar la cantidad por el precio para obtener el subtotal
            let cantidad = parseInt($('#cantidad').val());
            let subtotal = cantidad * parseFloat($('#precio').val());
            // Mostrar el subtotal en el campo correspondiente
            $('#subtotal').val(subtotal.toFixed(2)); // Redondear el subtotal a 2 decimales
            $('#crearModalCondominio').modal('hide');
            //agregar a las variables
            id_producto = id;
            nombre_producto = nombre;
            precio_producto = precio;
            cantidad_producto = cantidad;
            subtotal_producto = subtotal;
            stock_producto = stock
        }

        //parte para agregar al carrito
        agregar_producto.addEventListener('click', function() {
            if (inputCompletado()) {
                subtotal = parseFloat($('#cantidad').val()) * parseFloat($('#precio').val());
                if (existeElDato(carrito, $('#medicamento').val()) == false) {
                    const producto = {
                        nombre: $('#medicamento').val(),
                        precio_venta: $('#precio').val(),
                        cantidad: $('#cantidad').val(),
                        subtotal: parseFloat($('#cantidad').val()) * parseFloat($('#precio').val()),
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
                } else {
                    //incrementarCantidad();
                    AgregarCantidadCarrito();
                }
                pintarCarrito();
                limpiarImput();
            } else {
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
                template.querySelectorAll("td")[1].textContent = producto.precio_venta;
                template.querySelectorAll("td")[2].textContent = producto.cantidad;
                template.querySelector("span").textContent = producto.precio_venta * producto.cantidad;

                // Botones
                template.querySelector(".btn-info").dataset.id = producto.id_producto;

                const clone = template.cloneNode(true);
                clone.querySelector(".btn-info").addEventListener("click", () => {
                    event.preventDefault();
                    eliminarProducto(producto.nombre);
                });
                fragment.appendChild(clone);
            });

            tabla.appendChild(fragment);
        }

        function eliminarProducto(name) {
            carrito = carrito.filter((producto) => producto.nombre !== name);
            actualizarTotal();
            pintarCarrito();
        }

        function actualizarTotal() {
            // Sumar los subtotales de todos los productos en el carrito
            const nuevoTotal = carrito.reduce((acc, producto) => acc + producto.subtotal, 0);

            // Actualizar el campo de total con el nuevo total
            $('#total').val(nuevoTotal.toFixed(2)); // El valor se redondea a dos decimales
        }
        //verificar si el dato ingresando ya existe
        function existeElDato(carrito, id) {
            let existe = false;
            carrito.forEach(element => {
                console.log(element.nombre, id);
                if (element.nombre == id) {
                    existe = true;
                }
            });
            return existe;
        }

        //incrementar la cantidad si es que ya existe el datos
        // function incrementarCantidad(carrito, id, cantidad,subtotal){
        //   carrito.forEach(element => {
        //   console.log(element.id_producto,id);
        //     if(element.id_producto==id){
        //       element.cantidad=parseFloat(element.cantidad)+parseFloat(cantidad);
        //       element.subtotal = parseFloat(element.subtotal)+parseFloat(subtotal);
        //     }
        //   });
        //   return carrito;
        // }
        function AgregarCantidadCarrito() {
            let producto = $('#medicamento').val();
            let total = 0;
            let bandera;
            carrito.forEach(element => {
                if (element.nombre == producto) {
                    bandera = verifiStockProduct(element.cantidad);
                    if (bandera == false) {
                        //break;
                        return 0;
                    }
                    element.cantidad = parseFloat(element.cantidad) + parseFloat($('#cantidad').val());
                    element.subtotal = parseFloat(element.cantidad) * parseFloat(element.precio_venta);
                }
                total += parseFloat(element.subtotal);
            });
            if (bandera == true) {
                $('#total').val(total.toFixed(2));
            }
        }

        function inputCompletado() {
            let bandera = false;
            if ($('#medicamento').val() != "" && $('#fecha').val() != "" && $('#precio').val() > 0 && $('#precio').val() >
                0 && $('#cantidad').val() > 0) {
                bandera = true
            }
            return bandera;
        }

        function limpiarImput() {
            $('#medicamento').val('');
            $('#precio_compra').val('');
            $('#precio').val('');
            $('#cantidad').val('');
            $('#almacen').val('');
            $('#subtotal').val('');
        }

        function controlarInput() {
            $('#cantidad').on('input', function() {
                let max = parseFloat($(this).attr('max'));
                let value = parseFloat($(this).val());

                if (value > max) {
                    $(this).val(max); // Ajusta el valor al máximo permitido
                    $('#subtotal').val(max * parseFloat($('#precio').val()));
                }
            });
        }

        function verifiStockProduct(cantidad) {
            let bandera = true;
            let cantidadtOTAL = parseFloat(cantidad) + parseFloat($('#cantidad').val());
            console.log(cantidadtOTAL, stock_producto);
            if (cantidadtOTAL > stock_producto) {
                bandera = false;
            }
            return bandera;
        }
        completarVenta.addEventListener('click', function() {
            console.log(id_proveedor);
            if (id_proveedor == "") {
                Swal.fire({
                    icon: "error",
                    title: "Asignar un cliente",
                    text: "Por favor rellenar los campos!",
                }).then(() => {
                    // Solo se ejecuta después que el usuario cierre el Swal
                    animateInput($('#cliente2'));
                });
                return;
            }
            const extra = {
                id_empleado: id_empleado,
                id_cliente: id_proveedor,
                fecha: fecha.value,
                total: total.value,
                productos: carrito,
            };
            console.log(extra);
            $.ajax({
                url: "{{ url('admin/venta/store') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: 'application/json', // Cambiamos a application/json
                processData: false, // No procesar los datos
                data: JSON.stringify(extra), // Convertimos los datos a JSON
                success: function(response) {
                    if (response.codigo === 0) {
                        // Swal.fire({
                        //     text: response.mensaje,
                        //     icon: 'success',
                        //     confirmButtonText: 'Ok'
                        // })
                        // //limpiar la tabla y el total
                        // tabla.innerHTML = "";
                        // total.value = '0.00';
                        // window.open("{{ url('admin/venta/pdf') }}/" + response.data.id, '_blank');
                        Swal.fire({
                            text: response.mensaje,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            // Esperar 2 segundos (2000 ms)
                            setTimeout(function() {
                                // Abrir el PDF en una nueva pestaña
                                window.open("{{ url('admin/venta/pdf') }}/" + response
                                    .data.id, '_blank');
                                // Redireccionar a otra URL (opcional)
                                window.location.href = "{{ url('admin/venta') }}";
                            }, 2000);
                        });

                        // Limpiar después del Swal
                        tabla.innerHTML = "";
                        total.value = '0.00';
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
        });

        function animateInput(input) {
            // Scroll hacia el input suavemente
            $('html, body').animate({
                scrollTop: input.offset().top - 100 // Ajusta -100 para dejar un espacio visual
            }, 500, function() {
                // Agrega la animación de shake
                input.addClass('animate__animated animate__shakeX');

                // Parpadeo cambiando el fondo varias veces
                let originalBg = input.css('background-color');
                let i = 0;
                let blinkInterval = setInterval(() => {
                    input.css('background-color', i % 2 === 0 ? '#f8d7da' : originalBg);
                    i++;
                    if (i > 5) {
                        clearInterval(blinkInterval);
                        input.css('background-color', originalBg); // Restaurar color original
                    }
                }, 150);

                // Remover la clase de animación después de 1s
                setTimeout(function() {
                    input.removeClass('animate__animated animate__shakeX');
                }, 1000);
            });
        }
    </script>
@endpush
