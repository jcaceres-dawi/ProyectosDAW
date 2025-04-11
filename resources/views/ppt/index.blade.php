<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow rounded-lg">
        <h1 class="text-2xl font-bold mb-4">🪨📄✂️ Piedra, Papel o Tijera</h1>
        <p class="mb-6 text-lg">Hola <strong>{{ Auth::user()->name }}</strong>! Tu puntuacion actual: <span class="font-semibold">{{ Auth::user()->puntos }}</span></p>

        <p class="mb-6 text-lg">Pulsa un botón para jugar:</p>

        <form method="POST" action="{{ route('ppt.jugar') }}" class="flex gap-4 mb-8">
            @csrf
            <button name="eleccion" value="piedra" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded text-xl">🪨 Piedra</button>
            <button name="eleccion" value="papel" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded text-xl">📄 Papel</button>
            <button name="eleccion" value="tijera" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded text-xl">✂️ Tijera</button>
        </form>
        </br>
        <h2 class="text-xl font-semibold mb-2">🏆 Scoreboard</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 text-center">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b">Jugador</th>
                        <th class="py-2 px-4 border-b">Puntos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topJugadores as $j)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $j->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $j->puntos }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $topJugadores->links() }}
        </div>

        <!-- Enlace Volver -->
        <div class="mb-4">
            <a href="/dashboard" class="text-blue-500 hover:text-blue-700 font-medium">
                {{ __('Volver') }}
            </a>
        </div>

    </div>
</x-app-layout>
