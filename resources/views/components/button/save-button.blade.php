<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-7 py-2.5
    me-2 mb-2']) }}>
    {{ $slot }}
</button>
