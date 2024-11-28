@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-log text-black dark:text-gray']) }}>
    {{ $value ?? $slot }}
</label>
