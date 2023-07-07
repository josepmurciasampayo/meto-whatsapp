<?php

namespace App\Http\Livewire\Uni;

use App\Enums\General\MatchStudentInstitution;
use App\Enums\General\YesNo;
use App\Enums\Student\Gender;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class StudentConnectionsTable extends PowerGridComponent
{
    use ActionButton;

    public int $perPage = 25;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
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

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Student>
     */
    public function datasource(): Builder
    {
        $uniId = auth()->user()->getUni()->id;

        return Student::query()
            ->whereHas('connection', function ($q) use ($uniId) {
                return $q->where('institution_id', $uniId)
                    ->where('status', MatchStudentInstitution::ACCEPTED);
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

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

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): \PowerComponents\LivewirePowerGrid\PowerGridEloquent
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

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Details', 'details')
                ->searchable(),

            Column::make('Name', 'name')
                ->searchable(),

            Column::make('Email', 'email')
                ->searchable(),

            Column::make('Phone', 'phone')
                ->searchable(),

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
}
