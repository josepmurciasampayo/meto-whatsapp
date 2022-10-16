<x-app-layout>
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
                <x-label for="url" value="Website" />
                <x-input class="block mt-1 w-full" id="url" name="url" type="text" :value="$school['url']" autofocus />
            </div>

            <div class="mb-4">
                <x-label for="url" value="Career Email Address" />
                <x-input class="block mt-1 w-full" id="url" name="url" type="text" :value="$school['url']" autofocus />
            </div>

            <div class="mb-4">
                <x-label for="url" value="Connection Email Addresses" />
                <x-input class="block mt-1 w-full" id="url" name="url" type="text" :value="$school['url']" autofocus />
            </div>

            <div class="mb-4">
                <x-label for="url" value="Government-Assigned School Code" />
                <x-input class="block mt-1 w-full" id="url" name="url" type="text" :value="$school['url']" autofocus />
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
                <x-label for="boarding" value="Boarding" />
                <select class="form-select" id="boarding" name="boarding">
                    <option value=""></option>
                    <?php $selected = ($id == $school['type']) ? "selected" : "" ?>
                    <option value="0" {{ ($school->boarding === 0) ? "selected" : "" }}>No</option>
                    <option value="1" {{ ($school->boarding === 1) ? "selected" : "" }}>Yes</option>

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
                <x-label for="cost" value="School Cost" />
                <select class="form-select" id="cost" name="cost">
                    <option value=""></option>
                    <?php foreach ($costs as $id => $cost) { ?>
                    <?php $selected = ($id == $school['cost']) ? "selected" : "" ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $cost }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="exam" value="Finishing Exam" />
                <select class="form-select" id="exam" name="exam">
                    <option value=""></option>
                    <?php foreach ($exams as $id => $exam) { ?>
                    <?php $selected = ($id == $school['exam']) ? "selected" : "" ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $exam }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="month" value="Finishing Month" />
                <select class="form-select" id="month" name="month">
                    <option value=""></option>
                    <?php foreach ($months as $id => $month) { ?>
                    <?php $selected = ($id == $school['month']) ? "selected" : "" ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $month }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="schoolSize" value="School Size" />
                <select class="form-select" id="schoolSize" name="schoolSize">
                    <option value=""></option>
                    <?php foreach ($schoolSizes as $id => $size) { ?>
                        <?php $selected = ($id == $school['schoolSize']) ? "selected" : "" ?>
                        <option value="{{ $id }}" {{ $selected }}>{{ $size }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="classSize" value="Class Size" />
                <select class="form-select" id="classSize" name="classSize">
                    <option value=""></option>
                    <?php foreach ($classSizes as $id => $size) { ?>
                    <?php $selected = ($id == $school['classSize']) ? "selected" : "" ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $size }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="text-end">
                <x-button>Submit Changes</x-button>
            </div>
        </form>
    </div>
</x-app-layout>
