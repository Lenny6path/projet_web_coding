{{-- resources/views/components/dashboard-card.blade.php --}}
@props(['title', 'count', 'route'])
<a href="{{ $route }}" class="bg-white rounded-2xl hover:shadow-lg transition-all p-2 flex flex-col justify-between text-center ">
    <div class="text-gray-600 text-base font-medium break-words">
        {{ $title }}
    </div>
    <div class="text-4xl font-bold text-indigo-600 mt-2">
        {{ $count }}
    </div>
</a>

