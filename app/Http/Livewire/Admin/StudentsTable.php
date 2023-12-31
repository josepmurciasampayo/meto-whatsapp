<?php

namespace App\Http\Livewire\Admin;

use App\Enums\EnumGroup;
use App\Models\Enums;
use App\Models\Student;
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

final class StudentsTable extends PowerGridComponent
{
    use ActionButton;

    public int $perPage = 25;

    public $perPageValues = [25, 50, 150, 250, 500];

    public $arrow = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16" style="display: block; margin:auto">
  <path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z"/>
</svg>';

    public int $efc;

    public int $equivalency;

    public function setUp(): array
    {
        return [
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        $efc = $this->efc;
        $equivalency = $this->equivalency;

        return Student::query()
        ->where(function ($query) use ($efc) {
            $query->whereNotNull('efc')
                ->where('efc', '>=', $efc);
        })
        ->where(function ($query) use ($equivalency) {
            $query->whereNotNull('equivalency')
                ->where('equivalency', '>=', $equivalency);
        })
        ->where(function ($query) {
            $query->whereNotNull('actively_applying_id')
                ->whereIn('actively_applying_id', [70, 71]);
        })->distinct();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn("details", function (Student $student) {
                return "<a class='pointer' data-student-id='$student->id' onclick='showStudentCard(this)'>$this->arrow</a>";
            })
            ->addColumn('efc', function (Student $student) {
                return e('$' . number_format($student->efc, 0, '.', ','));
            })
            ->addColumn('citizenship', function (Student $student) {
                return e(substr($student->citizenship, 0, 10));
            })
            ->addColumn('countryHS', function (Student $student) {
                return e(substr($student->countryHS, 0, 10));
            })
            ->addColumn('curriculum', function (Student $student) {
                return e(substr($student->curriculum, 0, strpos($student->curriculum, ' ')));
            })
            ->addColumn('curriculum_id', function (Student $student) {
                return e($student->curriculum_id);
            })
            ->addColumn('destination', function (Student $student) {
                return e(substr($student->destination, 0, 10));
            })
            ->addColumn('track', function (Student $student) {
                return e(substr($student->track, 0, 12));
            })
            ->addColumn('gender', function (Student $student) {
                return e($student->gender);
            })
            ->addColumn('ranking', function (Student $student) {
                return e($student->ranking);
            })
            ->addColumn('det', function (Student $student) {
                return e($student->det);
            })
            ->addColumn('affiliations', function (Student $student) {
                return e($student->affiliations);
            })
            ->addColumn('refugee', function (Student $student) {
                return e($student->refugee);
            })
            ->addColumn("disability", function (Student $student) {
                return e($student->disability);
            })
            ->addColumn('equivalency', function (Student $student) {
                return e($student->equivalency);
            })
            ->addColumn('other_testing', function (Student $student) {
                $toReturn = [];
                if ($student->act) {
                    $toReturn[] = "ACT: $student->act";
                }
                if ($student->toefl) {
                    $toReturn[] = "TOEFL $student->toefl";
                }
                if ($student->ielts) {
                    $toReturn[] = "IELTS: $student->ielts";
                }
                $toReturnString = ($toReturn) ? implode(", ", $toReturn) : "";
                return e($toReturnString);
            })
            ->addColumn('applying', function (Student $student) {
                return e($student->actively_applying);
            })
            ->addColumn('applying_id', function (Student $student) {
                return e($student->actively_applying_id);
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Profile', 'details'),
            Column::make('EFC', 'efc')->sortable(),
            Column::make('Citizenship', 'citizenship')->searchable(),
            Column::make('HS Country', 'countryHS')->searchable()->sortable(),
            Column::make('Curriculum', 'curriculum')->searchable(),
            Column::make('Approx Percentile', 'equivalency')->searchable()->sortable(),
            Column::make('Desired Destinations', 'destination')->searchable(),
            Column::make('Desired Academic Track', 'track')->searchable(),
            Column::make('Gender', 'gender')->sortable(),
            Column::make('Nationally Ranked', 'ranking'),
            Column::make('DET Score', 'det')->sortable(),
            Column::make('Other Testing', 'other_testing')->sortable(),
            Column::make('Affiliations', 'affiliations')->sortable(),
            Column::make('Refugee or Asylum-Seeker', 'refugee')->sortable(),
            Column::make('Disability Disclosure', 'disability'),
            Column::make('Actively Applying', 'applying'),
            Column::make('Actively Applying ID', 'applying_id'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::multiSelect('curriculum', 'curriculum_id')
                ->dataSource(Enums::where('group_id', EnumGroup::STUDENT_CURRICULUM)->get())
                ->optionValue('enum_id')
                ->optionLabel('enum_desc'),
            Filter::number('equivalency', 'equivalency')
                ->placeholder('Min', 'Max')
        ];
    }

    public function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
                'filterResults'
            ]
        );
    }
}
