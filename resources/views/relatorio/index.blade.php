<x-layout>
    <x-slot:heading>
        Relatório de Estoque
    </x-slot:heading>

    @if (session('success'))
        <x-form.form-alert-success />
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-black-400">
            <thead class="text-xs text-black-700 bg-gray-50 font-medium">
                <tr>
                    <x-table.table-th>Nome do Produto</x-table.table-th>
                    <x-table.table-th>Estoque Atual</x-table.table-th>
                    <x-table.table-th>Estoque Mínimo</x-table.table-th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr 
                    class="odd:bg-white even:bg-gray-50 border-b border-gray-200 
                              hover:bg-gray-50 
                              {{ $produto->stock <= $produto->min_stock ? 'text-red-700' : '' }}">
                        
                              <x-table.table-row-td>
                            {{ $produto->name }}
                        </x-table.table-row-td>
                        <x-table.table-row-td>
                            {{ $produto->stock }}
                        </x-table.table-row-td>
                        <x-table.table-row-td>
                            {{ $produto->min_stock }}
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
