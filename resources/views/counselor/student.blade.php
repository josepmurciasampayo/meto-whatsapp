<x-app-layout>
    @section('title', config('app.name') . ' - Student Detail')
    <div class="min-h-screen mt-5 mx-2">
        <x-notes-counselor :notes="$notes"></x-notes-counselor>
        <form method="POST" action="{{ route('remove', ['student_id' => $student_id]) }}">
            @csrf
            <div class="my-4"><x-button type="submit"><i class="fas fa-trash-alt"></i>Remove Student From School</x-button></div>
        </form>

        @if ($matches)
            <h2 class="my-2">Matches: {{ $data[0]['name'] }}</h2>
            <form class="mb-2" id="submitMatches" method="POST" action="{{ route('saveStudentMatches') }}">
                @csrf
                <input type="hidden" id="student_id" name="student_id" value="{{ $student_id }}">

                <div class="table-container" style="overflow-y: scroll;">
                    <x-dataTable></x-dataTable>
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
                </div>
                <div class="text-end">
                    <x-button>Submit</x-button>
                </div>
            </form>
        @endif

        @if (Auth()->user()->role == \App\Enums\User\Role::ADMIN())
            <div class="d-flex">
                <div class="col">
                    <form method="POST" action="{{ route('admin.student.delete', request('student_id')) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-5">Delete</button>
                    </form>
                </div>
            </div>
        @endif

        <h2 id="raw" class="my-2 display-7">{{ $data[0]['name'] }}</h2>
        <div class="bg-gray-100 p-4 rounded-lg shadow-lg my-5">
            <?php foreach ($data as $row) { ?>
            <div class="py-4 border-b border-gray-300">
                <div class="row">
                    <div class="col-md-3">
                        <x-label value="{{ $row['question'] }}" />
                    </div>
                    <div class="col-md-9">
                        <p><?php echo $row['answer'] ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <form id="verify" name="verify" action="{{ route('saveVerify') }}" method="POST">
            @csrf

            <input type="hidden" name="student_id" id="student-id" value="{{ $student_id }}">

            <?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
            <div class="my-4">
                <div class="row">
                    <div class="col-md-3">
                        <x-label for="verify" value="Data Verification" />
                        <p class="text-xs">Is the data submitted accurate?.

                    </div>
                    <div class="col-md-9">
                        <div class="btn-group" role="group" aria-label="Data verification">
                                <?php $on_checked = ($data[0]['verify'] == 1) ? "checked" : ""; ?>
                                <?php $off_checked = ($data[0]['verify'] == 0) ? "checked" : ""; ?>
                            <input type="radio" class="btn-check" name="verify" id="verify_on" autocomplete="off" {{ $on_checked }}>
                            <label class="btn btn-outline-success" for="verify_on">Verified</label>

                            <input type="radio" class="btn-check" name="verify" id="verify_off" autocomplete="off" {{ $off_checked }}>
                            <label class="btn btn-outline-success" for="verify_off">Not Verified Yet</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
            <div class="my-4">
                <div class="row">
                    <div class="col-md-3">
                        <x-label for="notes" value="Notes" />
                        <p class="text-xs">Add notes for corrections. {{ config('app.name') }} staff can view them.
                        </p>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" id="verify_notes" name="verify_notes" rows="4">{{ $data[0]['verify_notes'] }}</textarea>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="my-4">
                <div class="row">
                    <div class="col-md-3">
                        <x-label for="notes" value="Counselor notes" />
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" id="verify_notes" name="verify_notes" rows="4" disabled>{{ $data[0]['verify_notes'] }}</textarea>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
            <div class="text-end p-3">
                <x-button>Submit Request to {{ config('app.name') }}</x-button>
            </div>
    <?php } ?>

</x-app-layout>
