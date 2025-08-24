<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            Editar: {{ $produto->name }}
        </x-slot:heading>
        <x-slot:button>
            <div>
                <x-button.delete-button data-modal-target="popup-modal"
                    data-modal-toggle="popup-modal">Excluir</x-button.delete-button>
                <x-button.save-button form="edit-form">Alterar</x-button.save-button>
            </div>
        </x-slot:button>
    </div>

    <form method="POST" id="edit-form" action="{{ route('produtos.update', ['produto' => $produto->id]) }}">
        @csrf
        @method('patch')

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-form.form-label for="name">Nome do Produto</x-form.form-label>
                <x-form.form-input id="name" name="name" value="{{ $produto->name }}" required />
                <x-form-error name="name" />
            </div>
            <div>
                <x-form.form-label for="sku">SKU</x-form.form-label>
                <x-form.form-input id="sku" name="sku" value="{{ $produto->sku }}" />
                <x-form-error name="sku" />
            </div>
            <div>
                <x-form.form-label for="barcode">Código de Barras</x-form.form-label>
                <x-form.form-input id="barcode" name="barcode" value="{{ $produto->barcode }}" required />
                <x-form-error name="barcode" />
            </div>
            <div>
                <x-form.form-label for="cost_price">Custo Unitário</x-form.form-label>
                <x-form.form-input id="cost_price" name="cost_price" value="{{ $produto->cost_price }}" required />
                <x-form-error name="cost_price" />
            </div>
            <div>
                <x-form.form-label for="unit_id">Unidade de Medida</x-form.form-label>
                <select name="unit_id" id="unit_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}"
                            {{ $produto->unit->id == $unidade->id ? 'selected' : '' }}>
                            {{ $unidade->name }} ({{ $unidade->abbreviation }})
                        </option>
                    @endforeach
                </select>
                <x-form-error name="unit" />
            </div>
            <div>
                <x-form.form-label for="category_id">Categoria</x-form.form-label>
                <select name="category_id" id="category_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ $produto->category_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->name }}
                        </option>
                    @endforeach
                </select>
                <x-form-error name="category_id" />
            </div>
            <div>
                <x-form.form-label for="stock">Estoque</x-form.form-label>
                <x-form.form-input id="stock" name="stock" class="cursor-not-allowed"
                    value="{{ $produto->stock }}" readonly />
                <x-form-error name="stock" />
            </div>
            <div>
                <x-form.form-label for="min_stock">Estoque Mínimo</x-form.form-label>
                <x-form.form-input id="min_stock" name="min_stock" value="{{ $produto->min_stock }}" />
                <x-form-error name="min_stock" />
            </div>
        </div>
    </form>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert-success');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000); // Fecha após 3 segundos

        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('cost_price');
            input.addEventListener('input', function(e) {
                let value = input.value.replace(/\D/g, '');
                value = (value / 100).toFixed(2) + '';
                value = value.replace('.', ',');
                input.value = value;
            });
        });
    </script>

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
        action="{{ route('produtos.destroy', ['produto' => $produto->id]) }}">
        @csrf
        @method('delete')
    </form>
</x-layout>
