<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            Cadastrar Produto
        </x-slot:heading>
        <x-slot:button>
            <div>
                <x-button.save-button form="edit-form">Salvar</x-button.save-button>
            </div>
        </x-slot:button>
    </div>

    <form method="POST" id="edit-form" action="{{ route('produtos.store') }}">
        @csrf

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-form.form-label for="name">Nome do Produto</x-form.form-label>
                <x-form.form-input id="name" name="name" value="{{ old('name') }}" required />
                <x-form-error name="name" />
            </div>
            <div>
                <x-form.form-label for="sku">SKU</x-form.form-label>
                <x-form.form-input id="sku" name="sku" placeholder="Opcional" value="{{ old('sku') }}" />
                <x-form-error name="sku" />
            </div>
            <div>
                <x-form.form-label for="barcode">Código de Barras</x-form.form-label>
                <x-form.form-input id="barcode" name="barcode" value="{{ old('barcode') }}" required />
                <x-form-error name="barcode" />
            </div>
            <div>
                <x-form.form-label for="cost_price">Custo Unitário</x-form.form-label>
                <x-form.form-input id="cost_price" placeholder="R$ 0,00" name="cost_price" value="{{ old('cost_price') }}" required />
                <x-form-error name="cost_price" />
            </div>
            <div>
                <x-form.form-label for="unit_id">Unidade de Medida</x-form.form-label>
                <select name="unit_id" id="unit_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    @foreach ($unidades as $unidade)
                        <option value="{{ $unidade->id }}" {{ old('unit') == $unidade->id ? 'selected' : '' }}>
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
                        <option value="{{ $categoria->id }}" {{ old('category_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->name }}
                        </option>
                    @endforeach
                </select>
                <x-form-error name="category_id" />
            </div>
            <div>
                <x-form.form-label for="stock">Estoque Inicial</x-form.form-label>
                <x-form.form-input id="stock" name="stock" placeholder="0" value="{{ old('stock') }}" />
                <x-form-error name="stock" />
            </div>
            <div>
                <x-form.form-label for="min_stock">Estoque Mínimo</x-form.form-label>
                <x-form.form-input id="min_stock" name="min_stock" placeholder="0" value="{{ old('min_stock') }}" />
                <x-form-error name="min_stock" />
            </div>
        </div>
    </form>
</x-layout>
