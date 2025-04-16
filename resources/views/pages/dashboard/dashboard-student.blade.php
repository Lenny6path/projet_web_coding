<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tableau de bord étudiant</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="font-semibold text-gray-700 mb-2">Bilans à faire</h3>
            <ul class="list-disc ml-4">
                @foreach($todoAssessments as $assessment)
                    <li>{{ $assessment->title }}</li>
                @endforeach
            </ul>

            <h3 class="font-semibold text-gray-700 mt-4 mb-2">Bilans complétés</h3>
            <ul class="list-disc ml-4 text-green-600">
                @foreach($doneAssessments as $assessment)
                    <li>{{ $assessment->title }}</li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="font-semibold text-gray-700 mb-2">Tâches à faire</h3>
            <ul class="list-disc ml-4">
                @foreach($pendingTasks as $task)
                    <li>{{ $task->title }}</li>
                @endforeach
            </ul>

            <h3 class="font-semibold text-gray-700 mt-4 mb-2">Tâches pointées</h3>
            <ul class="list-disc ml-4 text-green-600">
                @foreach($doneTasks as $task)
                    <li>{{ $task->title }} — {{ $task->pivot->comment }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
