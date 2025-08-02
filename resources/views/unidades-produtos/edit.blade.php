<x-layout>
    <div class="flex sm:flex sm:justify-between">
        <x-slot:heading>
            Editar Unidade de Produto: {{ $unidade->name }}
        </x-slot:heading>
        <x-slot:button>
            <div>
                <x-button.delete-button data-modal-target="popup-modal"
                    data-modal-toggle="popup-modal">Excluir</x-button.delete-button>
                <x-button.save-button form="edit-form">Alterar</x-button.save-button>
            </div>
        </x-slot:button>
    </div>

    <form method="POST" id="edit-form" action="{{ route('unidades-produtos.update', ['unidade' => $unidade->id]) }}">
        @csrf
        @method('patch')

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <x-form.form-label for="name">Nome da Unidade</x-form.form-label>
                <x-form.form-input id="name" name="name" value="{{ $unidade->name }}"
                    required />
                <x-form-error name="name" />
            </div>
            <div>
                <x-form.form-label for="abbreviation">Abreviação</x-form.form-label>
                <x-form.form-input id="abbreviation" name="abbreviation"
                    value="{{ $unidade->abbreviation }}" required />
                <x-form-error name="abbreviation" />
            </div>
        </div>


    </form>
    @foreach ($errors as $erro)
        <span class="text-red-500">{{ $erro }}</span>
    @endforeach

    <script>
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
        action="{{ route('unidades-produtos.destroy', ['unidade' => $unidade->id]) }}">
        @csrf
        @method('delete')
    </form>
</x-layout>
