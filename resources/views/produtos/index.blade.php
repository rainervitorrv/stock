<x-layout>
    <x-slot:heading>
        Produtos
    </x-slot:heading>
    <x-slot:button>
        <x-button.create-button href="{{ route('produtos.create') }}">Novo Produto</x-button.create-button>
    </x-slot:button>
    

    @if (session('success'))
        <x-form.form-alert-success />
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-black-400">
            <thead class="text-xs text-black-700 bg-gray-50 font-medium">
                <tr>
                    <x-table.table-th>ID</x-table.table-th>
                    <x-table.table-th>Nome</x-table.table-th>
                    <x-table.table-th>SKU</x-table.table-th>
                    <x-table.table-th>Cod. Barras</x-table.table-th>
                    <x-table.table-th>Custo Unitário</x-table.table-th>
                    <x-table.table-th>Estoque</x-table.table-th>
                    <x-table.table-th>Ação</x-table.table-th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200  hover:bg-gray-50 ">
                        <x-table.table-th scope="row"
                            class="px-6 py-4 font-medium text-black-900 whitespace-nowrap">
                            {{ $produto->id }}
                        </x-table.table-th>
                        <x-table.table-row-td>
                            {{ $produto->name }}
                        </x-table.table-row-td>
                        <x-table.table-row-td>
                            {{ $produto->sku }}
                        </x-table.table-row-td>
                        <x-table.table-row-td>
                            {{ $produto->barcode }}
                        </x-table.table-row-td>
                        <x-table.table-row-td>
                            R$ {{ number_format($produto->cost_price, 2, ',', '.') }}
                        </x-table.table-row-td>
                        <x-table.table-row-td>
                            {{ $produto->stock }}
                        </x-table.table-row-td>
                        <x-table.table-row-td>
                            <a href="{{ route('produtos.show', ['produto' => $produto->id]) }}"
                                class="font-medium text-blue-600  hover:underline">Editar</a>
                        </x-table.table-row-td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $produtos->links() }}
    </div>
</x-layout>
