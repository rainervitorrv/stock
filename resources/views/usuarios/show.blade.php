<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            {{ $usuario->name }}
        </x-slot:heading>
        <x-slot:button>
            <x-button.create-button href="{{ route('usuarios.edit', ['usuario' => $usuario->id]) }}">Editar Cadastro</x-button.create-button>
        </x-slot:button>
    </div>

    <div class="grid gap-6 mb-6 md:grid-cols-1">
        <div>
            <x-form.form-label for="name">Nome Completo</x-form.form-label>
            <x-form.form-input 
                id="name_fantasy" name="name" class="cursor-not-allowed" readonly
                value="{{ $usuario->name }}" required/>
                <x-form-error name="name" />
        </div>

        <div>
            <x-form.form-label for="email">E-mail</x-form.form-label>
            <x-form.form-input 
                id="email" name="email" class="cursor-not-allowed" readonly
                value="{{ $usuario->email }}" required />
                <x-form-error name="email" />
        </div>
        <div>
            <x-form.form-label for="password">Senha</x-form.form-label>
            <x-form.form-input 
            id="password" name="password" type="password" class="cursor-not-allowed" readonly
                value="************" required />
            <x-form-error name="password" />
        </div>
    </div>
    
</x-layout>
