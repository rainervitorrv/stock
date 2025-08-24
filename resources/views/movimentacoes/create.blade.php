<x-layout>
    <div class="p-4 bg-white shadow-md rounded-md max-w-5xl mx-auto mt-5">
        <x-slot:heading>
            Nova Movimentação de Estoque
        </x-slot:heading>

        @if (session('success'))
            <div class="w-full bg-green-500 text-white p-2 rounded-md text-center mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="w-full bg-red-500 text-white p-2 rounded-md text-center mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('movimentacoes.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold">Fornecedor/Cliente</label>
                    <select name="supplier_id" class="input-style">
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name_fantasy }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Tipo de Movimentação</label>
                    <select name="movement_type" class="input-style" id="movement_type">
                        <option value="entry">Entrada</option>
                        <option value="exit">Saída</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Categoria</label>
                <select name="category_id" id="category_id" class="input-style">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" data-type="{{ $category->type }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
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
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById('search-product');
            const addButton = document.getElementById('add-product');
            const productList = document.getElementById('selected-products');
            const products = @json($products);

            // Adicionar cabeçalho da grid
            const headerRow = document.createElement('div');
            headerRow.classList.add('grid', 'grid-cols-5', 'gap-4', 'items-center', 'font-semibold',
                'text-gray-700', 'bg-gray-200', 'p-2', 'rounded-t-md');
            headerRow.innerHTML = `
                <span>Nome do Produto (SKU)</span>
                <span>Quantidade</span>
                <span>Estoque Disponível</span>
                <span>Aviso de Estoque</span>
            `;
            productList.appendChild(headerRow);

            function addProduct() {
                const searchValue = searchInput.value.trim().toLowerCase();
                const foundProducts = products.filter(p =>
                    p.name.toLowerCase().includes(searchValue) ||
                    p.barcode?.toLowerCase() === searchValue ||
                    p.sku?.toLowerCase() === searchValue
                );

                if (foundProducts.length === 1) {
                    const foundProduct = foundProducts[0];
                    addProductToList(foundProduct);
                    searchInput.value = ""; // Clear input
                } else if (foundProducts.length > 1) {
                    alert("Selecione um produto da lista!");
                } else {
                    alert("Produto não encontrado!");
                }
            }

            function addProductToList(product) {
                const li = document.createElement('li');
                const lowStockWarning = product.stock <= product.minimum_stock ?
                    `<span class="text-yellow-600 text-sm">Atenção: Estoque mínimo atingido!</span>` : '';

                li.innerHTML = `
                    <div class="grid grid-cols-5 gap-4 items-center border p-2 rounded-md bg-gray-100">
                        <span class="font-medium">${product.name}</span>
                        <input type="hidden" name="products[${product.id}][id]" value="${product.id}">
                        <input type="number" name="products[${product.id}][quantity]" value="1" min="1"
                            class="w-16 border p-1 text-center rounded-md" onchange="checkStock(${product.id}, this)">
                        <span class="text-gray-700 font-semibold">${product.stock} un.</span>
                        <span class="text-gray-700">${lowStockWarning}</span>
                        <button type="button" class="text-red-500 hover:text-red-700 remove-product">X</button>
                    </div>
                `;
                productList.appendChild(li);
            }

            // Filtrar categorias conforme o tipo de movimentação
            const movementTypeSelect = document.getElementById('movement_type');
            const categorySelect = document.getElementById('category_id');

            function filterCategories() {
                const selectedType = movementTypeSelect.value;
                Array.from(categorySelect.options).forEach(option => {
                    option.style.display = option.getAttribute('data-type') === selectedType ? '' : 'none';
                });
                // Seleciona a primeira opção visível
                const firstVisible = Array.from(categorySelect.options).find(opt => opt.style.display === '');
                if (firstVisible) categorySelect.value = firstVisible.value;
            }

            movementTypeSelect.addEventListener('change', filterCategories);
            filterCategories(); // Executa ao carregar a página

            // Verifica o estoque ao alterar a quantidade

            function checkStock(productId, inputElement) {
                const product = products.find(p => p.id == productId);
                if (inputElement.value > product.stock) {
                    alert("Quantidade inserida é maior do que o estoque disponível!");
                }
                if (inputElement.value <= product.minimum_stock) {
                    alert("Estoque mínimo atingido!");
                }
            }

            addButton.addEventListener('click', addProduct);

            searchInput.addEventListener('keypress', function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    addProduct();
                }
            });

            productList.addEventListener('click', function(e) {
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
            focus: outline-none focus:ring-2 focus:ring-blue-500;
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
