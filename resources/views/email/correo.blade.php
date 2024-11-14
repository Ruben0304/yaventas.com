<!DOCTYPE html>
<html>
<head>
    <title>Nueva Compra</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .order-details { background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
        .product { border-bottom: 1px solid #eee; padding: 10px 0; }
        .product:last-child { border-bottom: none; }
        .totals { margin-top: 20px; background: #f8f9fa; padding: 15px; border-radius: 5px; }
        .label { font-weight: bold; color: #555; }
        .value { color: #333; }
        .total-line { display: flex; justify-content: space-between; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Nueva Orden de Compra</h1>
        <p>ID Usuario: {{ $userData['id_user'] }}</p>
    </div>

    <div class="order-details">
        <h2>Información del Cliente</h2>
        <p><span class="label">Nombre:</span> {{ $userData['nombre'] }}</p>
        <p><span class="label">Teléfono:</span> {{ $userData['telefono'] }}</p>
        <p><span class="label">Dirección:</span> {{ $userData['direccion'] }}</p>
        <p><span class="label">País:</span> {{ $userData['pais'] }}</p>
        <p><span class="label">Provincia:</span> {{ $userData['provincia'] }}</p>
        <p><span class="label">Municipio:</span> {{ $userData['municipio'] }}</p>

        <h2>Productos</h2>
        @foreach($products as $product)
            <div class="product">
                <h3>{{ $product['nombre'] }}</h3>
                <p><span class="label">Cantidad:</span> {{ $product['cantidad'] }}</p>
                <p><span class="label">Precio:</span> ${{ $product['precio'] }}</p>
                <p><span class="label">Total:</span> ${{ $product['total'] }}</p>
                <p><span class="label">Link:</span> <a href="{{ $product['link'] }}">Ver producto</a></p>
            </div>
        @endforeach

        <div class="totals">
            <div class="total-line">
                <span class="label">Subtotal:</span>
                <span class="value">${{ $orderData['subtotal'] }}</span>
            </div>
            <div class="total-line">
                <span class="label">Envío:</span>
                <span class="value">${{ $orderData['envio'] }}</span>
            </div>
            <div class="total-line">
                <span class="label">Total:</span>
                <span class="value">${{ $orderData['total'] }}</span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
