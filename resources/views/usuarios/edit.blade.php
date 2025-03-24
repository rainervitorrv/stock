<x-layout>
    <x-slot:heading>
        Editar vaga: {{ $job->title}}
    </x-slot:heading>

    <form method="POST" action="/jobs/{{ $job->id }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class=" grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Título</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    placeholder="Gerente de Produção"
                                    value="{{ $job->title}}"
                                    required minlength="3">
                            </div>
                            @error('title')
                                <p class="text-red-500 font-semibold mt-1 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="salary" class="block text-sm/6 font-medium text-gray-900">Salário</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input
                                    type="number"
                                    name="salary"
                                    id="salary"
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    placeholder="R$50.000 Por Mês"
                                    value="{{ $job->salary}}"
                                    required>
                            </div>
                            @error('salary')
                                <p class="text-red-500 font-semibold mt-1 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-6 flex items-center gap-x-3 justify-between">
            <div class="flex items-center justify-center gap-x-6">
                <button form="delete-form" class="text-sm font-semibold text-red-500 cursor-pointer">Apagar</button>
            </div>
            <div class="flex items-center justify-center gap-x-6">
                <a href="/jobs/{{ $job->id }}" class="text-sm/6 font-semibold text-gray-900">Cancelar</a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Atualizar
                </button>
            </div>
        </div>
    </form>

    <form id="delete-form" class="hidden" method="POST" action="/jobs/{{ $job->id }}">
        @csrf
        @method('delete')
    </form>

</x-layout>
