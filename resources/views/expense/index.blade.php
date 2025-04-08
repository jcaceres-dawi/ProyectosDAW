<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gastos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Enlace Volver -->
            <div class="mb-4">
                <a href="/dashboard" class="text-blue-500 hover:text-blue-700 font-medium">
                    {{ __('Volver') }}
                </a>
            </div>

            @if(session('status'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __("Lista de gastos") }}</h3>
                    @if($expenses->isEmpty())
                    <p>{{ __("No hay gastos disponibles.") }}</p>
                    <x-primary-button class='mt-4'><a href="{{ route('expense.create') }}">
                            {{ __('Añadir Gasto') }}
                    </x-primary-button></a>

                    @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Título') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Descripción') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Total') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Fecha') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Pagado') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Acciones') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($expenses as $expense)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $expense->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">
                                    {{ $expense->description }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ number_format($expense->amount, 2) }} €
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $expense->is_paid ? 'Sí' : 'No' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('expense.show', $expense) }}" class="text-blue-600 hover:underline ml-2">{{ __('Ver') }}</a>
                                    <a href="{{ route('expense.edit', $expense) }}" class="text-green-600 hover:underline ml-2">{{ __('Editar') }}</a>

                                    <form action="{{ route('expense.destroy', $expense) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline ml-2">{{ __('Eliminar') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <x-primary-button class='mt-4'><a href="{{ route('expense.create') }}">
                            {{ __('Añadir Gasto') }}
                    </x-primary-button></a>
                    <div class="flex justify-end mt-4">
                        <div class="text-right">
                            <p class="font-semibold">{{ __('Total Pagado:') }} <span class="text-green-600">{{ number_format($expenses->where('is_paid', true)->pluck('amount')->sum(), 2) }} €</span></p>
                            <p class="font-semibold">{{ __('Total Pendiente:') }} <span class="text-red-600">{{ number_format($expenses->where('is_paid', false)->pluck('amount')->sum(), 2) }} €</span></p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>