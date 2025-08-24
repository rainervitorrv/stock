<x-layout>
    <x-slot:heading>
        Movimentações
    </x-slot:heading>
    <x-slot:button>
        <x-button.create-button href="{{ route('movimentacoes.create') }}">Nova Movimentação</x-button.create-button>
    </x-slot:button>


    @if (session('success'))
        <x-form.form-alert-success />
    @endif

    <div class="space-y-4">
        @foreach ($movimentacoes as $movimentacao)
            <a href="{{ route('movimentacoes.show', ['movimentacao' => $movimentacao->id]) }}"
               class="block p-4 border border-gray-300 rounded-lg shadow-sm hover:shadow-md transition">

                <div class="font-bold text-lg text-blue-500">
                    {{-- #{{ $movimentacao->id }} - {{ ucfirst($movimentacao->type) ?? 'Movimentação' }} --}}
                    #{{ $movimentacao->id }} - {{ $movimentacao->type == 'entry' ? 'Entrada' : 'Saída' }}
                </div>

                <div class="mt-1 text-sm text-gray-700">
                    <strong>Fornecedor:</strong> {{ $movimentacao->supplier->name_fantasy ?? 'N/A' }}
                </div>

                <div class="mt-1 text-sm text-gray-700">
                    <strong>Categoria:</strong> {{ $movimentacao->category->name ?? 'N/A' }}
                </div>

                <div class="mt-1 text-sm text-gray-700">
                    <strong>Data:</strong>
                    {{ \Carbon\Carbon::parse($movimentacao->created_at)->format('d/m/Y \à\s H:i') }}
                </div>

                <div class="mt-1 text-sm text-gray-700">
                    <strong>Feita por:</strong> {{ $movimentacao->user->name ?? 'N/A' }}
                </div>

            </a>
        @endforeach

        <div class="mt-4">
            {{ $movimentacoes->links() }}
        </div>
    </div>

</x-layout>
