<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-full bg-purple-600 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-200']) }}>
    {{ $slot }}
</button>
