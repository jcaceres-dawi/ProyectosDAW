<!DOCTYPE html>
<html>
<head>
    <title>Editar Dibujo</title>
    <style>
        canvas { border: 2px solid black; background: white; }
        #colores { margin-top: 10px; }
    </style>
</head>
<body>
    <h1>✏️ Editar Dibujo</h1>
    <canvas id="canvas" width="400" height="400"></canvas>
    <div id="colores">
        <button onclick="setColor('black')">⚫</button>
        <button onclick="setColor('red')">🔴</button>
        <button onclick="setColor('blue')">🔵</button>
        <button onclick="setColor('green')">🟢</button>
        <button onclick="setColor('yellow')">🟡</button>       
        <button onclick="setColor('white')">⚪</button>
        <button onclick="clearCanvas()">🧽 Limpiar</button>
    </div>
    <form method="POST" action="{{ route('dibujos.update', $dibujo) }}" onsubmit="return enviarDibujo()">
        @csrf
        @method('PUT')
        <input type="hidden" name="imagen" id="imagen">
        <button type="submit">📂 Guardar</button>
    </form>

    <script>
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        let drawing = false;
        let color = 'black';

        const imagenBase64 = @json($dibujo->imagen);
        const imagen = new Image();
        imagen.onload = () => ctx.drawImage(imagen, 0, 0, canvas.width, canvas.height);
        imagen.src = imagenBase64;

        canvas.addEventListener('mousedown', () => drawing = true);
        canvas.addEventListener('mouseup', () => drawing = false);
        canvas.addEventListener('mousemove', dibujar);

        function dibujar(e) {
            if (!drawing) return;
            ctx.fillStyle = color;
            ctx.beginPath();
            ctx.arc(e.offsetX, e.offsetY, 5, 0, Math.PI * 2);
            ctx.fill();
        }

        function setColor(c) {
            color = c;
        }

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function enviarDibujo() {
            const dataURL = canvas.toDataURL();
            document.getElementById('imagen').value = dataURL;
            return true;
        }
    </script>
</body>
</html>