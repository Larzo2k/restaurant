<div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 
    menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 
    fw-bold my-5 my-lg-0 align-items-stretch" id="kt_app_header_menu" data-kt-menu="true">

    <!-- Inicio -->
    <div class="menu-item">
        <a class="menu-link py-3" href="{{ route('cliente.products.index') }}">
            <span class="menu-title">Productos</span>
        </a>
    </div>

    <!-- Condominios -->
    <div class="menu-item">
        <a class="menu-link py-3" href="">
            <span class="menu-title">Condominios</span>
        </a>
    </div>

    <!-- Gastos -->
    <div class="menu-item">
        <a class="menu-link py-3" href="">
            <span class="menu-title">Gastos</span>
        </a>
    </div>

    <div class="menu-item position-relative">
        <a class="menu-link py-3" href="{{ route('cliente.products.carrito') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="24" height="24">
                <path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
            </svg>
            {{-- @php
                $cantidadCarrito = session('carrito') ? count(session('carrito')) : 0;
            @endphp --}}
            {{-- @if($cantidadCarrito > 0) --}}
                <span class="position-absolute badge rounded-pill bg-danger" style="top: 5px; right: 0px;" id="carrito_cantidad">
                    {{-- {{ $cantidadCarrito }} --}}
                    0
                </span>
            {{-- @endif --}}
        </a>
    </div>
  
  
</div>
