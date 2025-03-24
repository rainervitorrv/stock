<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            {{ $fornecedor->name_fantasy }}
        </x-slot:heading>
        <x-slot:button>
            <x-button.create-button href="{{ route('fornecedores.edit', ['fornecedor' => $fornecedor->id]) }}">Editar Cadastro</x-button.create-button>
        </x-slot:button>
    </div>

    <div class="pb-4 font-bold">
        <h2>Dados Cadastrais</h2>
    </div>
    
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="name_fantasy" class="block mb-2 text-sm font-medium text-gray-900">Nome Fantasia</label>
            <input type="text" readonly id="name_fantasy"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                value="{{ $fornecedor->name_fantasy }}" required />
        </div>
        <div>
            <label for="business_name" class="block mb-2 text-sm font-medium text-gray-900">Razão Social</label>
            <input type="text" readonly id="business_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                value="{{ $fornecedor->business_name }}" required />
        </div>
        <div>
            <label for="cpf_cnpj" class="block mb-2 text-sm font-medium text-gray-900">CPF/CNPJ</label>
            <input type="text" readonly id="cpf_cnpj"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                value="{{ $fornecedor->cpf_cnpj }}" required />
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">E-mail</label>
            <input type="email" readonly id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                value="{{ $fornecedor->email }}" required />
        </div>
        <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Telefone</label>
            <input type="tel" readonly id="phone"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                value="{{ $fornecedor->phone }}" required />
        </div>

    </div>

    <div class="pb-4 font-bold">
        <h2>Dados de Endereço</h2>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Endereço</label>
            <input type="text" readonly id="name_fantasy"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                value="{{ $fornecedor->address }}" required />
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <label for="number" class="block mb-2 text-sm font-medium text-gray-900">Número</label>
                <input type="text" readonly id="number"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                    value="{{ $fornecedor->number }}" required />
            </div>
            <div>
                <label for="complement" class="block mb-2 text-sm font-medium text-gray-900">Complemento</label>
                <input type="text" readonly id="complement"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                    value="{{ $fornecedor->complement }}" required />
            </div>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="neighborhood" class="block mb-2 text-sm font-medium text-gray-900">Bairro</label>
                <input type="text" readonly id="neighborhood"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                    value="{{ $fornecedor->neighborhood }}" required />
            </div>
            <div>
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">Cidade</label>
                <input type="text" readonly id="city"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                    value="{{ $fornecedor->city }}" required />
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="state" class="block mb-2 text-sm font-medium text-gray-900">Estado</label>
                <input type="text" readonly id="state"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                    value="{{ $fornecedor->state }}" required />
            </div>
            <div>
                <label for="country" class="block mb-2 text-sm font-medium text-gray-900">País</label>
                <input type="text" readonly id="country"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                    value="{{ $fornecedor->country }}" required />
            </div>
        </div>
    </div>
</x-layout>
