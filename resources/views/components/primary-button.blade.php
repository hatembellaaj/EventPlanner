<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-300']) }}>
    {{ $slot }}
</button>
