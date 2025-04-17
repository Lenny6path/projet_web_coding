<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Dashboard') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-6">
        <!-- Block 1 : Vue d’ensemble -->
        <div class="card-body">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Statistiques globales</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
                <x-dashboard-card title="Promotions" :count="$cohortsCount" route="{{ route('cohorts.index') }}" />
                <x-dashboard-card title="Étudiants" :count="$studentsCount" route="{{ route('students.index') }}" />
                <x-dashboard-card title="Enseignants" :count="$teachersCount" route="{{ route('teachers.index') }}" />
                <x-dashboard-card title="Groupes" :count="$groupsCount" route="{{ route('group.index') }}" />
            </div>
        </div>

        <!-- Block 2 : Raccourcis -->
        <div class="card-body">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Liens rapides</h2>
            <div class="flex flex-col gap-4">
                <a href="{{ route('cohorts.index') }}" class="btn btn-sm btn-primary">Gérer les promotions</a>
                <a href="{{ route('students.index') }}" class="btn btn-sm btn-primary">Gérer les étudiants</a>
                <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-primary">Gérer les enseignants</a>
                <a href="{{ route('group.index') }}" class="btn btn-sm btn-primary">Gérer les groupes</a>
            </div>
        </div>


    </div>
    <!-- end: grid -->
</x-app-layout>
