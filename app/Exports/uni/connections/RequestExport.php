<?php

namespace App\Exports\uni\connections;

use App\Enums\General\MatchStudentInstitution;
use App\Enums\General\YesNo;
use App\Enums\Student\Gender;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RequestExport implements FromCollection, WithHeadings
{
    public $data;

    public function __construct()
    {
        $this->data = $this->getData();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->data;
    }

    public function getData()
    {
        $data = [];
        $uniId = auth()->user()->getUni()->id;
        $students = Student::query()
            ->whereHas('connections', function ($q) use ($uniId) {
                return $q->where('institution_id', $uniId)
                    ->where('status', MatchStudentInstitution::ACCEPTED);
            })->get();

        foreach ($students as $student) {
            $data[] = [
                'name' => $student->user->getFullName(),
                'email' => $student->user->email,
                'efc' => $student->efc,
                'countryHS' => $student->countryHS,
                'curriculum' => $student->curriculum,
                'equivalency' => $student->equivalency,
                'track' => $student->track,
                'destination' => $student->destination,
                'gender' => $student->gender
                    ? collect(Gender::descriptions())->first(fn ($value, $key) => strtolower($value) === strtolower($student->gender))
                    : null,
                'ranking' => isset(YesNo::descriptions()[$student->ranking]) ? YesNo::descriptions()[$student->ranking] : "",
                'det' => $student->det,
                'other_testing' => "ACT: " . $student->act . " TOEFL: " . $student->toefl . " iELTS: " . $student->ielts,
                'affiliations' => $student->affiliations,
                'refugee' => isset(YesNo::descriptions()[$student->refugee]) ? YesNo::descriptions()[$student->refugee] : "",
                'disability' => $student->disability,
            ];
        }

        return collect($data);
    }

    public function headings() :array
    {
        if (empty($this->data)) return [];

        // Get the columns names
        $cols = array_keys($this->data[0]);
        // Uppercase the first letter of each one and remove every _
        foreach ($cols as $index => $col) {
            $cols[$index] = ucfirst($col);
            $cols[$index] = str_replace('_', ' ', $cols[$index]);
        }

        return $cols;
    }
}
