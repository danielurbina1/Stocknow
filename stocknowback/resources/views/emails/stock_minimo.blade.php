<!DOCTYPE html>
<html>
<head>
    <title>Stock Mínimo Alcanzado</title>
</head>
<body>
    <h1>Stock Mínimo Alcanzado</h1>
    <p>Hola {{ $jefe->name }},</p>
    <p>El producto <strong>{{ $producto->nombre }}</strong> ha alcanzado el stock mínimo.</p>
    <p>Stock actual: {{ $producto->stock }}</p>
    <p>Por favor, revisa el inventario y toma las medidas necesarias.</p>
    <p>Gracias,</p>
    <p>El sistema de inventario</p>
</body>
</html>
