<?php

namespace App\View\Components;

use App\Models\StudentUniversity;
use Illuminate\View\Component;

class StudentConnectionInterestDecisionButtons extends Component
{
    /**
     * @var StudentUniversity
     */
    public StudentUniversity $studentUniversity;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(StudentUniversity $studentUniversity)
    {
        $this->studentUniversity = $studentUniversity;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student-connection-interest-decision-buttons')
            ->with([
                'studentUniversity' => $this->studentUniversity
            ]);
    }
}
