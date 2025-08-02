<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            Editar: {{ $fornecedor->name_fantasy }}
        </x-slot:heading>
        <x-slot:button>
            <div>
                <x-button.delete-button data-modal-target="popup-modal"
                    data-modal-toggle="popup-modal">Excluir</x-button.delete-button>
                <x-button.save-button form="edit-form">Alterar</x-button.save-button>
            </div>
        </x-slot:button>
    </div>





    <form method="POST" id="edit-form" action="/fornecedores/{{ $fornecedor->id }}">
        @csrf
        @method('patch')

        <div class="pb-4 font-bold">
            <h2>Dados Cadastrais</h2>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-form.form-label for="name_fantasy">Nome Fantasia</x-form.form-label>
                <x-form.form-input id="name_fantasy" name="name_fantasy" value="{{ $fornecedor->name_fantasy }}"
                    required />
                <x-form-error name="name_fantasy" />
            </div>
            <div>
                <x-form.form-label for="business_name">Razão Social</x-form.form-label>
                <x-form.form-input id="business_name" name="business_name" value="{{ $fornecedor->business_name }}" />
                <x-form-error name="business_name" />
            </div>
            <div>
                <x-form.form-label for="cpf_cnpj">CPF/CNPJ</x-form.form-label>
                <x-form.form-input id="cpf_cnpj" name="cpf_cnpj" value="{{ $fornecedor->cpf_cnpj }}" required />
                <x-form-error name="cpf_cnpj" />
            </div>
            <div>
                <x-form.form-label for="type">Tipo</x-form.form-label>
                <x-form-error name="type" />
                <select name="type"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                    <option value="Pessoa Física" {{ $fornecedor->type == 'Pessoa Física' ? 'selected' : '' }}>Pessoa
                        Física</option>
                    <option value="Pessoa Jurídica" {{ $fornecedor->type == 'Pessoa Jurídica' ? 'selected' : '' }}>
                        Pessoa Jurídica</option>
                </select>
            </div>
            <div>
                <x-form.form-label for="email">E-mail</x-form.form-label>
                <x-form.form-input type="email" id="email" name="email" value="{{ $fornecedor->email }}" />
                <x-form-error name="email" />
            </div>
            <div>
                <x-form.form-label for="phone">Telefone</x-form.form-label>
                <x-form.form-input type="tel" id="phone" name="phone" value="{{ $fornecedor->phone }}" />
                <x-form-error name="phone" />
            </div>
        </div>

        <div class="pb-4 font-bold">
            <h2>Dados de Endereço</h2>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-form.form-label for="address">Endereço</x-form.form-label>
                <x-form.form-input id="address" name="address" value="{{ $fornecedor->address }}" required />
                <x-form-error name="address" />
            </div>
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <x-form.form-label for="number">Número</x-form.form-label>
                    <x-form.form-input id="number" name="number" value="{{ $fornecedor->number }}" />
                    <x-form-error name="number" />
                </div>
                <div>
                    <x-form.form-label for="complement">Complemento</x-form.form-label>
                    <x-form.form-input id="complement" name="complement" value="{{ $fornecedor->complement }}" />
                    <x-form-error name="complement" />
                </div>
            </div>

            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-form.form-label for="neighborhood">Bairro</x-form.form-label>
                    <x-form.form-input id="neighborhood" name="neighborhood" value="{{ $fornecedor->neighborhood }}"
                        required />
                    <x-form-error name="neighborhood" />
                </div>
                <div>
                    <x-form.form-label for="city">Cidade</x-form.form-label>
                    <x-form.form-input id="city" name="city" value="{{ $fornecedor->city }}" required />
                    <x-form-error name="city" />
                </div>
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-3">
                <div>
                    <x-form.form-label for="state">Estado</x-form.form-label>
                    <x-form.form-input type="text" id="state" name="state" value="{{ $fornecedor->state }}"
                        required />
                    <x-form-error name="state" />
                </div>
                <div>
                    <x-form.form-label for="country"
                        class="block mb-2 text-sm font-medium text-gray-900">País</x-form.form-label>
                    <x-form.form-input id="country" name="country" value="{{ $fornecedor->country }}" required />
                    <x-form-error name="country" />
                </div>
                <div>
                    <x-form.form-label for="cep"
                        class="block mb-2 text-sm font-medium text-gray-900">CEP</x-form.form-label>
                    <x-form.form-input id="cep" name="cep" value="{{ $fornecedor->cep }}" required
                        maxlength="9" />
                    <x-form-error name="cep" />
                </div>
            </div>
        </div>


    </form>
    @foreach ($errors as $erro)
        <span class="text-red-500">{{ $erro }}</span>
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cpfCnpjInput = document.getElementById('cpf_cnpj');
            cpfCnpjInput.addEventListener('input', function(e) {
                let value = cpfCnpjInput.value.replace(/\D/g, '');

                if (value.length <= 11) {
                    // CPF: 000.000.000-00
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                } else {
                    // CNPJ: 00.000.000/0000-00
                    value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                    value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                    value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                    value = value.replace(/(\d{4})(\d)/, '$1-$2');
                }
                cpfCnpjInput.value = value;
            });
        });

        setTimeout(() => {
            const alert = document.getElementById('alert-success');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000); // Fecha após 3 segundos
    </script>

    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        Você tem certeza que deseja excluir esse cadastro?
                    </h3>
                    <button form="delete-form" data-modal-hide="popup-modal"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Sim, tenho certeza
                    </button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">
                        Não, cancelar</button>
                </div>
            </div>
        </div>

    </div>

    <form id="delete-form" class="hidden" method="POST"
        action="{{ route('fornecedores.destroy', ['fornecedor' => $fornecedor->id]) }}">
        @csrf
        @method('delete')
    </form>
</x-layout>
