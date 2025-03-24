<x-layout>
    <x-slot:heading>
        Vagas de Emprego
    </x-slot:heading>
    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/jobs/{{ $job['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
                <div class="font-bold text-blue-500 text-sm">{{ $job->employer->name}}</div>

                <div>
                    <strong> {{ $job['title'] }}:</strong> paga {{ $job['salary'] }} por mês.
                </div>
            </a>
        @endforeach

        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>
