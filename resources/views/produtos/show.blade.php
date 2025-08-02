<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            {{ $produto->name }}
        </x-slot:heading>
        <x-slot:button>
            <x-button.create-button href="{{ route('produtos.edit', ['produto' => $produto->id]) }}">Editar Cadastro</x-button.create-button>
        </x-slot:button>
    </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-form.form-label for="name">Nome do Produto</x-form.form-label>
                <x-form.form-input id="name" name="name" class="cursor-not-allowed"
                    value="{{ $produto->name }}" readonly/>
                <x-form-error name="name" />
            </div>
            <div>
                <x-form.form-label for="sku">SKU</x-form.form-label>
                <x-form.form-input id="sku" name="sku" class="cursor-not-allowed"
                    value="{{ $produto->sku }}" readonly />
                <x-form-error name="sku" />
            </div>
            <div>
                <x-form.form-label for="barcode">Código de Barras</x-form.form-label>
                <x-form.form-input id="barcode" name="barcode" class="cursor-not-allowed"
                    value="{{ $produto->barcode }}" readonly />
                <x-form-error name="barcode" />
            </div>
            <div>
                <x-form.form-label for="cost_price">Custo Unitário</x-form.form-label>
                <x-form.form-input id="cost_price" name="cost_price" class="cursor-not-allowed"
                    value="R$ {{ number_format($produto->cost_price, 2, ',', '.') }}" readonly />
                <x-form-error name="cost_price" />
            </div>
            <div>
                <x-form.form-label for="unit">Unidade de Medida</x-form.form-label>
                <x-form.form-input id="unit" name="unit" class="cursor-not-allowed"
                    value="{{ $produto->unit }}" readonly />
                <x-form-error name="unit" />
            </div>
            <div>
                <x-form.form-label for="category_id">Categoria</x-form.form-label>
                <x-form.form-input id="category_id" name="category_id" class="cursor-not-allowed"
                    value="{{ $produto->category->name }}" readonly />
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
                <x-form.form-input id="min_stock" name="min_stock" class="cursor-not-allowed"
                    value="{{ $produto->min_stock }}" readonly />
                <x-form-error name="min_stock" />
            </div>
        </div>
    </form>
</x-layout>
