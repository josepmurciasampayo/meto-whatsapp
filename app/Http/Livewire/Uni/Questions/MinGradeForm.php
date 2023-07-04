<?php

namespace App\Http\Livewire\Uni\Questions;

use App\Services\EquivalencyService;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Enums\Student\Curriculum;

class MinGradeForm extends Component
{
    public $curricula;

    public $curriculum = 9;

    public $scoreOptions = [];

    public $selectedScoreOption = null;

    public function render()
    {
        $curricula = Curriculum::getSchoolChoices();
        unset($curricula[$other = Curriculum::OTHER()]);

        $this->curricula = $curricula;
        if ($option = $this->curriculum) {
            $method = 'get' . $this->curricula[$option] . 'Curriculum';
            $this->scoreOptions = $this->$method();
        }

        return view('livewire.uni.questions.min-grade-form');
    }

    protected function rules() {
        return [
            'curriculum' => 'required',
            'selectedScoreOption' => 'required'
        ];
    }

    public function saveMingrade()
    {

        $this->validate();
        $uni = Auth::user()->getUni();
        $uni->min_grade_curriculum = $this->curriculum;
        $uni->min_grade = $this->scoreOptions[$this->selectedScoreOption];
        $uni->save();

        (new EquivalencyService())->updateUni($uni);

        return redirect(route('home'));
    }

    public function getIbCurriculum()
    {
        return [
            '42',
            '38',
            '34',
            '30',
            '26',
            '24'
        ];
    }

    public function getCambridgeCurriculum()
    {
        return [
            'AAA',
            'ABB',
            'BBB',
            'BCC',
            'CCC',
            'CDD',
            'DDD'
        ];
    }

    public function getAmericanCurriculum()
    {
        return [
            '4.0',
            '3.5',
            '3.0',
            '2.5',
            '2.0',
            '1.5'
        ];
    }

    public function getNationalCurriculum()
    {
        return [
            '100%',
            '90%',
            '80%',
            '70%',
            '60%',
            '50%'
        ];
    }
}
