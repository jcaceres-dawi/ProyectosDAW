<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center space-x-8" style="justify-content: space-evenly;">
                    <nav class="flex flex-col space-y-4">
                        <x-nav-link :href="route('chirps.index')" :active="request()->routeIs('chirps.index')" class="text-lg py-2 px-4 rounded hover:bg-gray-100 transition">
                            {{ __('💬 Mensajes') }}
                        </x-nav-link>
                        <x-nav-link :href="route('expense.index')" :active="request()->routeIs('expense.index')" class="text-lg py-2 px-4 rounded hover:bg-gray-100 transition">
                            {{ __('💸 Gastos') }}
                        </x-nav-link>
                        <x-nav-link href="{{ url('/html/tetris.html') }}" class="text-lg py-2 px-4 rounded hover:bg-gray-100 transition">
                            {{ __('🕹️ Tetris') }}
                        </x-nav-link>
                        <x-nav-link href="{{ url('/html/tresraya.html') }}" class="text-lg py-2 px-4 rounded hover:bg-gray-100 transition">
                            {{ __('🎮 Tres en raya') }}
                        </x-nav-link>
                        <x-nav-link href="{{ url('/html/trello.html') }}" class="text-lg py-2 px-4 rounded hover:bg-gray-100 transition">
                            {{ __('📝 Trello') }}
                        </x-nav-link>
                        <x-nav-link href="{{ url('/html/aseguradora.html') }}" class="text-lg py-2 px-4 rounded hover:bg-gray-100 transition">
                            {{ __('🛡️ Aseguradora') }}
                        </x-nav-link>
                        <x-nav-link :href="route('dibujos.index')" :active="request()->routeIs('dibujos.index')" class="text-lg py-2 px-4 rounded hover:bg-gray-100 transition">
                            {{ __('✏️ Dibujos') }}
                        </x-nav-link>
                    </nav>
                    <div class="flex justify-center items-center">
                        <img src="{{ asset('images/foto-principal.png') }}" alt="DAW" class="h-auto" style="width: 600px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>