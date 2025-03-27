<div class="bg-white p-4 rounded-lg shadow-md {{ $attributes->get('class') }}">
    @isset($title)
        <div class="text-lg font-medium text-gray-900">
            {{ $title }}
        </div>
    @endisset
    {{ $slot }}
</div>
