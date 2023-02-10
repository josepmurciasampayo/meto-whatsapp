<x-app-layout>
    <x-notes-counselor :notes="$notes"></x-notes-counselor>
    <form method="POST" action="{{ route('remove', ['student_id' => $student_id]) }}">
        @csrf
        <x-button type="submit">Remove Student</x-button>
    </form>
    <h2 class="my-2">Student Matches - {{ $data[0]['name'] }}</h2>
    <a class="ml-3" href="#raw"><p>Go to raw data</p></a>
    <form class="mb-5" id="submitMatches" method="POST" action="{{ route('saveStudentMatches') }}">
        @csrf
        <input type="hidden" id="student_id" name="student_id" value="{{ $student_id }}">

        <table id="matches" class="table bg-white ">
            <thead>
                <tr>
                    <th>University</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($matches as $match) {?>
                    <tr>
                        <td>{{ $match['name'] }}</td>
                        <td>
                            <select id="match-{{ $match['match_id'] }}" name="match-{{ $match['match_id'] }}">
                                <?php foreach ($matchStatuses as $status_id => $status) { ?>
                                {{ $selected = ($match['status'] == $status) ? 'selected' : '' }}
                                <option value="{{ $status_id }}" {{ $selected }}>{{ $status }}</option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="text-end">
            <x-button>Submit Updates</x-button>
        </div>
    </form>

    <h2 id="raw" class="my-2">Student Data - {{ $data[0]['name'] }}</h2>
    <div class="bg-white p-3">
    <?php foreach ($data as $row) { ?>
        <div class="py-3">
            <!-- question ID: <?php echo $row['question_id'] ?> -->
            <x-label value="{{ $row['question'] }}" />
            <p><?php echo $row['answer'] ?></p>
        </div>
    <?php } ?>
    </div>
    <form id="verify" name="verify" action="{{ route('saveVerify') }}" method="POST">

        @csrf

        <input type="hidden" name="student_id" id="student-id" value="{{ $student_id }}">

        <?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
        <div class="my-4">
            <x-label for="verify" value="Does all of the above information look correct?" />
            <div class="btn-group" role="group" aria-label="Data verification">
                <?php $on_checked = ($data[0]['verify'] == 1) ? "checked" : ""; ?>
                <?php $off_checked = ($data[0]['verify'] == 0) ? "checked" : ""; ?>
                <input type="radio" class="btn-check" name="verify" id="verify_on" autocomplete="off" {{ $on_checked }}>
                <label class="btn btn-outline-success" for="verify_on">Verified</label>

                <input type="radio" class="btn-check" name="verify" id="verify_off" autocomplete="off" {{ $off_checked }}>
                <label class="btn btn-outline-success" for="verify_off">Not Verified Yet</label>
            </div>
        </div>
        <?php } ?>

        <?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
        <x-label for="notes" value="Please make a few notes about what needs correction (if anything). Meto staff will be able to view this." />
        <?php } else { ?>
        <div class="my-4"><x-label for="notes" value="Counselor notes" /></div>
        <?php } ?>
        <textarea class="form-control" id="verify_notes" name="verify_notes" rows="4">{{ $data[0]['verify_notes'] }}</textarea>
        <?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
        <div class="text-end p-3">
            <x-button>Update Notes</x-button>
        </div>
        <?php } ?>
    </form>

</x-app-layout>
