<x-app-layout>
    <h3 class="display-7 mt-5 flex justify-center mb-5">Create University Account</h3>

    <div class="d-flex justify-content-center">
        <div class="w-50 px-6 py-4 bg-success bg-opacity-25 overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{ route('uni.store') }}">
            @csrf

            @include('_partials.errors')

            <div class="my-4 border border-secondary bg-light rounded-md p-2 checkboxes-consent">
            <x-inputs.text label="University Name" saved="{{ old('uniName') }}" name="uniName" class="mb-3"></x-inputs.text>
            </div>

            <div class="my-4 border border-secondary bg-light rounded-md p-2 checkboxes-consent">
                <x-inputs.select label="Type" saved="{{ old('type') }}" name="type" :options="\App\Enums\Institution\Type::descriptions()" class="mb-3"></x-inputs.select>
            </div>

            <div class="my-4 border border-secondary bg-light rounded-md p-2 checkboxes-consent">
                <x-inputs.text label="Connection Count" saved="{{ old('connections') }}" name="connections" class="mb-3"></x-inputs.text>
            </div>

            <div class="my-4 border border-secondary bg-light rounded-md p-2 checkboxes-consent">
                <x-inputs.text label="First Name" saved="{{ old('first') }}" name="first" class="mb-3"></x-inputs.text>
            </div>

            <div class="my-4 border border-secondary bg-light rounded-md p-2 checkboxes-consent">
                <x-inputs.text label="Last Name" saved="{{ old('last') }}" name="last" class="mb-3"></x-inputs.text>
            </div>

            <div class="my-4 border border-secondary bg-light rounded-md p-2 checkboxes-consent">
                <x-inputs.text label="Title" saved="{{ old('title') }}" name="title" class="mb-3"></x-inputs.text>
            </div>

            <div class="my-4 border border-secondary bg-light rounded-md p-2 checkboxes-consent">
                <x-inputs.text label="Email Address" saved="{{ old('email') }}" name="email" class="mb-3"></x-inputs.text>
            </div>

            <div class="my-4 border border-secondary bg-light rounded-md p-2 checkboxes-consent">
                <x-inputs.text label="Password" saved="{{ old('password') }}" name="password" type="password" class="mb-3"></x-inputs.text>
            </div>

            <div class="text-end">
                <x-button>Submit</x-button>
            </div>
        </form>
        </div>
    </div>
</x-app-layout>
