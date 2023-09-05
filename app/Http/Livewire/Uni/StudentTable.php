<?php

namespace App\Http\Livewire\Uni;

use App\Enums\EnumGroup;
use App\Models\Curriculum;
use App\Models\Enums;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\{Button,
    Column,
    Exportable,
    Filters\Filter,
    Footer,
    Header,
    PowerGrid,
    PowerGridComponent,
    PowerGridEloquent};
use PowerComponents\LivewirePowerGrid\Rules\{RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class StudentTable extends PowerGridComponent
{
    use ActionButton;

    public $user;

    public $status;

    public int $perPage = 25;

    public $perPageValues = [25, 50, 150, 250, 500];

    public $arrow = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16" style="display: block; margin:auto">
  <path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zM8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6z"/>
</svg>';

    public function setUp(): array
    {
        return [
//            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount()
        ];
    }

    public function datasource(): Builder
    {
        $uni = auth()->user()->getUni();

        return Student::query()
            ->whereDoesntHave('connections', fn ($q) => $q->where('institution_id', $uni->id))
            ->where(function ($query) use ($uni) {
                $query->whereNotNull('efc')
                    ->where('efc', '>=', $uni->efc);
            })
            ->where(function ($query) use ($uni) {
                $query->whereNotNull('equivalency')
                    ->where('equivalency', '>=', $uni->min_grade_equivalency);
            })
            ->where(function ($query) {
                $query->whereNotNull('actively_applying_id')
                    ->whereIn('actively_applying_id', [70, 71]);
            })->distinct();
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn("details", function (Student $student) {
                return "<a class='pointer' data-student-id='$student->id' onclick='showStudentCard(this)'>$this->arrow</a><button type='button' id='refresh-records-btn' wire:click='refreshRecords' class='d-none'></button>";
            })
            ->addColumn("connect", function (Student $student) {
                $key = "connect_student_" . $student->id;
                $name = "student_" . $student->id;

                $maybeKey = "maybe_student_" . $student->id;
                $maybeName = "student_" . $student->id;

                $noKey = 'archive_student_' . $student->id;
                $noName = 'student_' . $student->id;

                return
                    '<input type="radio" value="connect" id="' . e($key) . '" name="' . e($name) . '"> <label for="' . e($key) . '" key="' . $student->id . '" class="btn" style="font-size: 12px" target="connect" onclick="selectOption(this)">Yes</label>'
                    . '<input type="radio" value="maybe" id="' . $maybeKey . '" name="' . $maybeName . '"> <label for="' . $maybeKey . '" key="' . $student->id . '" class="btn" style="font-size: 12px" target="maybe" onclick="selectOption(this)">Maybe</label>'
                    . '<input type="radio" value="archive" id="' . $noKey . '" name="' . $noName . '"> <label for="' . $noKey . '" key="' . $student->id . '" class="btn" style="font-size: 12px" target="archive" onclick="selectOption(this)">No</label>';
            })
            ->addColumn('efc', function (Student $student) {
                return e('$' . number_format($student->efc, 0, '.', ','));
            })
            ->addColumn('citizenship', function (Student $student) {
                return e($student->citizenship);
            })
            ->addColumn('countryHS', function (Student $student) {
                return e(substr($student->countryHS, 0, 10));
            })
            ->addColumn('curriculum', function (Student $student) {
                return e(str_replace(" Curriculum", "", $student->curriculum));
            })
            ->addColumn('curriculum_id', function (Student $student) {
                return e($student->curriculum_id);
            })
            ->addColumn('destination', function (Student $student) {
                return e($student->destination);
            })
            ->addColumn('track', function (Student $student) {
                return e(substr($student->track, 0, 12));
            })
            ->addColumn('gender', function (Student $student) {
                return match($student->gender) {
                    "Female" => "F",
                    "Male" => "M",
                    "Other/Prefer not to say" => "Other",
                    "Other / prefer not to say" => "Other",
                    default => "",
                };
            })
            ->addColumn('ranking', function (Student $student) {
                return e($student->ranking == "Yes" ? "Yes" : "");
            })
            ->addColumn('det', function (Student $student) {
                return e($student->det);
            })
            ->addColumn('affiliations', function (Student $student) {
                return e($student->affiliations);
            })
            ->addColumn('refugee', function (Student $student) {
                return e(($student->refugee) == "Yes" ? "Yes" : "");
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
                if ($student->sat) {
                    $toReturn[] = "SAT: $student->sat";
                }
                $toReturnString = ($toReturn) ? implode(", ", $toReturn) : "";
                return e($toReturnString);
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Connect', 'connect'),
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
        ];
    }

    public function header(): array
    {
        return [
            Button::add('refresh')
                ->caption(__('Refresh'))
                ->class('btn btn-outline-primary refresh-btn mb-3 me-3')
                ->emit('refreshRecords', []),

            Button::add('Reset')
                ->caption(__('Reset'))
                ->class('btn btn-outline-warning mb-3 reset-saved-options-btn')
                ->emit('resetSavedRecords', []),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::multiSelect('curriculum', 'curriculum_id')
                ->dataSource(Curriculum::whereIn('id', [5, 4, 6, 1, 3, 2, 27])->get())
                ->optionValue('id')
                ->optionLabel('name'),
            Filter::number('equivalency', 'equivalency')
                ->placeholder('Min', 'Max'),
            Filter::inputText('destination', 'destination')
                ->operators(['contains'])
        ];
    }

    public function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
                'refreshRecords',
                'refreshOtherComponents'
            ]
        );
    }

    public function refreshRecords()
    {
        $this->datasource();
    }

    public function refreshOtherComponents()
    {
        $this->datasource();
    }

    public function resetSavedRecords()
    {
        // It's happening on the frontend
    }
}
