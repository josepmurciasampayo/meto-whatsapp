@props(['name', 'label', 'saved' => ''])

<x-inputs.select-other :name="$name" :label="$label" :saved="$saved">
    <x-slot name="options">
        <option value="7*">7</option>
        <option value="6">6</option>
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
    </x-slot>
</x-inputs.select-other>

       