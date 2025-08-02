<button {{ $attributes->merge(['type' => 'submit', 'class' => 'focus:outline-none text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-7 py-2.5 me-2 mb-2']) }}>
    {{ $slot }}
</button>
