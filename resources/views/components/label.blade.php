@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-lg text-black']) }}>
    {{ $value ?? $slot }}
</label>
