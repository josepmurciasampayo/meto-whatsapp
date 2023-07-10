<?php

namespace App\Http\Livewire\Uni;

use App\Enums\General\YesNo;
use App\Enums\Student\Gender;
use App\Exports\uni\connections\RequestExport;
use App\Models\Student;
use App\Models\StudentUniversity;
use App\Services\UniService;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
use App\Enums\General\MatchStudentInstitution;

final class StudentTableRequest extends PowerGridComponent
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
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
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
//        return UniService::studentTableQuery(auth()->user()->getUni()->id, [MatchStudentInstitution::REQUEST()]);

        $uniId = auth()->user()->getUni()->id;

        return Student::query()
            ->whereHas('connection', function ($q) use ($uniId) {
                return $q->where('institution_id', $uniId)
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
            ->addColumn('details', function (Student $student) {
                return "<a class='pointer' data-student-id='$student->id' onclick='showStudentCard(this)'><u>Details</u></a>";
            })
            ->addColumn('name', function (Student $student) {
                return e($student->user->getFullName());
            })
            ->addColumn('email', function (Student $student) {
                return e($student->user->email);
            })
            ->addColumn('phone', function (Student $student) {
                return '+' . e($student->user->phone_combined);
            })
            ->addColumn('efc', function (Student $student) {
                return e($student->efc);
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
                return $student->gender
                    ? collect(Gender::descriptions())->first(fn ($value, $key) => strtolower($value) === strtolower($student->gender))
                    : null;
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
            })
            ->addColumn('name_lower', fn (Student $model) => strtolower(e($model->name)))
            ->addColumn('created_at', fn (Student $model) => $model->connection->created_at)
            ->addColumn('updated_at', fn (Student $model) => $model->connection->updated_at);
    }

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Details', 'details'),

            Column::make('Name', 'name')
                ->searchable(),

            Column::make('Email', 'email')
                ->searchable(),
//
//            Column::make('Phone', 'phone')
//                ->searchable(),

            Column::make('EFC', 'efc')->searchable()->sortable(),
            Column::make('High School Country', 'countryHS')->searchable()->sortable(),
            Column::make('Curriculum', 'curriculum')->searchable(),
            Column::make('Equivalency', 'equivalency')->searchable()->sortable(),
            Column::make('Desired Academic Track', 'track')->searchable(),
            Column::make('Desired Country Destinations', 'destination')->searchable(),

            Column::make('Gender', 'gender')
                ->searchable(),

            Column::make('Nationally Ranked', 'ranking')->searchable(),
            Column::make('DET Score', 'det')->searchable()->sortable(),
            Column::make('Other Testing', 'other_testing')->searchable(),
            Column::make('Affiliations', 'affiliations')->searchable(),
            Column::make('Refugee or Asylum-Seeker', 'refugee')->searchable(),
            Column::make('Disability Disclosure', 'disability')->searchable(),

            Column::make('Created at', 'created_at', 'created_at')
                ->searchable(),
            Column::make('Updated at', 'updated_at', 'updated_at')
                ->searchable()
        ];
    }

    public function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
                'resetConnection',
                'refreshRecords',
                'refreshOtherComponents',
                'exportCsv'
            ]
        );
    }

    public function header()
    {
        return [
            Button::add('reset')
                ->caption(__('Reset'))
                ->emit('resetConnection', []),

            Button::add('refresh')
                ->caption(__('Refresh'))
                ->class('refresh-btn')
                ->emit('refreshRecords', []),

            Button::add('exportCsv')
                ->caption(__('Export'))
                ->emit('exportCsv', [])
        ];
    }

    public function resetConnection()
    {
        foreach ($this->checkboxValues as $id) {
            StudentUniversity::where('student_id', $id)
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

    public function exportCsv()
    {
        if (filled($this->datasource()->get())) {
            $now = Carbon::now();
            return Excel::download(new RequestExport(), 'meto-' . $now->month . '-' . $now->day . '.csv');
        }
    }
}
