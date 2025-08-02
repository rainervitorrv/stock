<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            Cadastrar Unidade de Produto
        </x-slot:heading>
        <x-slot:button>
            <div>
                <x-button.save-button form="edit-form">Salvar</x-button.save-button>
            </div>
        </x-slot:button>
    </div>

<form method="POST" id="edit-form" action=" {{ route('unidades-produtos.store') }} ">
    @csrf

    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <x-form.form-label for="name">Nome da Unidade</x-form.form-label>
            <x-form.form-input
                id="name" name="name"
                value="{{ old('name') }}" required/>
                <x-form-error name="name" />
        </div>
        <div>
            <x-form.form-label for="abbreviation">Abreviação</x-form.form-label>
            <x-form.form-input
                id="abbreviation" name="abbreviation"
                value="{{ old('abbreviation') }}" required/>
                <x-form-error name="abbreviation" />
        </div>
    </div>
</form>
</x-layout>
