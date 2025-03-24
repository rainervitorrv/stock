<x-layout>
    <x-slot:heading>
        Vaga de Emprego
    </x-slot:heading>

    <h2 class="font-bold text-lg"> {{ $job->title }}</h2>

    <p>
        Este trabalho paga {{ $job->salary }} por mês.
    </p>

    @can('edit', $job)
        <div class="mt-6">
            <x-button href="/jobs/{{ $job->id }}/edit">Editar Vaga</x-button>
        </div>
    @endcan
</x-layout>
