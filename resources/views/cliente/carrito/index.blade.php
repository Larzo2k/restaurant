@extends('cliente.layouts.main') {{-- Solo si usas Laravel --}}
@section('content')
  <div class="container mt-5">
      <h2 class="mb-4">Carrito de Compras</h2>

      <div id="carrito-container">
          <!-- Se llena con JS -->
      </div>

      <div class="text-end mt-4">
          <h4>Total: <span id="carrito-total">Bs 0.00</span></h4>
          <button class="btn btn-success" onclick="checkout()">Finalizar Compra</button>
      </div>
  </div>
  @include('cliente.carrito.modal.qr')
@endsection
@push('scripts')
  <script>
        let carrito = [];
        let qrMovimiento = '';
        let finishPromise = false;
        document.addEventListener("DOMContentLoaded", function () {
            renderizarCarrito();
            // generateQrPedido({id: '902fca5d-99e7-498d-8d2f-3f698b6b380f'});
        });

        function renderizarCarrito() {
            carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            let container = document.getElementById('carrito-container');
            container.innerHTML = '';

            if (carrito.length === 0) {
                // let total = carrito.length;
                container.innerHTML = '<div class="alert alert-info">Tu carrito está vacío.</div>';
                document.getElementById('carrito-total').textContent = 'Bs 0.00';
                return;
            }
            $('#carrito_cantidad').text(carrito.length);
            let total = 0;
            let table = `
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        ${carrito.map((item, index) => {
                            let subtotal = item.price * item.cantidad;
                            total += subtotal;
                            return `
                                <tr>
                                    <td>${item.name}</td>
                                    <td>Bs ${item.price}</td>
                                    <td>
                                        <input type="number" min="1" max="${item.stock}" value="${item.cantidad}" 
                                            onchange="actualizarCantidad(${index}, this.value)" class="form-control form-control-sm" style="width: 80px;">
                                    </td>
                                    <td>Bs ${subtotal.toFixed(2)}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="eliminarItem(${index})">Eliminar</button>
                                    </td>
                                </tr>
                            `;
                        }).join('')}
                    </tbody>
                </table>
            `;

            container.innerHTML = table;
            document.getElementById('carrito-total').textContent = `Bs ${total.toFixed(2)}`;
        }

        function actualizarCantidad(index, nuevaCantidad) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            nuevaCantidad = parseInt(nuevaCantidad);

            if (nuevaCantidad <= carrito[index].stock) {
                carrito[index].cantidad = nuevaCantidad;
            } else {
                alert('Cantidad supera el stock disponible.');
            }

            localStorage.setItem('carrito', JSON.stringify(carrito));
            renderizarCarrito();
        }

        function eliminarItem(index) {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            carrito.splice(index, 1);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            renderizarCarrito();

        }

        function checkout(){
            if(carrito.length == 0){
                Toast.fire({
                    icon: 'error',
                    title: 'El carrito esta vacio',
                })
                return;
            }
            LoadingAnimado();
            setTimeout(() => {
                $.ajax({
                                url:`{{url('cliente/carrito/store')}}`,
                                type: "POST",
                                data:{
                                    carrito: carrito,
                                    total: document.getElementById('carrito-total').textContent,
                                    _token: "{{csrf_token()}}",
                                },
                                success:function(response){
                                    // LoadingAnimadoHiden();
                                    if(response.codigo == 0){
                                        // Toast.fire({
                                        //     icon: 'success',
                                        //     title: response.mensaje,
                                        // });
                                        console.log(response.data);
                                        localStorage.removeItem('carrito');
                                        renderizarCarrito();
                                        generateQrPedido(response.data);
                                        // window.location.href = "{{url('cliente/pedido')}}";
                                    }else{
                                        // LoadingAnimadoHiden();
                                        Toast.fire({
                                            icon: 'error',
                                            title: response.mensaje,
                                        });
                                    }
                                },
                                error: function(err,err1,err2){
                                    LoadingAnimadoHiden();
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'Ocurrio un error al completar la compra',
                                    });
                                }
                });
            }, 3000);
        }

    //   function checkout(){
    //     if(carrito.length == 0){
    //         Toast.fire({
    //             icon: 'error',
    //             title: 'El carrito esta vacio',
    //         })
    //         return;
    //     }
    //     Swal.fire({
    //             title: '¿Estás seguro?',
    //             html: `Esta acción completara la compra`,
    //             icon: 'warning',
    //             showCancelButton: true,
    //             confirmButtonText: 'Completar',
    //             cancelButtonText: 'Cancelar'
    //         }).then((result) => {
    //             if (result.isConfirmed) {
    //                 LoadingAnimado();
    //                 setTimeout(() => {
    //                 }, 10000);
    //                 $.ajax({
    //                     url:`{{url('cliente/carrito/store')}}`,
    //                     type: "POST",
    //                     data:{
    //                         carrito: carrito,
    //                         total: document.getElementById('carrito-total').textContent,
    //                         _token: "{{csrf_token()}}",
    //                     },
    //                     success:function(response){
    //                         LoadingAnimadoHiden();
    //                         if(response.codigo == 0){
    //                             Toast.fire({
    //                                 icon: 'success',
    //                                 title: response.mensaje,
    //                             });
    //                             localStorage.removeItem('carrito');
    //                             renderizarCarrito();
    //                             window.location.href = "{{url('cliente/pedido')}}";
    //                         }else{
    //                             LoadingAnimadoHiden();
    //                             Toast.fire({
    //                                 icon: 'error',
    //                                 title: response.mensaje,
    //                             });
    //                         }
    //                     },
    //                     error: function(err,err1,err2){
    //                         LoadingAnimadoHiden();
    //                         Toast.fire({
    //                             icon: 'error',
    //                             title: 'Ocurrio un error al completar la compra',
    //                         });
    //                     }
    //                 });
    //             }
    //         });
    //   }

        function generateQrPedido(data){
            let pedido_id = data.id;
            // LoadingAnimado();
            $.ajax({
                url:`{{url('cliente/generate-qr')}}`,
                type: "POST",
                data:{
                    pedido_id: pedido_id,
                    _token: "{{csrf_token()}}",
                },
                success:function(response){
                    LoadingAnimadoHiden();
                    console.log(response);
                    if(response.codigo == 0){
                        Toast.fire({
                            icon: 'success',
                            title: response.mensaje,
                        });
                        //mostrar modal con qr
                        qrMovimiento = response.data.movimiento_id;
                        paymentVerifier();
                        showModalQr(response.data);
                    }else{
                        LoadingAnimadoHiden();
                        Toast.fire({
                            icon: 'error',
                            title: response.mensaje,
                        });
                    }
                },
                error: function(err,err1,err2){
                    LoadingAnimadoHiden();
                    Toast.fire({
                        icon: 'error',
                        title: 'Ocurrio un error al completar la compra',
                    });
                }
            });
        }

        function showModalQr(data){
            let ruta = data.qr_image;
            $('#modalQr').modal('show');
            let imageWrapper = $('#profileImage .image-input-wrapper');
            imageWrapper.css('background-image', `url(${ruta})`);
            imageWrapper.css('background-size', 'cover'); // Ajusta el tamaño
            imageWrapper.css('background-position', 'center'); // Centra la imagen
        }

        function downloadQr(event){
            event.preventDefault();
            let imageWrapper = $('#profileImage .image-input-wrapper');

            // Obtener la URL de la imagen de fondo
            let imageUrl = imageWrapper.css('background-image');

            // Extraer la URL eliminando 'url("...")'
            imageUrl = imageUrl.replace(/^url\(["']?/, '').replace(/["']?\)$/, '');

            // Verificar si la URL es válida
            if (!imageUrl || imageUrl === 'none') {
                alert("No se encontró la imagen para descargar.");
                return;
            }

            // Convertir la URL a absoluta si es relativa
            if (!imageUrl.startsWith('http')) {
                imageUrl = new URL(imageUrl, window.location.origin).href;
            }

            // Crear un enlace temporal para la descarga
            let link = document.createElement('a');
            link.href = imageUrl;
            link.download = 'codigo_qr.png'; // Nombre del archivo de descarga
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        //verificar el pago del qr 
        function paymentVerifier()
        {
            finishPromise = false;
            makeVerifierPaymentQr();
        }

        function makeVerifierPaymentQr() {
            runVerifierPaymentQr().then((res) => {
                console.log('respuesta: ',res);
                if(res == 'ok') {
                    $('#verification_payment').addClass('d-none');
                    //Swal.fire('Éxito', 'Pago verificado con éxito', 'success');
                    Swal.fire({
                        title: 'Pago verificado con éxito!',
                        html: `
                            <div id="confetti-container" style="height: 200px"></div>
                        `,
                        icon: 'success',
                        showConfirmButton: false,
                        didOpen: () => {
                            showConfetti();
                        }
                    });
                    setTimeout(() => {
                        window.location.href = '/cliente/pedido';
                        // window.location.reload();
                    }, 2000);
                }
            }).catch(() => {
                makeVerifierPaymentQr();
            });
        }
        function showConfetti() {
            var confettiContainer = document.getElementById('confetti-container');
            lottie.loadAnimation({
                container: confettiContainer, // el contenedor donde se reproducirá la animación
                renderer: 'svg',
                loop: false,
                autoplay: true,
                speed: 0.20, // velocidad de la animación ,
                path: '/animate/conffeti.json' // ruta al archivo JSON de la animación
            });
        }

        async function runVerifierPaymentQr() {

            if(finishPromise) return new Promise(resolve => resolve());

            await new Promise(resolve => setTimeout(resolve, 5000));

            return await new Promise((resolve, reject) => {
                let formData = new FormData();
                formData.append('qrMovimiento', qrMovimiento);
                formData.append('_token', '{{ csrf_token() }}');
                $.ajax({
                    url: '/cliente/pedido/verify-payment',
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    async: true,
                    processData: false,
                    contentType: false,
                    beforeSend() {
                        if(finishPromise) reject();
                    },
                    success: function(response) {
                        finishPromise = true;
                        resolve('ok');
                    },
                    error: function() {
                        reject();
                    },
                });
            });
        }
  </script>
@endpush