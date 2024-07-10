@props([
    'label',
])

@php
    $arrowClasses = '';

    $sorter = request()->query('sort') === $label
        ? "-$label"
        : $label;

    if (! request()->query('sort')) {
        $arrowClasses = 'opacity-50';
    }

    if (request()->query('sort') === $label) {
        $arrowClasses = 'opacity-100';
    }

    if (request()->query('sort') === "-$label") {
        $arrowClasses = 'opacity-100 rotate-180';
    }
@endphp

<th class="d-flex align-items-center justify-content-between">
    <span>{{ ucfirst($label) }}</span>
    <a href="{{ route('books.index', ['sort' => $sorter]) }}" class="ms-1">
        <img
            {{ $attributes->merge(['class' => $arrowClasses]) }}
            src="{{ Vite::asset('resources/images/arrow-down.svg') }}"
            alt="arrow-down-icon"
            width="16"
        >
    </a>
</th>