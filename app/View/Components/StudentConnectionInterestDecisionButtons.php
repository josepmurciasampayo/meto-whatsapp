<?php

namespace App\View\Components;

use App\Models\Connection;
use Illuminate\View\Component;

class StudentConnectionInterestDecisionButtons extends Component
{
    /**
     * @var Connection
     */
    public Connection $studentUniversity;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Connection $studentUniversity)
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
