<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            Categoria de Produto: {{ $categoria->name }}
        </x-slot:heading>
        <x-slot:button>
            <x-button.create-button href="{{ route('categorias-movimentacao.edit', ['categoria' => $categoria->id]) }}">Editar Cadastro</x-button.create-button>
        </x-slot:button>
    </div>

    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nome da Categoria</label>
            <input type="text" readonly id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                value="{{ $categoria->name }}" required />
        </div>
        <div>
            <label for="type" class="block mb-2 text-sm font-medium text-gray-900">Tipo</label>
            <input type="text" readonly id="type"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                value="@if ($categoria->type == 'entry')Entrada @elseif ($categoria->type == 'exit')Saída @endif" required />
        </div>
</x-layout>
