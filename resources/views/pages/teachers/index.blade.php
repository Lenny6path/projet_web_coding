<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Liste des enseignants</h2>
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('teachers.create') }}" class="btn btn-primary">Ajouter un enseignant</a>
    </div>

    @if(session('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif

    <table class="table-auto w-full">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($teachers as $teacher)
            <tr>
                <td>{{ $teacher->last_name }}</td>
                <td>{{ $teacher->first_name }}</td>
                <td>{{ $teacher->email }}</td>
                <td class="space-x-2">
                    <a href="{{ route('teachers.edit', $teacher) }}" class="text-blue-600">Modifier</a>
                    <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>
