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
        <h2>Nota de Pedido #{{ $pedido->nro_recibo }}</h2>
        <p><strong>Monto:</strong> {{ $pedido->total }} Bs</p>
        <p><strong>Fecha:</strong> {{ $pedido->fecha }}</p>
        <p><strong>Cliente:</strong> {{ $pedido->customer->name }} {{ $pedido->customer->address }}</p>
        {{-- <p><strong>Empleado:</strong> {{ $venta->user->name }}
        </p> --}}


        <h3>Detalles del Pedido</h3>
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
                @foreach ($pedido->detallePedido as $item)
                    <td>{{ $item->DailyMenuProduct->product->name }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>{{ $item->DailyMenuProduct->product->price }}</td>
                    <td>{{ $item->subtotal }}</td>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="display: table; margin-left: 20px;">
        <div class="items"></div>
        <div class="items">Total: <b>{{ $pedido->total }} BS</b></div>
    </div>

    <div class="footer">
        <p>Gracias por su pedido!</p>
    </div>

</body>

</html>
