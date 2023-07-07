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
                return "<a class='pointer' data-student-id='$student->id' onclick='showStudentCard(this)'><u>Details</u></a><button type='button' id='refresh-records-btn' wire:click='refreshRecords' class='d-none'></button>";
            })
            ->addColumn('connect', function (Student $student) {
                $key = 'connect_student_' . $student->id;
                $name = 'student_' . $student->id;
                return '<input type="radio" value="connect" id="' . e($key) . '" name="' . e($name) . '"> <label for="' . e($key) . '" key="' . $student->id . '" class="btn" target="connect" onclick="selectOption(this)">Yes</label>';
            })
            ->addColumn('efc', function (Student $student) {
                return e('$' . $student->efc);
            })
            ->addColumn('countryHS', function (Student $student) {
                return e($student->countryHS);
            })
            ->addColumn('curriculum', function (Student $student) {
                return e($student->curriculum);
            })
            ->addColumn('track', function (Student $student) {
                return e($student->track);
            })
            ->addColumn('destination', function (Student $student) {
                return e($student->destination);
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
            Column::make('Details', 'details'),
            Column::make('EFC', 'efc')->searchable()->sortable(),
            Column::make('High School Country', 'countryHS')->searchable()->sortable(),
            Column::make('Curriculum', 'curriculum')->searchable(),
            Column::make('Equivalency', 'equivalency')->searchable()->sortable(),
            Column::make('Desired Academic Track', 'track')->searchable(),
            Column::make('Desired Country Destinations', 'destination')->searchable(),
            Column::make('Gender', 'gender')->searchable()->sortable(),
            Column::make('Nationally Ranked', 'ranking')->searchable(),
            Column::make('DET Score', 'det')->searchable()->sortable(),
            Column::make('Other Testing', 'other_testing')->searchable(),
            Column::make('Affiliations', 'affiliations')->searchable(),
            Column::make('Refugee or Asylum-Seeker', 'refugee')->searchable(),
            Column::make('Disability Disclosure', 'disability')->searchable(),
        ];
    }

    /**
     * PowerGrid Student Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
        if ($this->status) return [];
        return [
            Button::add('maybe')
            ->render(function (Student $student) {
               $key = 'maybe_student_' . $student->id;
               $name = 'student_' . $student->id;
               return Blade::render('
                    <input type="radio" value="maybe" id="' . $key . '" name="' . $name . '"> <label for="' . $key . '" key="' . $student->id . '" class="btn" target="maybe" onclick="selectOption(this)">Maybe</label>'
               );
            }),
            Button::add('archive')
            ->render(function (Student $student) {
               $key = 'archive_student_' . $student->id;
               $name = 'student_' . $student->id;
               return Blade::render('
                    <input type="radio" value="archive" id="' . $key . '" name="' . $name . '"> <label for="' . $key . '" key="' . $student->id . '" class="btn" target="archive" onclick="selectOption(this)">No</label>'
               );
            })
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
