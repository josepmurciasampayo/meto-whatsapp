<x-app-layout>
    <div class="p-6 bg-white border-b border-gray-200 display-7">
        <?php echo $school['name'] ?> - Administration
    </div>

    <div class="mt-4 mb-4 text-end">
        <a href="{{ route('invite', ['highschool_id' => $school['id']]) }}"><x-button class="btn btn-info"><i class="fas fa-user-plus"></i> Invite Counselor</x-button></a>
    </div>

    @if (Auth::user()->isAdmin() && count($counselors) > 0)
        <div class="mt-2 mb-4">
            <div class="ml-3">
                <h3>Existing Counselors</h3>
                <ul>
                @foreach ($counselors as $counselor)
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('invite', ['highschool_id' => $school['id'], 'user_id' => $counselor['user_id']]) }}">
                                {{ $counselor['name'] . '(' . $counselor['email'] . ')' }}
                            </a>
                        </div>
                        <div class="col">
                            <x-button onclick="alert('Does not work yet!')">Remove From School</x-button>
                        </div>
                    </div>
                @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="p-6">
        <form  method="POST" action="{{ route('highschool.update') }}" name="highschool" id="highschool">
            <input type="hidden" value="{{ $school['id'] }}" name="highschool_id" id="highschool_id">
            @csrf

            <div class="mb-4">
                <x-label for="name" value="Institution Name - This should be the full, official name of your institution" />
                <x-input class="block mt-1 w-full" name="name" type="text" saved="{{ $school['name'] }}" autofocus />
            </div>

            <div class="mb-4">
                <x-label for="url" value="Website" />
                <x-input class="block mt-1 w-full" id="url" name="url" type="text" saved="{{ $school['url'] }}" autofocus />
            </div>

            <div class="mb-4">
                <x-label for="url" value="Institution General Email Address" />
                <x-input class="block mt-1 w-full" id="email" name="email" type="text" saved="{{ $school['general_email']}} " autofocus />
            </div>

            <div class="mb-4">
                <x-label for="city" value="City" />
                <x-input class="block mt-1 w-full" id="city" name="city" type="text" saved="{{ $school['city'] }}" />
            </div>

            <div class="mb-4">
                <x-label for="country" value="Country" />

                <select class="form-select" id="country" name="country">
                    <option value=""></option>
                    <?php foreach ($countries as $country) { ?>
                        <?php $selected = (($countryId = \App\Enums\Country\Country::lookup($country)) == $school['country']) ? "selected" : "" ?>
                        <option value="{{ $countryId }}" {{ $selected }}>{{ $country }}</option>
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
                    <?php foreach ($boarding as $id => $curriculum) { ?>
                    <?php $selected = ($id == $school['boarding']) ? "selected" : "" ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $curriculum }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="type" value="Institution Type" />
                <select class="form-select" id="type" name="type">
                    <option value=""></option>
                    <?php foreach ($types as $id => $type) { ?>
                        <?php $selected = ($id == $school['type']) ? "selected" : "" ?>
                        <option value="{{ $id }}" {{ $selected }}>{{ $type }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="cost" value="Institution Total Cost of Attendance" />
                <select class="form-select" id="cost" name="cost">
                    <option value=""></option>
                    <?php foreach ($costs as $id => $cost) { ?>
                    <?php $selected = ($id == $school['cost']) ? "selected" : "" ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $cost }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="exam" value="Finishing Exam - which exam do students take prior to graduation" />
                <select class="form-select" id="exam" name="exam">
                    <option value=""></option>
                    <?php foreach ($exams as $id => $exam) { ?>
                    <?php $selected = ($id == $school['exam']) ? "selected" : "" ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $exam }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="month" value="Month of Finishing Exam" />
                <select class="form-select" id="month" name="month">
                    <option value=""></option>
                    <?php foreach ($months as $id => $month) { ?>
                    <?php $selected = ($id == $school['finish_month']) ? "selected" : "" ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $month }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="schoolSize" value="Institution Size - cumulative number of students in the institution" />
                <select class="form-select" id="schoolSize" name="schoolSize">
                    <option value=""></option>
                    <?php foreach ($schoolSizes as $id => $size) { ?>
                        <?php $selected = ($id == $school['school_size']) ? "selected" : "" ?>
                        <option value="{{ $id }}" {{ $selected }}>{{ $size }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="classSize" value="Class Size - how many students will graduate in an academic year" />
                <select class="form-select" id="classSize" name="classSize">
                    <option value=""></option>
                    <?php foreach ($classSizes as $id => $size) { ?>
                    <?php $selected = ($id == $school['class_size']) ? "selected" : "" ?>
                    <option value="{{ $id }}" {{ $selected }}>{{ $size }}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <x-label for="code" value="Government-Assigned School Code (if applicable)" />
                <x-input class="block mt-1 w-full" id="code" name="code" type="text" :value="$school['government_code']" autofocus />
            </div>

            <div class="text-end">
                <x-button>Submit Changes</x-button>
            </div>
        </form>
    </div>
</x-app-layout>
