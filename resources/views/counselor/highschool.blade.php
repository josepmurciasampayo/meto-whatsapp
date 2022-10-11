<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="max-width: 70%">
                <div class="p-6 bg-white border-b border-gray-200">
                    <?php echo $school['name'] ?> - Administration
                </div>
                <div class="p-6">
                    <form  method="POST" action="/highschool" name="highschool" id="highschool">

                        @csrf

                        <input type="hidden" value="{{ $school['id'] }}" name="id" id="id">

                        <div class="mb-4">
                            <x-label for="name" value="School Name" />
                            <x-input class="block mt-1 w-full" id="name" name="name" type="text" :value="$school['name']" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-label for="city" value="City" />
                            <x-input class="block mt-1 w-full" id="city" name="city" type="text" :value="$school['city']" />
                        </div>

                        <div class="mb-4">
                            <x-label for="country" value="Country" />
                            <select class="form-select" id="country" name="country">
                                <?php foreach ($countries as $country) { ?>
                                    <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-label for="curriculum" value="Curriculum" />
                            <select class="form-select" id="curriculum" name="curriculum">
                                <?php foreach ($curricula as $id => $curriculum) { ?>
                                    <option value="{{ $id }}">{{ $curriculum }}</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-label for="type" value="School Type" />
                            <select class="form-select" id="type" name="type">
                                <?php foreach ($types as $id => $type) { ?>
                                    <option value="{{ $id }}">{{ $type }}</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-label for="enrollment" value="School Size" />
                            <select class="form-select" id="enrollment" name="enrollment">
                                <?php foreach ($sizes as $id => $size) { ?>
                                <option value="{{ $id }}">{{ $size }}</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="text-end">
                            <x-button>Submit Changes</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
