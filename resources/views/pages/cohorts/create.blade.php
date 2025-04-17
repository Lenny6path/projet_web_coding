<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Ajouter un enseignant</h2>
    </x-slot>

    <form action="{{ route('teachers.store') }}" method="POST" class="space-y-4 max-w-lg">
        @csrf

        <label for="last_name" class="block font-semibold">Nom</label>
        <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full border rounded px-2 py-1">
        @error('last_name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <label for="first_name" class="block font-semibold">Prénom</label>
        <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full border rounded px-2 py-1">
        @error('first_name')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <label for="email" class="block font-semibold">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-2 py-1">
        @error('email')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
    </form>
</x-app-layout>
