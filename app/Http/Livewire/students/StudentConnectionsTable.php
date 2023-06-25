<?php

namespace App\Http\Livewire\students;

use App\Models\StudentUniversity;
use App\View\Components\AskQuestionAboutConnectionRequestModal;
use App\View\Components\StudentConnectionInterestDecisionButtons;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class StudentConnectionsTable extends PowerGridComponent
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
     * @return \Illuminate\Database\Eloquent\Collection|Builder[]
     */
    public function datasource(): array|\Illuminate\Database\Eloquent\Collection
    {
        return StudentUniversity::query()
            ->where('student_id', auth()->id())
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
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('uni_name', fn (StudentUniversity $studentUniversity) => e($studentUniversity->institution->name))
            ->addColumn('poc', function (StudentUniversity $studentUniversity) {
                return "<a href='mailto:" . $studentUniversity?->requester?->email . "' class='pointer'>" . $studentUniversity?->requester?->getFullName() . "</a>";
            })
            ->addColumn('app_deadline', function (StudentUniversity $studentUniversity) {
                return e(Carbon::parse($studentUniversity->deadline)->format('m-d-Y'));
            })
            ->addColumn('upcoming_events', fn (StudentUniversity $studentUniversity) => $studentUniversity->events)
            ->addColumn('start_application', function (StudentUniversity $studentUniversity) {
                return $studentUniversity->application_link ? "<a href='" . $studentUniversity->application_link . "'>Click here</a>" : null;
            })
            ->addColumn('ask_question', function (StudentUniversity $studentUniversity) {
                return Blade::renderComponent(new AskQuestionAboutConnectionRequestModal($studentUniversity));
            })
            ->addColumn('interested', function (StudentUniversity $studentUniversity) {
                return Blade::renderComponent(new StudentConnectionInterestDecisionButtons($studentUniversity));
            })
            ->addColumn('created_at_formatted', fn (StudentUniversity $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),

            Column::make('POC', 'poc')
                ->searchable()
                ->sortable(),

            Column::make('Upcoming events', 'events')
                ->searchable()
                ->sortable(),

            Column::make('Start application', 'start_application')
                ->searchable()
                ->sortable(),

            Column::make('Application deadline', 'app_deadline')
                ->searchable()
                ->sortable(),

            Column::make('Ask question', 'ask_question')
                ->searchable()
                ->sortable(),

            Column::make('Interested', 'interested')
                ->searchable()
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable()
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
     * PowerGrid StudentUniversity Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('student-university.edit', ['student-university' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('student-university.destroy', ['student-university' => 'id'])
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
     * PowerGrid StudentUniversity Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($student-university) => $student-university->id === 1)
                ->hide(),
        ];
    }
    */
}
