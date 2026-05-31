<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 border rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150', 'style' => 'background: var(--color-surface); border-color: var(--color-accent-light); color: var(--color-primary); --tw-ring-color: var(--color-accent-light);']) }}>
    {{ $slot }}
</button>
