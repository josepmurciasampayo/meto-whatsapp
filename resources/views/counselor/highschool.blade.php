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
                                <option value=""></option>
                                <?php foreach ($countries as $country) { ?>
                                    <?php $selected = ($country['id'] == $school['country']) ? "selected" : "" ?>
                                    <option value="{{ $country['id'] }}" {{ $selected }}>{{ $country['name'] }}</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-label for="curriculum" value="Curriculum" />
                            <select class="form-select" id="curriculum" name="curriculum">
                                <option value=""></option>
                                <?php foreach ($curricula as $id => $curriculum) { ?>
                                    <?php $selected = ($id == $school['curriculum']) ? "selected" : "" ?>
                                    <option value="{{ $id }}" {{ $selected }}>{{ $curriculum }}</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-label for="type" value="School Type" />
                            <select class="form-select" id="type" name="type">
                                <option value=""></option>
                                <?php foreach ($types as $id => $type) { ?>
                                    <?php $selected = ($id == $school['type']) ? "selected" : "" ?>
                                    <option value="{{ $id }}" {{ $selected }}>{{ $type }}</option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-label for="size" value="School Size" />
                            <select class="form-select" id="size" name="size">
                                <option value=""></option>
                                <?php foreach ($sizes as $id => $size) { ?>
                                    <?php $selected = ($id == $school['size']) ? "selected" : "" ?>
                                    <option value="{{ $id }}" {{ $selected }}>{{ $size }}</option>
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
