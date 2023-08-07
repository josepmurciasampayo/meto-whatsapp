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
        return [
//            Header::make()->showSearchInput(),
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
        return [
//            'student' => [
//                'user' => [
//                    'first'
//                ]
//            ]
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
            Column::make('Student', 'student')->searchable(),
            Column::make('Email', 'email')->searchable(),
            Column::make('Institution', 'institution')->searchable(),
            Column::make('Status', 'status')
        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        $statuses = MatchStudentInstitution::cases();
        $statuses = array_filter($statuses, function ($status) {
            return $status->value !== 5 && $status->value !== 4;
        });

        return [
            Filter::enumSelect('status', 'status')
                ->dataSource($statuses)
                ->optionLabel('name')
        ];
    }
}
