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
                <x-form.form-input id="sku" name="sku" value="{{ old('sku') }}" />
                <x-form-error name="sku" />
            </div>
            <div>
                <x-form.form-label for="barcode">Código de Barras</x-form.form-label>
                <x-form.form-input id="barcode" name="barcode" value="{{ old('barcode') }}" required />
                <x-form-error name="barcode" />
            </div>
            <div>
                <x-form.form-label for="cost_price">Custo Unitário</x-form.form-label>
                <x-form.form-input id="cost_price" name="cost_price" value="{{ old('cost_price') }}" required />
                <x-form-error name="cost_price" />
            </div>
            <div>
                <x-form.form-label for="unit">Unidade de Medida</x-form.form-label>
                <select name="unit" id="unit"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option value="UN" {{ old('unit') == 'UN' ? 'selected' : '' }}>UN - Unidade</option>
                    <option value="CX" {{ old('unit') == 'CX' ? 'selected' : '' }}>CX - Caixa</option>
                    <option value="M" {{ old('unit') == 'M' ? 'selected' : '' }}>M - Metro</option>
                    <option value="L" {{ old('unit') == 'L' ? 'selected' : '' }}>L - Litro</option>
                    <option value="KG" {{ old('unit') == 'KG' ? 'selected' : '' }}>KG - Kilograma</option>
                    <option value="TON" {{ old('unit') == 'TON' ? 'selected' : '' }}>TON - Tonelada</option>
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
                <x-form.form-label for="stock">Estoque</x-form.form-label>
                <x-form.form-input id="stock" name="stock" value="{{ old('stock') }}" />
                <x-form-error name="stock" />
            </div>
            <div>
                <x-form.form-label for="min_stock">Estoque Mínimo</x-form.form-label>
                <x-form.form-input id="min_stock" name="min_stock" value="{{ old('min_stock') }}" />
                <x-form-error name="min_stock" />
            </div>
        </div>
    </form>
</x-layout>