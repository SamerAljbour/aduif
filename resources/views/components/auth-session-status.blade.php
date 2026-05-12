@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm', 'style' => 'color: #FF7782;']) }}>
        {{ $status }}
    </div>
@endif
