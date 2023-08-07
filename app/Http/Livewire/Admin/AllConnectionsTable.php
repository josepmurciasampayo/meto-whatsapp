<?php

namespace App\Http\Livewire\Admin;

use App\Enums\General\MatchStudentInstitution;
use App\Enums\Student\Curriculum;
use App\Models\Connection;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button,
    Column,
    Exportable,
    Footer,
    Header,
    PowerGrid,
    PowerGridComponent,
    PowerGridColumns,
    PowerGridEloquent};

final class AllConnectionsTable extends PowerGridComponent
{
    use ActionButton;

    public int $perPage = 25;

    public $perPageValues = [25, 50, 150, 250, 500];

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
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
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
     * @return Builder<\App\Models\Connection>
     */
    public function datasource(): Builder
    {
        return Connection::query();
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
        return [];
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
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('student', function (Connection $connection) {
                return $connection->student->user->getFullName();
            })
            ->addColumn('email', function (Connection $connection) {
                $email = $connection->student->user->email;
                return "<a href='mailto:$email'>$email</a>";
            })
            ->addColumn('institution', function (Connection $connection) {
                return $connection->institution->name;
            })
            ->addColumn('status', function (Connection $connection) {
                return MatchStudentInstitution::descriptions()[$connection->status];
            })
            ->addColumn('student_curriculum', function (Connection $connection) {
                return $connection->student->curriculum;
            })
            ->addColumn('student_equivalency', function (Connection $connection) {
                return $connection->student->equivalency;
            })
            ->addColumn('student_efc', function (Connection $connection) {
                return $connection->student->efc;
            })
            ->addColumn('institution_curriculum', function (Connection $connection) {
                return Curriculum::descriptions()[$connection->institution->min_grade_curriculum] ?? '';
            })
            ->addColumn('institution_equivalency', function (Connection $connection) {
                return $connection->institution->min_grade_equivalency;
            })
            ->addColumn('institution_efc', function (Connection $connection) {
                return '$' . $connection->institution->efc;
            });
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
            Column::make('Student', 'student')->searchable()->sortable(),
            Column::make('Email', 'email'),
            Column::make('Institution', 'institution')->searchable()->sortable(),
//            Column::make('Status application', 'status_application')->searchable()->sortable(),
//            Column::make('Status enrollment', 'status_enrollment')->searchable(),
            Column::make('Status', 'status')->sortable(),

            Column::make('Student curriculum', 'student_curriculum')->searchable()->sortable(),
            Column::make('Student equivalency', 'student_equivalency')->searchable()->sortable(),
            Column::make('Student efc', 'student_efc')->searchable()->sortable(),

            Column::make('Institution curriculum', 'institution_curriculum')->searchable()->sortable(),
            Column::make('Institution equivalency', 'institution_equivalency')->searchable()->sortable(),
            Column::make('Institution efc', 'institution_efc')->searchable()->sortable(),

//            Column::make('Intent', 'intent'),
//            Column::make('Heard Of', 'heard_of'),
//            Column::make('Factors', 'factors'),
        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Connection Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('connection.edit', ['connection' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('connection.destroy', ['connection' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Connection Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($connection) => $connection->id === 1)
                ->hide(),
        ];
    }
    */
}
