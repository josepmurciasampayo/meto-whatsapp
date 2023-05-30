<?php

namespace App\Http\Livewire\Uni;

use App\Enums\Student\Gender;
use App\Models\Student;
use App\Models\StudentUniversity;
use App\Models\ViewStudentTableData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
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
     * @return Builder<\App\Models\Student>
     */
    public function datasource(): Builder
    {
        return ViewStudentTableData::query()
            ->whereNull('status');
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
            ->addColumn('id')
            ->addColumn('name', function (Student $student) {
                $fullName = e($student->user->getFullName());
                return "<a class='pointer' data-student-id='$student->id' onclick='showStudentCard(this)'>$fullName</a>";
            })
            ->addColumn('gender', function (Student $student) {
                return $student->gender ? Gender::descriptions()[$student->gender] : null;
            })
            ->addColumn('email', function (Student $student) {
                return e($student->user->email);
            })
            ->addColumn('phone', function (Student $student) {
                return '+' . e($student->user->phone_combined);
            })
            ->addColumn('name_lower', fn (Student $model) => strtolower(e($model->name)))
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Student $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable(),

            Column::make('Name', 'name')
                ->searchable(),

            Column::make('Gender', 'gender')
                ->searchable(),

            Column::make('Email', 'email')
                ->searchable(),

            Column::make('Phone', 'phone')
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable()
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
