<?php

namespace App\Http\Livewire\Uni;

use App\Enums\EnumGroup;
use App\Enums\General\YesNo;
use App\Enums\Student\Curriculum;
use App\Enums\Student\Gender;
use App\Models\Enums;
use App\Models\Equivalency;
use App\Models\Student;
use App\Models\StudentUniversity;
use App\Models\ViewStudentDetail;
use App\Services\UniService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\{Button,
    Column,
    Exportable,
    Filters\Filter,
    Footer,
    Header,
    PowerGrid,
    PowerGridComponent,
    PowerGridEloquent};
use PowerComponents\LivewirePowerGrid\Rules\{RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class StudentTable extends PowerGridComponent
{
    use ActionButton;

    public $user;

    public $status;

    public int $perPage = 25;

    public $perPageValues = [25, 50, 150, 250, 500];

    public $arrow = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z"/>
</svg>';

    public function setUp(): array
    {
        return [
            /*
            Exportable::make('students')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            */
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount()
        ];
    }

    public function datasource(): Builder
    {
        $uni = auth()->user()->getUni();

        return Student::query()
            ->whereDoesntHave('connection', fn ($q) => $q->where('institution_id', $uni->id))
            ->where(function ($query) use ($uni) {
                $query->whereNotNull('efc')
                    ->where('efc', '>=', $uni->efc);
            })
            ->where(function ($query) use ($uni) {
                $query->whereNotNull('equivalency')
                    ->where('equivalency', '>=', $uni->min_grade_equivalency);
            });
    }

    public function relationSearch(): array
    {
        return [
            'user' => [
                'first',
                'last',
                'email',
                'phone_raw'
            ]
        ];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('details', function (Student $student) {
                return "<a class='pointer' data-student-id='$student->id' onclick='showStudentCard(this)'>$this->arrow</a><button type='button' id='refresh-records-btn' wire:click='refreshRecords' class='d-none'></button>";
            })
            ->addColumn('connect', function (Student $student) {
                $key = 'connect_student_' . $student->id;
                $name = 'student_' . $student->id;

                $maybeKey = 'maybe_student_' . $student->id;
                $maybeName = 'student_' . $student->id;

                $noKey = 'archive_student_' . $student->id;
                $noName = 'student_' . $student->id;

                return
                    '<input type="radio" value="connect" id="' . e($key) . '" name="' . e($name) . '"> <label for="' . e($key) . '" key="' . $student->id . '" class="btn" target="connect" onclick="selectOption(this)">Yes</label>'
                    . '<input type="radio" value="maybe" id="' . $maybeKey . '" name="' . $maybeName . '"> <label for="' . $maybeKey . '" key="' . $student->id . '" class="btn" target="maybe" onclick="selectOption(this)">Maybe</label>'
                    . '<input type="radio" value="archive" id="' . $noKey . '" name="' . $noName . '"> <label for="' . $noKey . '" key="' . $student->id . '" class="btn" target="archive" onclick="selectOption(this)">No</label>';
            })
            ->addColumn('efc', function (Student $student) {
                return e('$' . $student->efc);
            })
            ->addColumn('citizenship', function (Student $student) {
                return e(substr($student->citizenship, 0, 10));
            })
            ->addColumn('countryHS', function (Student $student) {
                return e(substr($student->countryHS, 0, 10));
            })
            ->addColumn('curriculum', function (Student $student) {
                return e(substr($student->curriculum, 0, strpos($student->curriculum, ' ')));
            })
            ->addColumn('destination', function (Student $student) {
                return e(substr($student->destination, 0, 10));
            })
            ->addColumn('track', function (Student $student) {
                return e(substr($student->track, 0, 12));
            })
            ->addColumn('gender', function (Student $student) {
                return e(isset(Gender::descriptions()[$student->gender]) ? Gender::descriptions()[$student->gender] : "");
            })
            ->addColumn('ranking', function (Student $student) {
                return e(isset(YesNo::descriptions()[$student->ranking]) ? YesNo::descriptions()[$student->ranking] : "");
            })
            ->addColumn('det', function (Student $student) {
                return e($student->det);
            })
            ->addColumn('affiliations', function (Student $student) {
                return e($student->affiliations);
            })
            ->addColumn('refugee', function (Student $student) {
                return e(isset(YesNo::descriptions()[$student->refugee]) ? YesNo::descriptions()[$student->refugee] : "");
            })
            ->addColumn('disability', function (Student $student) {
                return e($student->disability);
            })
            ->addColumn('equivalency', function (Student $student) {
                return e($student->equivalency);
            })
            ->addColumn('other_testing', function (Student $student) {
                return e("ACT: " . $student->act . " TOEFL: " . $student->toefl . " iELTS: " . $student->ielts);
            });
    }

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Connect', 'connect'),
            Column::make('Profile', 'details'),
            Column::make('EFC', 'efc')->searchable()->sortable(),
            Column::make('Citizenship', 'citizenship')->searchable(),
            Column::make('HS Country', 'countryHS')->searchable()->sortable(),
            Column::make('Curriculum', 'curriculum')->searchable(),
            Column::make('Approx Percentile', 'equivalency')->searchable()->sortable(),
            Column::make('Desired Destinations', 'destination')->searchable(),
            Column::make('Desired Academic Track', 'track')->searchable(),
            Column::make('Gender', 'gender')->searchable()->sortable(),
            Column::make('Nationally Ranked', 'ranking')->searchable(),
            Column::make('DET Score', 'det')->searchable()->sortable(),
            Column::make('Other Testing', 'other_testing')->searchable(),
            Column::make('Affiliations', 'affiliations')->searchable(),
            Column::make('Refugee or Asylum-Seeker', 'refugee')->searchable(),
            Column::make('Disability Disclosure', 'disability')->searchable(),
        ];
    }

    public function header(): array
    {
        if ($this->status) {
            return [
                Button::add('reset')
                    ->caption(__('Reset'))
                    ->emit('resetConnection', [])
            ];
        }
        return [];
    }

    public function filters(): array
    {
        return [
            Filter::multiSelect('curriculum', 'curriculum')
                ->dataSource(Enums::where('group_id', EnumGroup::STUDENT_CURRICULUM)->get())
                ->optionValue('enum_id')
                ->optionLabel('enum_desc'),
//            Filter::inputText('equivalency', 'equivalency')
//                ->operators(['min', 'max']),
            Filter::number('equivalency', 'equivalency')
                ->placeholder('Min', 'Max')
        ];
    }

    public function exportToCsv()
    {
        // TODO: Complete the export process
        return [
            'name'
        ];
    }

    public function refreshRecords()
    {
        $this->datasource();
    }
}
