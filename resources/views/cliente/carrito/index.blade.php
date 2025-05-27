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
@endsection
@push('scripts')
  <script>
      document.addEventListener("DOMContentLoaded", function () {
          renderizarCarrito();
      });

      function renderizarCarrito() {
          let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
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

      function checkout() {
          alert('Gracias por tu compra. Procesando...');
          // Aquí puedes enviar el carrito al backend o redirigir a una pasarela de pago.
      }
  </script>
@endpush