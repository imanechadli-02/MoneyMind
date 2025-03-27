@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
