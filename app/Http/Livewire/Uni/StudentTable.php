<?php

namespace App\Http\Livewire\Uni;

use App\Enums\Student\Curriculum;
use App\Enums\Student\Gender;
use App\Models\Student;
use App\Models\StudentUniversity;
use App\Models\ViewStudentTableData;
use App\Services\UniService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\{Button,
    Column,
    Exportable,
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

    public function setUp(): array
    {
        return [
            Exportable::make('students')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount()
        ];
    }

    /**
     * PowerGrid datasource.
     *
     */
    public function datasource(): Builder
    {
        $uniId = auth()->user()->getUni()->id;

        return Student::query()
            ->whereDoesntHave('connection', fn ($q) => $q->where('institution_id', $uniId));
    }

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
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
            ->addColumn('id', function(Student $student) {
                return "<a class='pointer' data-student-id='$student->id' onclick='showStudentCard(this)'>$student->id</a>";
            })
            ->addColumn('efc', function (Student $student) {
                return e($student->efc);
            })
            ->addColumn('countryHS', function (Student $student) {
                return e($student->countryHS);
            })
            ->addColumn('curriculum', function (Student $student) {
                return e(Curriculum::descriptions()[$student->curriculum]);
            })
            ->addColumn('track', function (Student $student) {
                return e($student->track);
            })
            ->addColumn('destination', function (Student $student) {
                return e($student->destination);
            })
            ->addColumn('gender', function (Student $student) {
                return e($student->gender);
            })
            ->addColumn('ranking', function (Student $student) {
                return e($student->ranking);
            })
            ->addColumn('det', function (Student $student) {
                return e($student->det);
            })
            ->addColumn('affiliations', function (Student $student) {
                return e($student->affiliations);
            })
            ->addColumn('refugee', function (Student $student) {
                return e($student->refugee);
            })
            ->addColumn('disability', function (Student $student) {
                return e($student->disability);
            })
            ->addColumn('equivalency', function (Student $student) {
                return e($student->equivalency);
            })
            ->addColumn('other testing', function (Student $student) {
                return e($student->toefl);
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
            Column::make('ID', 'id')->searchable(),
            Column::make('EFC', 'efc')->searchable()->sortable(),
            Column::make('High School Country', 'countryHS')->searchable()->sortable(),
            Column::make('Curriculum', 'curriculum')->searchable(),
            Column::make('Equivalency', 'equivalency')->searchable()->sortable(),
            Column::make('Desired Academic Track', 'track')->searchable(),
            Column::make('Desired Country Destinations', 'destination')->searchable(),
            Column::make('Gender', 'gender')->searchable()->sortable(),
            Column::make('Nationally Ranked', 'ranking')->searchable(),
            Column::make('DET Score', 'det')->searchable()->sortable(),
            Column::make('Affiliations', 'affiliations')->searchable(),
            Column::make('Refugee or Asylum-Seeker', 'refugee')->searchable(),
            Column::make('Disability Disclosure', 'disability')->searchable(),
            Column::make('Other Testing', 'toefl')->searchable(),
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
            Button::add('custom')
            ->render(function (Student $student) {
               $key = 'connect_student_' . $student->id;
               $name = 'student_' . $student->id;
               return Blade::render('
                    <input type="radio" value="connect" id="' . $key . '" name="' . $name . '"> <label for="' . $key . '">Connect</label>'
               );
            }),
            Button::add('maybe')
            ->render(function (Student $student) {
               $key = 'maybe_student_' . $student->id;
               $name = 'student_' . $student->id;
               return Blade::render('
                    <input type="radio" value="maybe" id="student_' . $student->id . '" name="' . $name . '"> <label for="student_' . $student->id . '">Maybe</label>'
               );
            }),
            Button::add('archive')
            ->render(function (Student $student) {
               $key = 'archive_student_' . $student->id;
               $name = 'student_' . $student->id;
               return Blade::render('
                    <input type="radio" value="archive" id="' . $key . '" name="' . $name . '"> <label for="' . $key . '">Archive</label>'
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

    public function exportToCsv()
    {
        // TODO: Complete the export process
        return [
            'name'
        ];
    }
}
