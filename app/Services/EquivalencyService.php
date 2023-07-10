<?php

namespace App\Services;

use App\Enums\ScoreType;
use App\Enums\Student\Curriculum;
use App\Helpers;
use App\Models\Answer;
use App\Models\Equivalency;
use App\Models\Institution;
use App\Models\Student;
use Barryvdh\Debugbar\Facades\Debugbar;

class EquivalencyService
{
    public function update(Student $student): void
    {
        switch ($student->curriculum()) {
            case Curriculum::IB:
                $this->updateIB($student);
                break;
            case Curriculum::CAMBRIDGE:
                $this->updateCambridge($student);
                break;
            case Curriculum::AMERICAN:
                $this->updateAmerican($student);
                break;
            case Curriculum::RWANDAN:
                $this->updateRwandan($student);
                break;
            case Curriculum::KENYAN:
                $this->updateKenyan($student);
                break;
            case Curriculum::UGANDAN:
                $this->updateUgandan($student);
                break;
            case Curriculum::NATIONAL:
                $this->updateNational($student);
                break;
            default:
                return;
        }
    }

    public function updateIB(Student $student): void
    {
        $scoreType = match(
            Answer::where('student_id', $student->id)
            ->where('question_id', 457)
            ->first()
            ?->response_id) {
            5924 => ScoreType::IBFINAL,
            5925 => ScoreType::IBPREDICTED,
            5926 => ScoreType::IBSEMESTER,
            null => null,
            default => null,
        };
        if ($scoreType) {
            $question_ids = ($scoreType == ScoreType::IBFINAL) ? [34, 36, 38, 35, 33, 37, 459] : [34, 36, 38, 35, 33, 37];

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

            $student->equivalency = $this->getPercentile(Curriculum::IB, $scoreType, $total);
            $student->save();
        }
    }

    public function updateCambridge(Student $student): void
    {
        $answer = Answer::where('student_id', $student->id)
            ->where('question_id', 460)
            ->first()
            ?->response_id;
        if (is_null($answer)) {
            return;
        }
        $scoreType = match($answer) {
            5914 => ScoreType::CAMFINAL,
            5915 => ScoreType::CAMPREDICTED,
            5916 => ScoreType::CAMAS,
            default => null,
            null => null,
        };
        if ($scoreType) {
            $answers = Answer::where('student_id', $student->id)
                ->whereIn('question_id', [168, 169, 170])
                ->get();
            $final = array();
            foreach ($answers as $answer) {
                if (is_null($answer->response_id)) {
                    return;
                }
                $final[] = $answer->text;
            }

            if (is_null($final)) {
                return;
            }
            sort($final);
            $final = implode($final);
            $student->equivalency = $this->getPercentile(Curriculum::CAMBRIDGE, $scoreType, $final);
            $student->save();
        }
    }

    public function updateAmerican(Student $student): void
    {
        $weighted = Answer::where('student_id', $student->id)
            ->where('question_id', 452)
            ->first()
            ?->response_id == 5909;
        $senior = Answer::where('student_id', $student->id)
            ->where('question_id', 150)
            ->first()
            ?->text;
        if ($senior && $weighted) {
            $scoreType = ($weighted) ? ScoreType::AMSENIORW : ScoreType::AMSENIORU;
            $student->equivalency = $this->getPercentile(Curriculum::AMERICAN, $scoreType, $senior);
            $student->save();
            return;
        }
        $junior = Answer::where('student_id', $student->id)
            ->where('question_id', 143)
            ->first()
            ?->test;
        if ($junior && $weighted) {
            $scoreType = ($weighted) ? ScoreType::AMJUNIORW : ScoreType::AMJUNIORU;
            $student->equivalency = $this->getPercentile(Curriculum::AMERICAN, $scoreType, $junior);
            $student->save();
        }
    }

