<?php

namespace App\Http\Livewire\Uni\Questions;

use App\Models\Institution;
use App\Services\EquivalencyService;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Enums\Student\Curriculum;

class MinGradeForm extends Component
{
    public $curricula;

    public $curriculum = 5;

    public $scoreOptions = [];

    public $selectedScoreOption = null;

    public Institution $uni;

    public $selectedOptionHasBeenSet = false;

    public function __construct()
    {
        // Get the uni of the authenticated user
        $this->uni = auth()->user()->getUni();
        // Set the $curriculum value to the university's min grade curriculum
        // if it doesn't exist, let's take the first one on the list of $curricula
        $this->curriculum = $this->uni->min_grade_curriculum ?? collect($this->curricula)->first();
    }

    public function render()
    {
        // Get the list of curricula
        $curricula = Curriculum::getSchoolChoices();
        // Remove the "other" option
        unset($curricula[$other = Curriculum::OTHER()]);
        $this->curricula = $curricula;

        // Get the options for the selected curriculum
        if ($option = $this->curriculum) {
            $method = 'get' . $this->curricula[$option] . 'Curriculum'; // ex: getIbCurriculum()
            $this->scoreOptions = $this->$method();
            $this->selectedScoreOption ??= collect($this->scoreOptions)->search($this->uni->min_grade);
            $this->selectedOptionHasBeenSet = true;
        }

        if (!$this->selectedOptionHasBeenSet) {
            $this->curriculum = collect($this->curricula)->keys()->first();
            $this->selectedScoreOption = collect($this->scoreOptions)->search($this->uni->min_grade) ?? null;
            $method = 'get' . $this->curricula[$this->curriculum] . 'Curriculum';
            $this->scoreOptions = $this->$method();
            $this->selectedOptionHasBeenSet = true;
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

        $uni->update([
            'min_grade_curriculum' => $this->curriculum,
            'min_grade' => $this->scoreOptions[$this->selectedScoreOption]
        ]);

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
