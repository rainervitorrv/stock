<x-layout>
    <x-slot:heading>
        Dashboard
    </x-slot:heading>

    <h1>Seja bem-vindo(a)!</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        <!-- Quantidade de produtos cadastrados -->
        <x-card class="shadow-lg">
            <x-slot:title>
                Quantidade de Produtos
            </x-slot:title>
            <p class="text-2xl font-semibold text-blue-600">{{ \App\Models\Product::count() }}</p>
        </x-card>

        <!-- Últimas 10 movimentações -->
        <x-card class="shadow-lg">
            <x-slot:title>
                Últimas 10 Movimentações
            </x-slot:title>
            <ul class="list-disc pl-5 mt-2 space-y-2">
                @foreach (\App\Models\StockMovement::latest()->take(10)->get() as $movimentacao)
                    <li class="text-gray-700">{{ $movimentacao->type }} ({{ $movimentacao->created_at->format('d/m/Y H:i') }})</li>
                @endforeach
            </ul>
        </x-card>

        <!-- Produtos com estoque abaixo do mínimo -->
        <x-card class="shadow-lg">
            <x-slot:title>
                Produtos com Estoque Abaixo do Mínimo
            </x-slot:title>
            <ul class="list-disc pl-5 mt-2 space-y-2">
                @foreach (\App\Models\Product::where('stock', '<', '10')->get() as $produto)
                    <li class="text-red-600">{{ $produto->name }} (Estoque: {{ $produto->stock }})</li>
                @endforeach
            </ul>
        </x-card>
    </div>
</x-layout>
