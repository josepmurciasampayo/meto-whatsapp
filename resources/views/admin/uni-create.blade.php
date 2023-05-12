<x-app-layout>
    <h3>Create University Account</h3>
    <form class="w-50" method="POST" action="{{ route('uni.store') }}">
        @csrf
        <x-inputs.text label="University Name" name="uniName"></x-inputs.text>
        <x-inputs.select label="Type" name="type" :options="\App\Enums\Institution\Type::descriptions()"></x-inputs.select>
        <x-inputs.text label="Connection Count" name="connections"></x-inputs.text>
        <x-inputs.text label="First Name" name="first"></x-inputs.text>
        <x-inputs.text label="Last Name" name="last"></x-inputs.text>
        <x-inputs.text label="Email Address" name="email"></x-inputs.text>
        <x-inputs.text label="Title" name="title"></x-inputs.text>
        <div class="text-end">
            <x-button>Submit</x-button>
        </div>
    </form>
</x-app-layout>
