<x-layout>
    <x-slot:heading>
        Dashboard
    </x-slot:heading>



    <h1 class="text-2xl font-semibold"><span class="font-bold">{{ Auth::user()->name }}</span>, seja bem-vindo(a)!</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 mt-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 mt-6">
            <!-- Quantidade de produtos cadastrados -->
            <x-card class="shadow-lg">
                <x-slot:title class="flex items-center justify-center space-x-2">
                    <ion-icon class="text-2xl" name="cube-outline"></ion-icon>
                    <span>Quantidade de Produtos</span>
                </x-slot:title>
                <p class="text-2xl font-semibold text-blue-600">{{ \App\Models\Product::count() }}</p>
            </x-card>

            <x-card class="shadow-lg">
                <x-slot:title>
                    <ion-icon class="text-2xl" name="people-outline"></ion-icon>
                    Quantidade de Fornecedores
                </x-slot:title>
                <p class="text-2xl font-semibold text-blue-600">{{ \App\Models\Supplier::count() }}</p>
            </x-card>
        </div>

        <!-- Últimas 10 movimentações -->
        <x-card class="shadow-lg">
            <x-slot:title>
                <ion-icon class="text-2xl" name="analytics-outline"></ion-icon>
                Últimas 10 Movimentações
            </x-slot:title>
            <ul class="list-disc pl-5 mt-2 space-y-2">
                @foreach (\App\Models\StockTransaction::latest()->take(10)->get() as $movimentacao)
                    <li class="text-gray-700">{{ ucfirst($movimentacao->type) }}
                        ({{ $movimentacao->created_at->format('d/m/Y H:i') }}) por {{ $movimentacao->user->name }})
                    </li>
                @endforeach
            </ul>
        </x-card>

        <!-- Produtos com estoque abaixo do mínimo -->
        <x-card class="shadow-lg">
            <x-slot:title>
                <ion-icon class="text-2xl" name="alert-circle-outline"></ion-icon>
                Produtos com Estoque Abaixo do Mínimo
            </x-slot:title>
            @foreach (\App\Models\Product::whereColumn('stock', '<', 'min_stock')->get() as $produto)
                <div class="py-1">
                    <ion-icon name="pricetag-outline"></ion-icon>
                    <span class="">{{ $produto->name }},
                        (Estoque Atual: {{ $produto->stock }})
                        (Estoque Mínimo: {{ $produto->min_stock }})</span>
                </div>
            @endforeach
        </x-card>
    </div>
</x-layout>
