<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150', 'style' => 'background: var(--color-accent); color: var(--color-surface); --tw-ring-color: var(--color-accent-light);']) }}>
    {{ $slot }}
</button>
