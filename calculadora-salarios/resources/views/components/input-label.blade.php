@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-dark-blue-300']) }}>
    {{ $value ?? $slot }}
</label>