    public function updateRwandan(Student $student): void
    {
        $finalA = Answer::where('student_id', $student->id)
            ->where('question_id', 343)
            ->first()
            ?->text;
        if ($finalA) {
            $student->equivalency = $this->getPercentile(Curriculum::RWANDAN, ScoreType::RWANFINALA, $finalA);
            $student->save();
            return;
        }

        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 373)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile(Curriculum::RWANDAN, ScoreType::RWANMOCKA, $mock);
            $student->save();
            return;
        }

        $finalOnew = Answer::where('student_id', $student->id)
            ->where('question_id', 373)
            ->first()
            ?->text;
        if ($finalOnew) {
            $student->equivalency = $this->getPercentile(Curriculum::RWANDAN, ScoreType::RWANFINALON, $finalOnew);
            $student->save();
            return;
        }

        $finalOold = Answer::where('student_id', $student->id)
            ->where('question_id', 255)
            ->first()
            ?->text;
        if ($finalOold) {
            $student->equivalency = $this->getPercentile(Curriculum::RWANDAN, ScoreType::RWANFINALOO, $finalOold);
            $student->save();
        }
    }

    public function updateKenyan(Student $student): void
    {
        $kcse = Answer::where('student_id', $student->id)
            ->where('question_id', 375)
            ->first()
            ?->text;
        if ($kcse) {
            $student->equivalency = $this->getPercentile(Curriculum::KENYAN, ScoreType::KENFINAL, $kcse);
            $student->save();
            return;
        }

        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 373)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile(Curriculum::KENYAN, ScoreType::KENMOCK, $mock);
            $student->save();
            return;
        }

        $kcpe = Answer::where('student_id', $student->id)
            ->where('question_id', 255)
            ->first()
            ?->text;
        if ($kcpe) {
            $student->equivalency = $this->getPercentile(Curriculum::KENYAN, ScoreType::KENKCPE, $kcpe);
            $student->save();
        }
    }

    public function updateUgandan(Student $student): void
    {
        $finalA = Answer::where('student_id', $student->id)
            ->where('question_id', 378)
            ->first()
            ?->text;
        if ($finalA) {
            $student->equivalency = $this->getPercentile(Curriculum::UGANDAN, ScoreType::UGANFINALA, $finalA);
            $student->save();
            return;
        }

        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 76)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile(Curriculum::UGANDAN, ScoreType::UGANMOCK, $mock);
            $student->save();
            return;
        }

        $finalO = Answer::where('student_id', $student->id)
            ->where('question_id', 126)
            ->first()
            ?->text;
        if ($finalO) {
            $student->equivalency = $this->getPercentile(Curriculum::UGANDAN, ScoreType::UGANFINALO, $finalO);
            $student->save();
        }

    }

    public function updateNational(Student $student): void
    {
        $answer = Answer::where('student_id', $student->id)
            ->where('question_id', 462)
            ->first();

        if ($answer?->text) {
            $student->equivalency = $this->getPercentile(Curriculum::NATIONAL, ScoreType::OTHERLEAVING, $answer->text);
            $student->save();
        }
    }

    public function updateUni(Institution $uni): void
    {
        $curriculum = Curriculum::from($uni->min_grade_curriculum);

        switch ($curriculum) {
            case Curriculum::IB:
                $minGradeEquivalency = $this->getPercentile($curriculum, ScoreType::IBFINAL, $uni->min_grade);
                break;
            case Curriculum::CAMBRIDGE:
                $minGradeEquivalency = $this->getPercentile($curriculum, ScoreType::CAMFINAL, $uni->min_grade);
                break;
            case Curriculum::AMERICAN:
                $minGradeEquivalency = $this->getPercentile($curriculum, ScoreType::AMSENIORU, $uni->min_grade);
                break;
            case Curriculum::NATIONAL:
                $minGradeEquivalency = $this->getPercentile($curriculum, ScoreType::OTHERLEAVING, $uni->min_grade);
                break;
        };

        $uni->update([
            'min_grade_equivalency' => $minGradeEquivalency
        ]);
    }

    public function getPercentile(Curriculum $curriculum, ScoreType $scoreType, string $score): int|null
    {
        //dd("Curriculum: $curriculum->value ScoreType: $scoreType->value Sore: $score");
        $equivalency = Equivalency::where('curriculum_id', $curriculum())->
        where('score_type', $scoreType())->
        where('score', $score)->
        first();
        return ($equivalency?->percentile);
    }
}
