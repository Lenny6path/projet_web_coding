<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Modifier l'enseignant</h2>
    </x-slot>

    <form action="{{ route('teachers.update', $teacher) }}" method="POST" class="space-y-4 max-w-lg">
        @csrf
        @method('PUT')

        <x-input-label for="last_name" value="Nom" />
        <x-text-input name="last_name" value="{{ old('last_name', $teacher->last_name) }}" class="w-full" />
        <x-input-error :messages="$errors->get('last_name')" />

        <x-input-label for="first_name" value="Prénom" />
        <x-text-input name="first_name" value="{{ old('first_name', $teacher->first_name) }}" class="w-full" />
        <x-input-error :messages="$errors->get('first_name')" />

        <x-input-label for="email" value="Email" />
        <x-text-input type="email" name="email" value="{{ old('email', $teacher->email) }}" class="w-full" />
        <x-input-error :messages="$errors->get('email')" />

        <x-primary-button>Mettre à jour</x-primary-button>
    </form>
</x-app-layout>
