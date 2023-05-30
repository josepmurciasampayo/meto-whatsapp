<?php

namespace App\Http\Livewire\Uni\Questions;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Enums\Student\Curriculum;

class MinGradeForm extends Component
{
    public $options;

    public $option = 9;

    public $scoreOptions = [];

    public $selectedScoreOption = null;

    public function render()
    {
        $options = Curriculum::getSchoolChoices();
        if (in_array($other = Curriculum::OTHER(), array_keys($options))) {
            unset($options[$other]);
        }

        $this->options = $options;
        if ($option = $this->option) {
            $method = 'get' . $this->options[$option] . 'Curriculum';
            $this->scoreOptions = $this->$method();
        }

        return view('livewire.uni.questions.min-grade-form');
    }

    protected function rules() {
        return [
            'option' => 'required',
            'selectedScoreOption' => 'required'
        ];
    }

    public function saveMingrade()
    {
        $this->validate();

        $uni = Auth::user()->getUni();
        $uni->academic_min = $this->option;
        $uni->min_grade_score = $this->scoreOptions[$this->selectedScoreOption];
        $uni->save();
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
            'A*',
            'A',
            'B',
            'C',
            'D',
            'E'
        ];
    }

    public function getAmericanCurriculum()
    {
        return [
            '4',
            '3,5',
            '3',
            '2,5',
            '2',
            '1,5'
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
