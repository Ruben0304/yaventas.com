<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .fecha {
            text-align: right;
            margin-bottom: 20px;
        }
        .contenido {
            line-height: 1.6;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>{{ $titulo }}</h1>
</div>

<div class="fecha">
    Fecha: {{ $fecha }}
</div>

<div class="contenido">
    {{ $contenido }}
</div>
</body>
</html>
