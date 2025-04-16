<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tableau de bord enseignant</h2>
    </x-slot>

    <div class="space-y-6">
        @forelse($cohorts as $cohort)
            <div class="card p-4 shadow rounded">
                <h3 class="font-semibold text-lg mb-2">{{ $cohort->name }}</h3>

                <h4 class="text-gray-600 mb-1">Rétrospectives en cours :</h4>
                <ul class="list-disc ml-6">
                    @forelse($cohort->retros as $retro)
                        <li>{{ $retro->title }} – {{ $retro->created_at->format('d/m/Y') }}</li>
                    @empty
                        <li class="text-sm text-gray-500">Aucune rétrospective en cours</li>
                    @endforelse
                </ul>
            </div>
        @empty
            <p class="text-sm text-gray-600">Aucune promotion assignée.</p>
        @endforelse
    </div>
</x-app-layout>
