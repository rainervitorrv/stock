<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            Detalhes da Movimentação - ID {{ $movimentacao->id }} - {{ ucfirst($movimentacao->type) }}
        </x-slot:heading>
        <x-slot:button>
            <div>
                <x-button.delete-button data-modal-target="popup-modal"
                    data-modal-toggle="popup-modal">Excluir</x-button.delete-button>
            </div>
        </x-slot:button>
    </div>

    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <x-form.form-label for="supplier">Fornecedor</x-form.form-label>
            <x-form.form-input id="supplier" name="supplier" class="cursor-not-allowed"
                value="{{ $movimentacao->supplier->name_fantasy }}" readonly />
        </div>
        <div>
            <x-form.form-label for="category">Categoria</x-form.form-label>
            <x-form.form-input id="category" name="category" class="cursor-not-allowed"
                value="{{ $movimentacao->category->name }}" readonly />
        </div>
        <div>
            <x-form.form-label for="date">Data</x-form.form-label>
            <x-form.form-input id="date" name="date" class="cursor-not-allowed"
                value="{{ $movimentacao->date }}" readonly />
        </div>
        <div>
            <x-form.form-label for="user">Feita por</x-form.form-label>
            <x-form.form-input id="user" name="user" class="cursor-not-allowed"
                value="{{ $movimentacao->user->name }}" readonly />
        </div>
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-semibold text-gray-800">Produtos Movimentados</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-black-400">
                <thead class="text-xs text-black-700 bg-gray-50 font-medium">
                    <tr>
                        <x-table.table-th>Produto</x-table.table-th>
                        <x-table.table-th>Quantidade</x-table.table-th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movimentacoes as $movimentacao)
                        <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-50">
                            <x-table.table-th scope="row"
                                class="px-6 py-4 font-medium text-black-900 whitespace-nowrap">
                                {{ $movimentacao->product->name }}
                            </x-table.table-th>
                            <x-table.table-row-td>
                                {{ $movimentacao->quantity }}
                            </x-table.table-row-td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        Você tem certeza que deseja excluir esse cadastro?
                    </h3>
                    <button form="delete-form" data-modal-hide="popup-modal"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Sim, tenho certeza
                    </button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">
                        Não, cancelar</button>
                </div>
            </div>
        </div>

    </div>

    <form id="delete-form" class="hidden" method="POST"
        action="{{ route('movimentacoes.destroy', ['movimentacao' => $movimentacao->id]) }}">
        @csrf
        @method('delete')
    </form>
</x-layout>
