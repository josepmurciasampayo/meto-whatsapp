<?php

namespace App\Http\Livewire\Uni;

use App\Enums\General\ConnectionStatus;
use App\Enums\Student\Gender;
use App\Models\Student;
use App\Models\Connection;
use App\Services\UniService;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button,
    Column,
    Exportable,
    Filters\Filter,
    Footer,
    Header,
    PowerGrid,
    PowerGridComponent,
    PowerGridEloquent};

final class StudentTableArchived extends PowerGridComponent
{
    use ActionButton;

    public int $perPage = 25;

    public $perPageValues = [25, 50, 150, 250, 500];

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
//            Exportable::make('export')
//                ->striped()
//                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
//            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
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
        $uniId = auth()->user()->getUni()->id;

        return Student::query()
            ->with('user')
            ->whereHas('connections', function ($q) use ($uniId) {
                return $q->where('institution_id', $uniId)
                    ->where('status', ConnectionStatus::ARCHIVED);
            });
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('details', function (Student $student) {
                return "<a class='pointer' data-student-id='$student->id' onclick='showStudentCard(this)'><u>Details</u></a>";
            })
            ->addColumn('id', function (Student $student) {
                return e($student->display_id);
            })
            ->addColumn('gender', function (Student $student) {
                return $student->gender ?? "";
            })
            ->addColumn('email', function (Student $student) {
                return e($student->user->email);
            })
            ->addColumn('phone', function (Student $student) {
                return '+' . e($student->user->phone_combined);
            })
//            ->addColumn('name_lower', fn (Student $model) => strtolower(e($model->user->getFullName())))
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
            Column::make('Details', 'details')->searchable(),
            Column::make('ID', 'id'),
            Column::make('EFC', 'efc')->searchable()->sortable(),
            Column::make('High School Country', 'countryHS')->searchable()->sortable(),
            Column::make('Curriculum', 'curriculum')->searchable(),
            Column::make('Equivalency', 'equivalency')->searchable()->sortable(),
            Column::make('Desired Academic Track', 'track')->searchable(),
            Column::make('Desired Country Destinations', 'destination')->searchable(),
            Column::make('Gender', 'gender')->searchable(),
            Column::make('Nationally Ranked', 'ranking')->searchable(),
            Column::make('DET Score', 'det')->searchable()->sortable(),
            Column::make('Other Testing', 'other_testing')->searchable(),
            Column::make('Affiliations', 'affiliations')->searchable(),
            Column::make('Refugee or Asylum-Seeker', 'refugee')->searchable(),
            Column::make('Disability Disclosure', 'disability')->searchable(),
        ];
    }

    public function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
                'resetConnection',
                'refreshRecords',
                'refreshOtherComponents'
            ]
        );
    }

    public function header(): array
    {
        return [
            Button::add('refresh')
                ->caption(__('Refresh'))
                ->class('btn btn-outline-primary refresh-btn me-3 mb-3')
                ->emit('refreshRecords', []),

            Button::add('reset')
                ->caption(__('Send Back to Review'))
                ->class('btn btn-outline-success mb-3')
                ->emit('resetConnection', []),
        ];
    }

    public function filters() :array
    {
        return [
            Filter::inputText('destination', 'destination')
                ->operators(['contains'])
        ];
    }

    public function resetConnection()
    {
        foreach ($this->checkboxValues as $id) {
            Connection::where('student_id', $id)
                ->where('institution_id', auth()->user()->getUni()->id)
                ->delete();
        }

        $this->emit('refreshRecords');

        return true;
    }

    public function refreshRecords()
    {
        $this->datasource();
    }

    public function refreshOtherComponents()
    {
        $this->datasource();
    }
}
