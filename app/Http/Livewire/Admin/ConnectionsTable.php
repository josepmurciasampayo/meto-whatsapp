<?php

namespace App\Http\Livewire\Admin;

use App\Enums\General\MatchStudentInstitution;
use App\Enums\Student\Curriculum;
use App\Models\Institution;
use App\Models\Student;
use App\Models\StudentUniversity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ConnectionsTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
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
     * @return Builder<\App\Models\StudentUniversity>
     */
    public function datasource(): Collection
    {
        return StudentUniversity::query()
            ->where('status', '!=', MatchStudentInstitution::ACCEPTED)
            ->where('status', '!=', MatchStudentInstitution::DENIED)
            ->get();
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
            // TODO: Implement the search relationships
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
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('actions', function (StudentUniversity $connection) {
                return
                    '<button class="btn btn-success" onclick="approveConnection(this)" connection_id="' . $connection->id . '">Approve</button>'
                    . '<button class="btn btn-danger" onclick="denyConnection(this)" connection_id="' . $connection->id . '">Deny</button>';
            })
            ->addColumn('student', function (StudentUniversity $connection) {
                return $connection->student->user->getFullName();
            })
            ->addColumn('institution', function (StudentUniversity $connection) {
                return $connection->institution->name;
            })
            ->addColumn('status', function (StudentUniversity $connection) {
                return MatchStudentInstitution::descriptions()[$connection->status];
            })
            ->addColumn('student_curriculum', function (StudentUniversity $connection) {
                return $connection->student->curriculum;
            })
            ->addColumn('student_equivalency', function (StudentUniversity $connection) {
                return $connection->student->equivalency;
            })
            ->addColumn('student_efc', function (StudentUniversity $connection) {
                return $connection->student->efc;
            })
            ->addColumn('institution_curriculum', function (StudentUniversity $connection) {
                return $connection->institution->min_grade_curriculum;
            })
            ->addColumn('institution_equivalency', function (StudentUniversity $connection) {
                return $connection->institution->min_grade_equivalency;
            })
            ->addColumn('institution_efc', function (StudentUniversity $connection) {
                return $connection->institution->efc;
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
            Column::make('Actions', 'actions'),
            Column::make('Student', 'student')->searchable()->sortable(),
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
            Column::make('Created at', 'created_at'),
            Column::make('Updated at', 'updated_at')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::enumSelect('curriculum')
                ->dataSource(Curriculum::cases())
                ->optionValue('value')
        ];
    }
}
