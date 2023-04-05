@props(['name', 'label', 'saved' => ''])

<x-inputs.select-other :name="$name" :label="$label" :saved="$saved">
    <x-slot name="options">
        <option value="A*">A*</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="I do not plan to take the A2 exam for this subject">I do not plan to take the A2 exam for this subject</option>
        <option value="I do not have a predicted A2 score for this subject yet, but I plan to have one in the future.">I do not have a predicted A2 score for this subject yet, but I plan to have one in the future.</option>
    </x-slot>
</x-inputs.select-other>

       