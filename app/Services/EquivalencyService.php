<?php

namespace App\Services;

use App\Enums\Student\Curriculum;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Student;
use App\Models\User;

class EquivalencyService
{
    public function update(User $user): void
    {
        $student = $user->student();
        switch ($student->curriculum()) {
            case Curriculum::IB():
                $this->updateIB($student);
                break;
            case Curriculum::CAMBRIDGE():
                $this->updateCambridge($student);
                break;
            case Curriculum::AMERICAN():
                $this->updateAmerican($student);
                break;
            case Curriculum::RWANDAN():
                $this->updateRwandan($student);
                break;
            case Curriculum::KENYAN():
                $this->updateKenyan($student);
                break;
            case Curriculum::UGANDAN():
                $this->updateUgandan($student);
                break;
            case Curriculum::NATIONAL():
                $this->updateNational($student);
                break;
            default:
                return;
        }
    }

    public function updateIB(Student $student): void
    {
        $is_final = Answer::where('student_id', $student->id)
            ->where('question_id', 457)
            ->first()
            ->response_id == 5924; // Final Grade response
        $question_ids = ($is_final) ? [34, 36, 38, 35, 33, 37, 459] : [34, 36, 38, 35, 33, 37];
        $answers = Answer::where('student_id', $student->id)
            ->whereIn('question_id', $question_ids)
            ->get();
        $total = 0;
        foreach ($answers as $answer) {
            if (is_null($answer->response_id)) {
                return;
            }
            $total += $answer->text;
        }

        $student->equivalency = $this->getEquivalent(Curriculum::IB, $total);
        $student->save();
    }

    public function updateCambridge(Student $student): void
    {
        $question_ids = [168, 169, 170];
        $answers = Answer::where('student_id', $student->id)
            ->whereIn('question_id', $question_ids)
            ->get();
        $final = "";
        foreach ($answers as $answer) {
            if (is_null($answer->response_id)) {
                return;
            }
            $final += $answer->text;
        }

        $student->equivalency = $this->getEquivalent(Curriculum::CAMBRIDGE, $final);
        $student->save();
    }

    public function updateAmerican(Student $student): void
    {
        $is_weighted = Answer::where('student_id', $student->id)
                ->where('question_id', 457)
                ->first()
                ->response_id == 5909; // Final Grade response
        $senior = Answer::where('student_id', $student->id)
            ->where('question_id', 150)
            ->first()
            ?->text;
        $junior = Answer::where('student_id', $student->id)
            ->where('question_id', 143)
            ->first()
            ?->test;

        if ($senior || $junior) {
            $student->equivalency = $this->getEquivalent(Curriculum::AMERICAN, $senior ?? $junior, $is_weighted);
            $student->save();
        }
    }

    public function updateRwandan(Student $student): void
    {
        $answers = Answer::where('student_id', $student->id)
            ->whereIn('question_id', [343, 341, 336, 335])
            ->get();

        $score = null;

        foreach ($answers as $answer) {
            if ($answer->text) {
                $student->equivalency = $this->getEquivalent(Curriculum::RWANDAN, $score);
                $student->save();
                return;
            }
        }
    }

    public function updateKenyan(Student $student): void
    {
        $answers = Answer::where('student_id', $student->id)
            ->whereIn('question_id', [375, 255])
            ->get();

        $score = null;

        foreach ($answers as $answer) {
            if ($answer->text) {
                $student->equivalency = $this->getEquivalent(Curriculum::UGANDAN, $score);
                $student->save();
                return;
            }
        }
    }

    public function updateUgandan(Student $student): void
    {
        $answers = Answer::where('student_id', $student->id)
            ->whereIn('question_id', [378, 76, 126])
            ->get();

        $score = null;

        foreach ($answers as $answer) {
            if ($answer->text) {
                $student->equivalency = $this->getEquivalent(Curriculum::RWANDAN, $score);
                $student->save();
                return;
            }
        }
    }

    public function updateNational(Student $student): void
    {
        $answer = Answer::where('student_id', $student->id)
            ->where('question_id', 462)
            ->first();

        if ($answer->text) {
            $student->equivalency = $this->getEquivalent(Curriculum::NATIONAL, $answer->text);
            $student->save();
        }
    }

    public function getEquivalent(Curriculum $curriculum, string $score, int $score_type): array
    {
        switch ($curriculum) {

        }
    }
}
