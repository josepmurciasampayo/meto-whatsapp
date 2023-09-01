<?php

namespace App\Http\Livewire\Uni;

use App\Enums\General\YesNo;
use App\Enums\Student\Gender;
use App\Exports\uni\connections\RequestExport;
use App\Models\EnumCountry;
use App\Models\HighSchool;
use App\Models\Student;
use App\Models\Connection;
use App\Services\UniService;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
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
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        $uniId = auth()->user()->getUni()->id;

        return Student::query()
            ->whereHas('connections', function ($q) use ($uniId) {
                return $q->where('institution_id', $uniId)
                    ->whereIn('status', [MatchStudentInstitution::ACCEPTED]);
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
            ->addColumn('efc', function (Student $student) {
                return e('$' . number_format($student->efc, 0, '.', ','));
            })
            ->addColumn('dob', function (Student $student) {
                return e($student->dob);
            })
            ->addColumn('hs', function (Student $student) {
                return e($student->hs);
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
                return match($student->gender) {
                    "Female" => "F",
                    "Male" => "M",
                    "Other/Prefer not to say" => "Other",
                    "Other / prefer not to say" => "Other",
                    default => "",
                };
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

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Details', 'details'),
            Column::make('Name', 'name')->searchable(),
            Column::make('Email', 'email')->searchable(),
            Column::make('DOB', 'dob'),
            Column::make('High School', 'hs'),
            Column::make('EFC', 'efc')->sortable(),
            Column::make('High School Country', 'countryHS')->searchable()->sortable(),
            Column::make('Curriculum', 'curriculum')->searchable(),
            Column::make('Equivalency', 'equivalency')->sortable(),
            Column::make('Desired Academic Track', 'track')->searchable(),
            Column::make('Desired Country Destinations', 'destination')->searchable(),
            Column::make('Gender', 'gender')->sortable(),
            Column::make('Nationally Ranked', 'ranking')->sortable(),
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
                'refreshOtherComponents',
                'exportCsv'
            ]
        );
    }

    public function header()
    {
        return [
//            Button::add('reset')
//                ->caption(__('Reset'))
//                ->emit('resetConnection', []),

            Button::add('refresh')
                ->caption(__('Refresh'))
                ->class('btn btn-outline-primary refresh-btn me-3 mb-3')
                ->emit('refreshRecords', []),

            Button::add('exportCsv')
                ->caption(__('Export'))
                ->class('btn btn-outline-secondary mb-3')
                ->emit('exportCsv', [])
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

    /*
    public function exportCsv()
    {
        if (filled($this->datasource()->get())) {
            $now = Carbon::now();
            return Excel::download(new RequestExport(), 'meto-' . $now->month . '-' . $now->day . '.csv');
        }
    }
    */

    public function filters(): array
    {
        return [
            /*
             * Huge delay doing this, gotta be a faster way
             *
             Filter::multiSelect('hs', 'hs')
                ->dataSource(HighSchool::get())
                ->optionValue('name')
                ->optionLabel('name'),
            */
            Filter::multiSelect('countryHS', 'countryHS')
                ->dataSource(EnumCountry::get())
                ->optionValue('name')
                ->optionLabel('name'),
            Filter::inputText('destination', 'destination')
                ->operators(['contains'])
        ];
    }
}
