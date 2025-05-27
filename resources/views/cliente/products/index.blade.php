@extends('cliente.layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">
        @forelse($products as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($producto->image)
                        <img src="{{ asset($producto->image) }}" height="100" class="card-img-top" alt="{{ $producto->name }}">
                    @else
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Sin imagen">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->name }}</h5>
                        <p class="card-text">{{ $producto->description }}</p>
                        <p class="card-text"><strong>Precio:</strong> Bs {{ number_format($producto->price, 2) }}</p>
                        <p><strong>Stock:</strong> {{ $producto->dailyMenuProduct->stock }}</p>
                        <a  onclick="addToCart(`{{ $producto->id }}`, `{{ $producto->name }}`, `{{ $producto->price }}`, `{{ $producto->dailyMenuProduct->stock }}`)">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="16" height="16"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No hay productos disponibles por el momento.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

{{-- @push('scripts')
    <script>
        let carrito = [];
        function addToCart(id, name, price) {
          if(verifyInCart(name)){
            carrito.forEach(element => {
                if(element.name == name){
                    element.cantidad++;
                }
            });
          }else{
            carrito.push({
                id: id,
                name: name,
                price: price,
                cantidad: 1
            });
          }
            console.log(carrito);
            $('#carrito_cantidad').text(carrito.length);
            localStorage.setItem('carrito', JSON.stringify(carrito));
        }
        function verifyInCart(name){
            let inCart = false;
            carrito.forEach(element => {
                if(element.name == name){
                    inCart = true;
                }
            });
            return inCart;
        }
    </script>
@endpush --}}
@push('scripts')
<script>
    // Cargar carrito desde localStorage al iniciar
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    // Mostrar cantidad total al cargar
    document.addEventListener("DOMContentLoaded", function () {
        actualizarCantidadCarrito();
    });

    function addToCart(id, name, price, stock) {
        let found = false;

        // Si ya está en el carrito, aumenta la cantidad
        carrito.forEach(item => {
            if (item.name === name) {
                if (item.cantidad < stock) {
                    item.cantidad++;
                    Toast.fire({
                        icon: 'success',
                        title: 'Producto agregado al carrito'
                    })
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: 'No hay stock suficiente'
                  })
                }
                found = true;
            }
        });

        // Si no está, lo agrega al carrito
        if (!found) {
            carrito.push({
                id: id,
                name: name,
                price: price,
                cantidad: 1
            });
        }

        // Guardar en localStorage
        localStorage.setItem('carrito', JSON.stringify(carrito));

        // Actualizar la cantidad visible
        actualizarCantidadCarrito();
        console.log(carrito);
    }

    function verifyInCart(name) {
        return carrito.some(item => item.name === name);
    }

    function actualizarCantidadCarrito() {
        // let total = carrito.reduce((sum, item) => sum + item.cantidad, 0);
        let total = carrito.length;
        $('#carrito_cantidad').text(total);
    }
</script>
@endpush
