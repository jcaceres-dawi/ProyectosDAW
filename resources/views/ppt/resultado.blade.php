<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow rounded-lg text-center">
        <h1 class="text-2xl font-bold mb-4">Resultado de la partida</h1>

        <p class="text-lg mb-4">Elegiste: <strong>{{ $jugadorEleccion }}</strong></p>
        <p class="text-lg mb-4">La máquina eligió: <strong>{{ $maquinaEleccion }}</strong></p>

        <p class="text-xl font-semibold mb-6">
            @if ($resultado === 'victoria')
                🏆 <span class="text-green-600">¡Ganaste!</span>
            @elseif ($resultado === 'derrota')
                ❌ <span class="text-red-600">Perdiste</span>
            @else
                🤝 <span class="text-gray-600">Empate</span>
            @endif
        </p>

        <p class="mb-4">Tu nueva puntuacion: <strong>{{ $user->puntos }}</strong></p>

        <a href="{{ route('ppt.index') }}" class="inline-block mt-4 bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">🔁 Jugar otra vez</a>
    </div>
</x-app-layout>