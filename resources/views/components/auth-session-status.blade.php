@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm', 'style' => 'color: #191231;']) }}>
        {{ $status }}
    </div>
@endif
