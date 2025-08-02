<!DOCTYPE html class="h-full bg-gray-100">
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Estoque</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/logo.svg') }}" type="image/png">
</head>

<body class="h-full">
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <img class="size-8" src="{{ asset('images/logo.svg') }}" alt="Logo">
                        </div>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <x-nav-link href="/" :active="request()->is('/')">Dashboard</x-nav-link>
                                <x-nav-link href="{{ route('usuarios.index') }}" :active="request()->is('usuarios')">Usuários</x-nav-link>
                                <x-nav-link href="{{ route('fornecedores.index') }}"
                                    :active="request()->is('fornecedores')">Pessoas</x-nav-link>
                                <x-nav-link href="{{ route('produtos.index') }}" :active="request()->is('produtos')">Produtos</x-nav-link>
                                <!-- Dropdown Categorias -->
                                <div class="relative">
                                    <button
                                        class=" hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium text-white"
                                        data-dropdown-toggle="dropdown-categorias">
                                        Categorias
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdown-categorias"
                                        class="absolute hidden z-10 list-none bg-white divide-y divide-gray-100 rounded shadow w-44">
                                        <div class="py-1">
                                            <a href="{{ route('categorias-produtos.index') }}"
                                                class="text-gray-700 block px-4 py-2 text-sm">Categorias de Produtos</a>
                                            <a href="{{ route('categorias-movimentacao.index') }}"
                                                class="text-gray-700 block px-4 py-2 text-sm">Categorias de
                                                Movimentação</a>
                                            <a href="{{ route('unidades-produtos.index') }}"
                                                class="text-gray-700 block px-4 py-2 text-sm">Unidades de Produtos</a>
                                        </div>
                                    </div>
                                </div>

                                <x-nav-link href="{{ route('movimentacoes.index') }}"
                                    :active="request()->is('movimentacoes')">Movimentações</x-nav-link>
                                <x-nav-link href="{{ route('relatorios.index') }}"
                                    :active="request()->is('relatorio')">Relatório</x-nav-link>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" class="text-white font-semibold">Sair</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <!-- Script para ativar os dropdowns do Flowbite -->
        <script>
            // Ativando o dropdown do Flowbite
            document.querySelectorAll('[data-dropdown-toggle]').forEach((dropdownToggle) => {
                dropdownToggle.addEventListener('click', function() {
                    const target = document.getElementById(dropdownToggle.getAttribute('data-dropdown-toggle'));
                    target.classList.toggle('hidden');
                });
            });
        </script>



        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 sm:flex sm:justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>

                @isset($button)
                    {{ $button }}
                @endisset
            </div>
        </header>
        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
