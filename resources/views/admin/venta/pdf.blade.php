<!DOCTYPE html>
<html>

<head>
    <title>Comprobante de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header,
        .footer {
            text-align: center;
            padding: 10px;
        }

        .content {
            margin: 20px;
        }

        .details {
            width: 100%;
            border-collapse: collapse;
        }

        .details th,
        .details td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .details th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .items {}
    </style>
</head>

<body>

    <div class="header">
        <h1>Comprobante de Pago</h1>
    </div>

    <div class="content">
        <h2>Nota de Venta #{{ $venta->nro_recibo }}</h2>
        <p><strong>Monto:</strong> {{ $venta->total }} Bs</p>
        <p><strong>Fecha:</strong> {{ $venta->fecha }}</p>
        {{-- @foreach ($cliente as $item)
            @if ($item->id == $nota_venta->id_cliente) --}}
        <p><strong>Cliente:</strong> {{ $venta->customer->name }} {{ $venta->customer->address }}</p>
        {{-- @endif
        @endforeach --}}

        {{-- @foreach ($empleado as $item)
            @if ($item->id == $nota_venta->id_empleado) --}}
        <p><strong>Empleado:</strong> {{ $venta->user->name }}
        </p>
        {{-- @endif
        @endforeach --}}


        <h3>Detalles de Venta</h3>
        <table class="details">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->detalleVenta as $item)
                    <td>{{ $item->DailyMenuProduct->product->name }}</td>
                    <td>{{ $item->DailyMenuProduct->product->price }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->subtotal }}</td>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="display: table; margin-left: 20px;">
        <div class="items"></div>
        <div class="items">Total: <b>{{ $venta->total }} BS</b></div>
    </div>

    <div class="footer">
        <p>Gracias por su compra</p>
    </div>

</body>

</html>
