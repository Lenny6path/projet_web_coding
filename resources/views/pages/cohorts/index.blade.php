<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Gestion des promotions</h2>
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('cohorts.create') }}" class="btn btn-primary">Ajouter une promotion</a>
    </div>

    @if(session('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto">
        <thead>
        <tr>
            <th class="text-left">Nom</th>
            <th class="text-left">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cohorts as $cohort)
            <tr>
                <td>{{ $cohort->name }}</td>
                <td class="space-x-2">
                    <a href="{{ route('cohorts.edit', $cohort) }}" class="text-blue-600 hover:underline">Modifier</a>
                    <form action="{{ route('cohorts.destroy', $cohort) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cette promotion ?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>
