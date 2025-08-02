<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            Cadastrar Fornecedor ou Cliente
        </x-slot:heading>
        <x-slot:button>
            <div>
                <x-button.save-button form="edit-form">Salvar</x-button.save-button>
            </div>
        </x-slot:button>
    </div>

<form method="POST" id="edit-form" action=" {{ route('fornecedores.store') }} ">
    @csrf

    <div class="pb-4 font-bold">
        <h2>Dados Cadastrais</h2>
    </div>

    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <x-form.form-label for="name_fantasy">Nome Fantasia</x-form.form-label>
            <x-form.form-input
                id="name_fantasy" name="name_fantasy"
                value="{{ old('name_fantasy') }}" required/>
                <x-form-error name="name_fantasy" />
        </div>
        <div>
            <x-form.form-label for="business_name">Razão Social</x-form.form-label>
            <x-form.form-input
                id="business_name" name="business_name"
                value="{{ old('business_name') }}" />
                <x-form-error name="business_name" />
        </div>
        <div>
            <x-form.form-label for="cpf_cnpj">CPF/CNPJ</x-form.form-label>
            <x-form.form-input
            id="cpf_cnpj" name="cpf_cnpj"
                value="{{ old('cpf_cnpj') }}" required />
            <x-form-error name="cpf_cnpj" />
        </div>
        <div>
            <x-form.form-label for="type">Tipo</x-form.form-label>
            <x-form-error name="type" />
            <select name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                <option value="Pessoa Física" {{ old('tipo') == 'Pessoa Física' ? 'selected' : '' }}>Pessoa Física</option>
                <option value="Pessoa Jurídica" {{ old('tipo') == 'Pessoa Jurídica' ? 'selected' : '' }}>Pessoa Jurídica</option>
            </select>
        </div>
        <div>
            <x-form.form-label for="email">E-mail</x-form.form-label>
            <x-form.form-input type="email" id="email" name="email"
                value="{{ old('email') }}" />
            <x-form-error name="email" />
        </div>
        <div>
            <x-form.form-label for="phone">Telefone</x-form.form-label>
            <x-form.form-input type="tel" id="phone" name="phone"
                value="{{ old('phone') }}" />
            <x-form-error name="phone" />
        </div>
    </div>

    <div class="pb-4 font-bold">
        <h2>Dados de Endereço</h2>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <x-form.form-label for="address" >Endereço</x-form.form-label>
            <x-form.form-input id="address" name="address"
                value="{{ old('address') }}" required />
            <x-form-error name="address" />
        </div>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <x-form.form-label for="number">Número</x-form.form-label>
                <x-form.form-input id="number" name="number"
                    value="{{ old('number') }}" />
                <x-form-error name="number" />
            </div>
            <div>
                <x-form.form-label for="complement">Complemento</x-form.form-label>
                <x-form.form-input id="complement" name="complement"
                    value="{{ old('complement') }}" />
                <x-form-error name="complement" />
            </div>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-form.form-label for="neighborhood">Bairro</x-form.form-label>
                <x-form.form-input id="neighborhood"  name="neighborhood"
                    value="{{ old('neighborhood') }}" required />
                <x-form-error name="neighborhood" />
            </div>
            <div>
                <x-form.form-label for="city">Cidade</x-form.form-label>
                <x-form.form-input id="city"  name="city"
                    value="{{ old('city') }}" required />
                <x-form-error name="city" />
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-3">
            <div>
                <x-form.form-label for="state">Estado</x-form.form-label>
                <x-form.form-input type="text" id="state" name="state"
                    value="{{ old('state') }}" required />
                <x-form-error name="state" />
            </div>
            <div>
                <x-form.form-label for="country" class="block mb-2 text-sm font-medium text-gray-900">País</x-form.form-label>
                <x-form.form-input id="country" name="country" value="Brasil"
                 required />
                <x-form-error name="country" />
            </div>
            <div>
                <x-form.form-label for="cep" class="block mb-2 text-sm font-medium text-gray-900">CEP</x-form.form-label>
                <x-form.form-input id="cep" name="cep"
                    value="{{ old('cep') }}" required maxlength="9" />
                <x-form-error name="cep" />
            </div>
        </div>
    </div>
</form>

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
</script>
</x-layout>
