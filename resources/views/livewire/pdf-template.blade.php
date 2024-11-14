<!-- resources/views/livewire/pdf-compra.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comprobante de Compra - YaVentas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ff6e11;
            padding-bottom: 10px;
        }
        .logo {
            margin-bottom: 15px;
        }
        .orden-info {
            margin-bottom: 30px;
        }
        .cliente-info {
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .totales {
            float: right;
            width: 300px;
            margin-bottom: 30px;
        }
        .mensaje {
            clear: both;
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>YaVentas</h1>
    <p>Comprobante de Compra</p>
</div>

<div class="orden-info">
    <h3>Información de la Orden</h3>
    <p>Número de Orden: #{{ $order->id }}</p>
    <p>Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <p>Método de Pago: {{ ucfirst($order->metodopago) }}</p>
</div>

<div class="cliente-info">
    <h3>Información del Cliente</h3>
    <p>Nombre: {{ $order->nombre }}</p>
    <p>Dirección: {{ $order->direccion }}</p>
    <p>País: {{ $order->pais }}</p>
    <p>Provincia: {{ $order->provincia }}</p>
    <p>Municipio: {{ $order->municipio }}</p>
    <p>Teléfono: {{ $order->telefono }}</p>
</div>

<h3>Detalles de la Compra</h3>
<table>
    <thead>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orderDetails as $detail)
        <tr>
            <td>{{ $detail->producto->nombre }}</td>
            <td>{{ $detail->cantidad }}</td>
            <td>${{ number_format($detail->precio, 2) }}</td>
            <td>${{ number_format($detail->total, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="totales">
    <table>
        <tr>
            <td>Subtotal:</td>
            <td>${{ number_format($order->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td>Envío:</td>
            <td>${{ number_format($order->envio, 2) }}</td>
        </tr>
        <tr>
            <td><strong>Total:</strong></td>
            <td><strong>${{ number_format($order->total, 2) }}</strong></td>
        </tr>
    </table>
</div>

<div class="mensaje">
    <h3>¡Gracias por tu compra!</h3>
    <p>Apreciamos tu confianza en YaVentas. Nos pondremos en contacto contigo pronto para coordinar la entrega de tu pedido.</p>
    @if($order->comentarios)
        <p><strong>Comentarios adicionales:</strong> {{ $order->comentarios }}</p>
    @endif
</div>

<div class="footer">
    <p>Para cualquier consulta, contáctanos en support@yaventas.com</p>
    <p>© {{ date('Y') }} YaVentas - Todos los derechos reservados</p>
</div>
</body>
</html>
