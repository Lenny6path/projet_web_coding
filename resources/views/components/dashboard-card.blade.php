{{-- resources/views/components/dashboard-card.blade.php --}}
@props(['title', 'count', 'route'])
<a href="{{ $route }}" class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-lg transition-all p-5 flex flex-col justify-between text-center min-w-[120px]">
    <div class="text-gray-600 text-base font-medium break-words">
        {{ $title }}
    </div>
    <div class="text-4xl font-bold text-indigo-600 mt-2">
        {{ $count }}
    </div>
</a>

