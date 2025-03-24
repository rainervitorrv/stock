<x-layout>
    <x-slot:heading>
        Criar uma vaga
    </x-slot:heading>

    <form method="POST" action="/jobs">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Criar uma nova vaga</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Nós precisamos de apenas alguns detalhes sobre a vaga.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="title">Título</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="title" id="title" placeholder="Gerente de Produção" minlength="3" required />
                            <x-form-error name="title" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="salary">Salário</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="number" name="salary" id="salary" placeholder="R$50.000 Por Mês" required />
                            <x-form-error name="salary" />
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/jobs" class="text-sm/6 font-semibold text-gray-900">Cancelar</a>
            <x-form-button>Salvar</x-form-button>
        </div>
    </form>

</x-layout>
