<x-app-layout>
<h3>Adjust Student Finances and Academics</h3>
    <p>
        Your database currently displays all students who have an EFC of at least {{ "input" }} and grades of at
        least {{ "input" }}. If you would like to change these parameters, please use the fields below and then click ‘Save'.
    </p>
    <x-inputs.text name="efc" label="Minimum Student EFC" help="What is the minimum annual financial contribution that a student who receives the top available scholarship would need to be able to contribute? If no minimum, enter 0. Please use USD and enter only a number." />
</x-app-layout>
