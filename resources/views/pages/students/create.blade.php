<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Ajouter un étudiant</h2>
    </x-slot>

    <form action="{{ route('students.store') }}" method="POST" class="space-y-4 max-w-lg">
        @csrf

        <x-input-label for="last_name" value="Nom" />
        <x-text-input name="last_name" value="{{ old('last_name') }}" class="w-full" />
        <x-input-error :messages="$errors->get('last_name')" />

        <x-input-label for="first_name" value="Prénom" />
        <x-text-input name="first_name" value="{{ old('first_name') }}" class="w-full" />
        <x-input-error :messages="$errors->get('first_name')" />

        <x-input-label for="email" value="Email" />
        <x-text-input type="email" name="email" value="{{ old('email') }}" class="w-full" />
        <x-input-error :messages="$errors->get('email')" />

        <x-input-label for="cohort_id" value="Promotion" />
        <select name="cohort_id" class="w-full rounded border-gray-300">
            @foreach($cohorts as $cohort)
                <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('cohort_id')" />

        <x-primary-button>Ajouter</x-primary-button>
    </form>
</x-app-layout>
