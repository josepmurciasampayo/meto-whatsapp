<?php

namespace App\Http\Livewire\Admin;

use App\Enums\General\ConnectionStatus;
use App\Enums\Student\Curriculum;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConnectionController;
use App\Models\Institution;
use App\Models\Student;
use App\Models\Connection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ReviewNewConnectionsTable extends PowerGridComponent
{
    use ActionButton;

    public int $perPage = 50;

    public $perPageValues = [25, 50, 150, 250, 500];

    public function setUp(): array
    {
        $this->showCheckBox();
        return [
//            Exportable::make('students')
//                ->striped()
//                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount()
        ];
    }

    public function header() :array
    {
        return [
            Button::add('approve')
                ->caption(__('Bulk Approve'))
                ->class('cursor-pointer block btn btn-outline-success bulk-approve-btn')
                ->emit('bulkApprove', []),
            Button::add('deny')
                ->caption(__('Bulk Deny'))
                ->class('btn btn-outline-danger bulk-deny-btn')
                ->emit('bulkDeny', []),
        ];
    }

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
            'bulkApprove',
            'bulkDeny'
        ]);
    }

    public function bulkApprove()
    {
        (new ConnectionController())->approveConnections(Connection::with('student.user.highSchool.counselors')->find($this->checkboxValues));
        $this->checkboxValues = [];
    }

    public function bulkDeny()
    {
        (new ConnectionController())->denyConnections(Connection::find($this->checkboxValues));
        $this->checkboxValues = [];
    }

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Connection>
     */
    public function datasource(): Collection
    {
        return Connection::query()
            ->with('student.user', 'institution')
            ->where('status', ConnectionStatus::REQUEST())
            ->get();
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
            ->addColumn('actions', function (Connection $connection) {
                return
                    '<button class="btn btn-success" onclick="approveConnection(this)" connection_id="' . $connection->id . '">Approve</button>'
                    . '<button class="btn btn-danger" onclick="denyConnection(this)" connection_id="' . $connection->id . '">Deny</button>';
            })
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
            })
            ->addColumn('student_id', function (Connection $connection) {
                return $connection->student_id;
            })
            ->addColumn('user_id', function (Connection $connection) {
                return $connection->student->user_id;
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
            Column::make('Email', 'email'),
            Column::make('Institution', 'institution')->searchable()->sortable(),
//            Column::make('Status application', 'status_application')->searchable()->sortable(),
//            Column::make('Status enrollment', 'status_enrollment')->searchable(),

            Column::make('Student curriculum', 'student_curriculum')->searchable()->sortable(),
            Column::make('Student equivalency', 'student_equivalency')->searchable()->sortable(),
            Column::make('Student efc', 'student_efc')->searchable()->sortable(),
            Column::make('Institution curriculum', 'institution_curriculum')->searchable()->sortable(),
            Column::make('Institution equivalency', 'institution_equivalency')->searchable()->sortable(),
            Column::make('Institution efc', 'institution_efc')->searchable()->sortable(),
            Column::make('Student ID', 'student_id'),
            Column::make('User ID', 'user_id'),
        ];
    }

    public function filters(): array
    {
        $statuses = ConnectionStatus::cases();
        $statuses = array_filter($statuses, function ($status) {
            return $status->value !== 5 && $status->value !== 4;
        });

        return [
            Filter::enumSelect('curriculum')
                ->dataSource(Curriculum::cases())
                ->optionValue('value'),
            Filter::enumSelect('status', 'status')
                ->dataSource($statuses)
                ->optionLabel('name')
        ];
    }
}
