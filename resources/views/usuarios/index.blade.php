<x-layout>
    <x-slot:heading>
        Usuários
    </x-slot:heading>
    <x-slot:button>
        <x-button.create-button href="{{ route('usuarios.create') }}">Novo Usuário</x-button.create-button>
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
                    <x-table.table-th>E-mail</x-table.table-th>
                    <x-table.table-th>Ação</x-table.table-th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200  hover:bg-gray-50 ">
                        <x-table.table-th scope="row"
                            class="px-6 py-4 font-medium text-black-900 whitespace-nowrap">
                            {{ $usuario->id }}
                        </x-table.table-th>
                        <x-table.table-row-td>
                            {{ $usuario->name }}
                        </x-table.table-row-td>
                        <x-table.table-row-td>
                            {{ $usuario->email }}
                        </x-table.table-row-td>
                        <x-table.table-row-td>
                            <a href="{{ route('usuarios.show', ['usuario' => $usuario->id]) }}"
                                class="font-medium text-blue-600  hover:underline">Editar</a>
                        </x-table.table-row-td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        {{ $usuarios->links() }}
    </div>
</x-layout>
