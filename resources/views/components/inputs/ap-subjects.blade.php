@props(['name', 'label', 'saved' => ''])

<x-inputs.select-other :name="$name" :label="$label" :saved="$saved">
    <x-slot name="options">
        <option value="AP Research">AP Research</option>
        <option value="AP Seminar">AP Seminar</option>
        <option value="AP 2-D Art and Design">AP 2-D Art and Design</option>
        <option value="AP 3-D Art and Design">AP 3-D Art and Design</option>
        <option value="AP Art History">AP Art History</option>
        <option value="AP Drawing">AP Drawing</option>
        <option value="AP Music Theory">AP Music Theory</option>
        <option value="AP English Language and Composition">
            <option value="AP English Language and Composition">AP English Language and Composition</option>
            <option value="AP English Literature and Composition">AP English Literature and Composition</option>
            <option value="AP Comparative Government and Politics">AP Comparative Government and Politics</option>
            <option value="AP European History">AP European History</option>
            <option value="AP Human Geography">AP Human Geography</option>
            <option value="AP Macroeconomics">AP Macroeconomics</option>
            <option value="AP Microeconomics">AP Microeconomics</option>
            <option value="AP Psychology">AP Psychology</option>
            <option value="AP United States Government and Politics">AP United States Government and Politics</option>
            <option value="AP United States History">AP United States History</option>
            <option value="AP World History: Modern">AP World History: Modern</option>
            <option value="AP Calculus AB">AP Calculus AB</option>
            <option value="AP Calculus BC">AP Calculus BC</option>
            <option value="AP Computer Science A">AP Computer Science A</option>
            <option value="AP Computer Science Principles">AP Computer Science Principles</option>
            <option value="AP Statistics">AP Statistics</option>
            <option value="AP Biology">AP Biology</option>
            <option value="AP Chemistry">AP Chemistry</option>
            <option value="AP Environmental Science">AP Environmental Science</option>
            <option value="AP Physics 1: Algebra-Based">AP Physics 1: Algebra-Based</option>
            <option value="AP Physics 2: Algebra-Based">AP Physics 2: Algebra-Based</option>
        <option value="AP Physics C: Electricity and Magnetism">AP Physics C: Electricity and Magnetism</option>
        <option value="AP Physics C: Mechanics">AP Physics C: Mechanics</option>
        <option value="AP Chinese Language and Culture">AP Chinese Language and Culture</option>
        <option value="AP French Language and Culture">AP French Language and Culture</option>
        <option value="AP German Language and Culture">AP German Language and Culture</option>
        <option value="AP Italian Language and Culture">AP Italian Language and Culture</option>
        <option value="AP Japanese Language and Culture">AP Japanese Language and Culture</option>
        <option value="AP Latin">AP Latin</option>
        <option value="AP Spanish Language and Culture">AP Spanish Language and Culture</option>
        <option value="AP Spanish Literature and Culture">AP Spanish Literature and Culture</option>
    </x-slot>
</x-inputs.select-other>

           
     