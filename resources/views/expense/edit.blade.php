<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edita un gasto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('expense.update', $expense->id) }}">
                        @csrf
                        @method('patch')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Título') }}</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $expense->title) }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Descripción') }}</label>
                            <textarea name="description" id="description"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('description', $expense->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700">{{ __('Total') }}</label>
                            <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $expense->amount) }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="expense_date" class="block text-sm font-medium text-gray-700">{{ __('Fecha') }}</label>
                            <input type="date" name="expense_date" id="expense_date" value="{{ old('expense_date', $expense->expense_date) }}"
                                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('expense_date')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="is_paid" class="block text-sm font-medium text-gray-700">{{ __('¿Está pagado?') }}</label>
                            <input type="hidden" name="is_paid" value="0">
                            <input type="checkbox" name="is_paid" id="is_paid" value="1" @checked(old('is_paid', $expense->is_paid) == 1)
                                class="block border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-2">
                            <x-input-error :messages="$errors->get('is_paid')" class="mt-2" />
                        </div>

                        <x-primary-button class="mt-4">{{ __('Actualizar gasto') }}</x-primary-button>

                        <a href="{{ route('expense.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Cancelar') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>