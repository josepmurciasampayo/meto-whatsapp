<?php

namespace App\Http\Livewire\Uni;

use App\Enums\Student\Gender;
use App\Models\Student;
use App\Models\StudentUniversity;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use App\Enums\General\MatchStudentInstitution;

final class StudentTableRequest extends PowerGridComponent
{
    use ActionButton;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Student>
     */
    public function datasource()
    {
        return Student::query()
            ->whereHas('connection', function ($query) {
                $query->where('institution_id', auth()->id())
                    ->where('status', MatchStudentInstitution::REQUEST);
            });
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

    public function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
                'resetConnection'
            ]
        );
    }

    public function header()
    {
        return [
            Button::add('reset')
                ->caption(__('Reset'))
                ->emit('resetConnection', [])
        ];
    }

    public function resetConnection()
    {
        foreach ($this->checkboxValues as $id) {
            StudentUniversity::where('student_id', $id)
                ->where('institution_id', auth()->id())
                ->delete();
        }

        return true;
    }

    public function exportToCsv()
    {
        // TODO: Complete the export process
        return [
            'name'
        ];
    }

    public function exportToXLS()
    {
        // TODO: Complete the export process
        return [
            'name'
        ];
    }
}
