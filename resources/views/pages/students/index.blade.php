<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Gestion des étudiants</h2>
    </x-slot>

    <div class="mb-4">
        <a href="{{ route('students.create') }}" class="btn btn-primary">Ajouter un étudiant</a>
    </div>

    @if(session('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif

    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2">Nom</th>
            <th class="px-4 py-2">Prénom</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td class="border px-4 py-2">{{ $student->last_name }}</td>
                <td class="border px-4 py-2">{{ $student->first_name }}</td>
                <td class="border px-4 py-2">{{ $student->email }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-secondary">Modifier</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" onsubmit="return confirm('Supprimer cet étudiant ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>


@include('pages.students.student-modal')
