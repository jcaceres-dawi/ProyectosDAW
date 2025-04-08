<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Gasto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">{{ $expense->title }}</h3>
                <p><strong>{{ __('Descripción:') }}</strong> {{ $expense->description }}</p>
                <p><strong>{{ __('Total:') }}</strong> {{ number_format($expense->amount, 2) }} €</p>
                <p><strong>{{ __('Fecha:') }}</strong> {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}</p>
                <p><strong>{{ __('Pagado:') }}</strong> {{ $expense->is_paid ? 'Sí' : 'No' }}</p>

                <a href="{{ route('expense.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Volver') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>