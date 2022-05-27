@props(['active'])

@if($active)
    <span
        class="absolute inset-y-0 left-0 w-1 bg-blue-500 rounded-tr-lg rounded-br-lg"
        aria-hidden="true"
    ></span>
@endif
<a {{ $attributes->merge(['class' => 'inline-flex items-center w-full text-sm font-semibold text-gray-500 hover:text-gray-800 transition-colors duration-150']) }}>
    {{ $icon ?? '' }}
    <span class="ml-4 {{ $active ? 'text-gray-800' : '' }}">{{ $slot }}</span>
</a>
