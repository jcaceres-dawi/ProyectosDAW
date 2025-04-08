<!DOCTYPE html>
<html>
<head>
    <title>Ver Dibujo</title>
</head>
<body>
    <h1>🖼️ Dibujo</h1>
    <img src="{{ $dibujo->imagen }}" style="width: 300px; border: 2px solid black;">
    <div>
        <a href="{{ route('dibujos.index') }}">⬅️ Volver</a>
    </div>
</body>
</html>