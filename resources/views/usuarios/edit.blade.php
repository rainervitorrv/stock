<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            Editar Usuário: {{ $usuario->name }}
        </x-slot:heading>
        <x-slot:button>
            <div>
                <x-button.save-button form="edit-form">Salvar</x-button.save-button>
            </div>  
        </x-slot:button>
    </div>
    
<form method="POST" id="edit-form" action=" {{ route('usuarios.update', ['usuario' => $usuario->id ]) }} ">
    @csrf
    @method('patch')

    <div class="grid gap-6 mb-6 md:grid-cols-1">
        <div>
            <x-form.form-label for="name">Nome Completo</x-form.form-label>
            <x-form.form-input 
                id="name_fantasy" name="name"
                value="{{ $usuario->name }}" required/>
                <x-form-error name="name" />
        </div>

        <div>
            <x-form.form-label for="enail">E-mail</x-form.form-label>
            <x-form.form-input 
                id="email" name="email"
                value="{{ $usuario->email }}" required />
                <x-form-error name="email" />
        </div>
        <div>
            <x-form.form-label for="password">Senha</x-form.form-label>
            <x-form.form-input 
            id="password" name="password" type="password"
                value="" />
            <x-form-error name="password" />
        </div>
        <div>
            <x-form.form-label for="password-confirmation">Senha</x-form.form-label>
            <x-form.form-input 
            id="password_confirmation" name="password_confirmation" type="password"
                value="" />
            <x-form-error name="password_confirmation" />
        </div>
    </div>
</form>
</x-layout>
