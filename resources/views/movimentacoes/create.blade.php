<x-layout>
    <div class="p-4 bg-white shadow-md rounded-md max-w-5xl mx-auto mt-5">
        <x-slot:heading>
            Nova Movimentação de Estoque
        </x-slot:heading>

        @if(session('success'))
            <div class="w-full bg-green-500 text-white p-2 rounded-md text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('movimentacoes.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold">Fornecedor</label>
                    <select name="supplier_id" class="input-style">
                        <option value="">Selecione...</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name_fantasy }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Tipo de Movimentação</label>
                    <select name="movement_type" class="input-style">
                        <option value="entrada">Entrada</option>
                        <option value="saida">Saída</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Categoria</label>
                <select name="category_id" class="input-style">
                    <option value="">Selecione...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Observação</label>
                <textarea name="observation" class="input-style h-24"></textarea>
            </div>

            <div id="product-list" class="space-y-2">
                <label class="block text-gray-700 font-semibold">Produtos</label>
                <div class="flex gap-2">
                    <input type="text" id="search-product" placeholder="Digite nome, código de barras ou SKU"
                        class="input-style flex-1">
                    <button type="button" id="add-product" class="btn-primary">Adicionar</button>
                </div>
                <ul id="selected-products" class="mt-4 space-y-2"></ul>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-success">Salvar Movimentação</button>
            </div>
        </form>
    </div>

    <script>
       document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById('search-product');
    const addButton = document.getElementById('add-product');
    const productList = document.getElementById('selected-products');
    const products = @json($products);

      // Adicionar cabeçalho da grid
      const headerRow = document.createElement('div');
    headerRow.classList.add('grid', 'grid-cols-4', 'gap-4', 'items-center', 'font-semibold', 'text-gray-700', 'bg-gray-200', 'p-2', 'rounded-t-md');
    headerRow.innerHTML = `
        <span>Nome do Produto (SKU)</span>
        <span>Quantidade</span>
        <span>Estoque Disponível</span>
    `;
    productList.appendChild(headerRow);

    function addProduct() {
        const searchValue = searchInput.value.toLowerCase();
        const foundProduct = products.find(p => 
            p.name.toLowerCase().includes(searchValue) || 
            p.barcode?.toLowerCase() === searchValue ||
            p.sku?.toLowerCase() === searchValue
        );

        if (foundProduct) {
            const li = document.createElement('li');
            li.innerHTML = `
                <div class="grid grid-cols-4 gap-4 items-center border p-2 rounded-md bg-gray-100">
                    <span class="font-medium">${foundProduct.name} (${foundProduct.sku})</span>
                    <input type="hidden" name="products[${foundProduct.id}][id]" value="${foundProduct.id}">
                    <input type="number" name="products[${foundProduct.id}][quantity]" value="1" min="1"
                        class="w-16 border p-1 text-center rounded-md">
                    <span class="text-gray-700 font-semibold">${foundProduct.stock} un.</span>
                    <button type="button" class="text-red-500 hover:text-red-700 remove-product">X</button>
                </div>
            `;
            productList.appendChild(li);
            searchInput.value = "";
        } else {
            alert("Produto não encontrado!");
        }
    }

    addButton.addEventListener('click', addProduct);

    searchInput.addEventListener('keypress', function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            addProduct();
        }
    });

    productList.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-product')) {
            e.target.closest('li').remove();
        }
    });
});

    </script>

    <style>
        .input-style {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            focus:outline-none focus:ring-2 focus:ring-blue-500;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }

        .btn-success {
            background-color: #10b981;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }
        .btn-success:hover {
            background-color: #059669;
        }
    </style>
</x-layout>
