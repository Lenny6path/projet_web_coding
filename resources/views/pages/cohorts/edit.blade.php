<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Modifier la promotion</h2>
    </x-slot>

    <form action="{{ route('cohorts.update', $cohort) }}" method="POST" class="space-y-4 max-w-lg">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-medium text-sm">Nom</label>
            <input type="text" name="name" class="w-full border-gray-300 rounded" value="{{ old('name', $cohort->name) }}">
            @error('name')
            <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary">Enregistrer</button>
    </form>
</x-app-layout>
