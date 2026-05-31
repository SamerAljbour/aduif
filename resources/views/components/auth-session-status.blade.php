@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm', 'style' => 'color: var(--color-primary);']) }}>
        {{ $status }}
    </div>
@endif
