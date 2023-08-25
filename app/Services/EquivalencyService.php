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
                $this->updateIB($student, Curriculum::IB);
                break;
            case Curriculum::CAMBRIDGE:
                $this->updateCambridge($student, Curriculum::CAMBRIDGE);
                break;
            case Curriculum::AMERICAN:
                $this->updateAmerican($student, Curriculum::AMERICAN);
                break;
            case Curriculum::RWANDAN:
                $this->updateRwandan($student, Curriculum::RWANDAN);
                break;
            case Curriculum::KENYAN:
                $this->updateKenyan($student, Curriculum::KENYAN);
                break;
            case Curriculum::UGANDAN:
                $this->updateUgandan($student, Curriculum::UGANDAN);
                break;
            case Curriculum::NATIONAL:
                $this->updateNational($student, Curriculum::NATIONAL);
                break;
            case Curriculum::INDIA:
                $this->updateIndian($student, Curriculum::INDIA);
                break;
            case Curriculum::VIETNAM:
                $this->updateVietnamese($student, Curriculum::VIETNAM);
                break;
            case Curriculum::GHANA:
                $this->updateGhanian($student, Curriculum::GHANA);
                break;
            case Curriculum::MEXICO:
                $this->updateMexican($student, Curriculum::MEXICO);
                break;
            case Curriculum::NIGERIA:
                $this->updateNigerian($student, Curriculum::NIGERIA);
                break;
            case Curriculum::ETHIOPIA:
                $this->updateEthiopian($student, Curriculum::ETHIOPIA);
                break;
            case Curriculum::NEPAL:
                $this->updateNepalese($student, Curriculum::NEPAL);
                break;
            case Curriculum::SAUDIARABIA:
                $this->updateSaudiArabian($student, Curriculum::SAUDIARABIA);
                break;
            case Curriculum::IRAN:
                $this->updateIranian($student, Curriculum::IRAN);
                break;
            case Curriculum::KUWAIT:
                $this->updateKuwaiti($student, Curriculum::KUWAIT);
                break;
            case Curriculum::TURKIYE:
                $this->updateTurkish($student, Curriculum::TURKIYE);
                break;
            case Curriculum::BANGLADESH:
                $this->updateBangladeshi($student, Curriculum::BANGLADESH);
                break;
            case Curriculum::BRAZIL:
                $this->updateBrazillian($student, Curriculum::BRAZIL);
                break;
            case Curriculum::INDONESIA:
                $this->updateIndonesian($student, Curriculum::INDONESIA);
                break;
            case Curriculum::SOUTHAFRICA:
                $this->updateSouthAfrican($student, Curriculum::SOUTHAFRICA);
                break;
            case Curriculum::MOROCCO:
                $this->updateMoroccan($student, Curriculum::MOROCCO);
                break;
            case Curriculum::EGYPT:
                $this->updateEgyptian($student, Curriculum::EGYPT);
                break;
            default:
                return;
        }
    }

    public function updateIB(Student $student, Curriculum $curriculum): void
    {
        $scoreType = match(
            Answer::where('student_id', $student->id)
            ->where('question_id', 457)
            ->first()
            ?->response_id) {
            5924 => ScoreType::IBFINAL,
            5925 => ScoreType::IBPREDICTED,
            5926 => ScoreType::IBSEMESTER,
            null => ScoreType::IBFINAL,
            default => ScoreType::IBFINAL,
        };

        $question_ids = ($scoreType == ScoreType::IBFINAL) ? [34, 36, 38, 35, 33, 37, 459] : [34, 36, 38, 35, 33, 37];

        $answers = Answer::where('student_id', $student->id)
            ->whereIn('question_id', $question_ids)
            ->get();
        $total = 0;

        foreach ($answers as $answer) {
            if (is_null($answer->text)) {
                return;
            }
            $total += $answer->text;
        }

        $student->equivalency = $this->getPercentile($curriculum, $scoreType, $total);
        $student->save();
    }

    public function updateCambridge(Student $student, Curriculum $curriculum): void
    {
        $answer = Answer::where('student_id', $student->id)
            ->where('question_id', 460)
            ->first()
            ?->response_id;

        $scoreType = match($answer) {
            5914 => ScoreType::CAMFINAL,
            5915 => ScoreType::CAMPREDICTED,
            5916 => ScoreType::CAMAS,
            default => ScoreType::CAMFINAL,
        };

        $answers = Answer::where('student_id', $student->id)
            ->whereIn('question_id', [168, 169, 170])
            ->get();

        if ($answers->isEmpty()) {
            //echo "$student->user_id,";
            return;
        }

        $final = [];
        foreach ($answers as $answer) {
            if (is_null($answer->text)) {
                //echo "$student->user_id,";
                return;
            }
            $final[] = substr($answer->text, 0, 1);
        }

        sort($final);
        $final = implode($final);
        $equivalency = $this->getPercentile($curriculum, $scoreType, $final);
        if (is_null($equivalency)) {
            //echo "$student->user_id,";
            return;
        }
        $student->equivalency = $equivalency;
        $student->save();
    }

    public function updateAmerican(Student $student, Curriculum $curriculum): void
    {
        $senior = $junior = $sophomore = null;

        $senior = Answer::where('student_id', $student->id)
            ->where('question_id', 150)
            ->first()
            ?->text;
        if (str_contains($senior, "I have not")) {
            $senior = null;
        }

        if (is_null($senior)) {
            $junior = Answer::where('student_id', $student->id)
                ->where('question_id', 143)
                ->first()
                ?->text;
            if (str_contains($junior, "I")) {
                $junior = null;
            }
        }

        if (is_null($junior) && is_null($senior)) {
            $sophomore = Answer::where('student_id', $student->id)
                ->where('question_id', 154)
                ->first()
                ?->text;
            if (str_contains($sophomore, "I")) {
                $sophomore = null;
            }
        }

        $score = $senior ?? $junior ?? $sophomore ?? null;
        if (is_null($score)) {
            return;
        }

        if ($score > 4.0) {
            $weighted = true;
        } else {
            $weighted = Answer::where('student_id', $student->id)
                    ->where('question_id', 452)
                    ->first()
                    ?->response_id == 5909;
            if (is_null($weighted)) {
                $weighted = true;
            }
        }

        if ($senior) {
            $scoreType = ($weighted) ? ScoreType::AMSENIORW : ScoreType::AMSENIORU;
        } else {
            $scoreType = ($weighted) ? ScoreType::AMJUNIORW : ScoreType::AMJUNIORU;
        }

        $equivalency = $this->getPercentile($curriculum, $scoreType, $score);
        $student->equivalency = $equivalency;
        $student->save();
    }

    public function updateRwandan(Student $student, Curriculum $curriculum): void
    {
        $finalA = Answer::where('student_id', $student->id)
            ->where('question_id', 343)
            ->first()
            ?->text;
        if ($finalA) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::RWANFINALA, $finalA);
            $student->save();
            return;
        }

        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 373)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::RWANMOCKA, $mock);
            $student->save();
            return;
        }

        $finalOnew = Answer::where('student_id', $student->id)
            ->where('question_id', 373)
            ->first()
            ?->text;
        if ($finalOnew) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::RWANFINALON, $finalOnew);
            $student->save();
            return;
        }

        $finalOold = Answer::where('student_id', $student->id)
            ->where('question_id', 255)
            ->first()
            ?->text;
        if ($finalOold) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::RWANFINALOO, $finalOold);
            $student->save();
        }
    }

    public function updateKenyan(Student $student, Curriculum $curriculum): void
    {
        $kcse = Answer::where('student_id', $student->id)
            ->where('question_id', 375)
            ->first()
            ?->text;
        if ($kcse) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::KENFINAL, $kcse);
            $student->save();
            return;
        }

        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 373)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::KENMOCK, $mock);
            $student->save();
            return;
        }

        $kcpe = Answer::where('student_id', $student->id)
            ->where('question_id', 255)
            ->first()
            ?->text;
        if ($kcpe) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::KENKCPE, $kcpe);
            $student->save();
        }
    }

    public function updateUgandan(Student $student, Curriculum $curriculum): void
    {
        $finalA = Answer::where('student_id', $student->id)
            ->where('question_id', 378)
            ->first()
            ?->text;
        if ($finalA) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::UGANFINALA, $finalA);
            $student->save();
            return;
        }

        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 76)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::UGANMOCK, $mock);
            $student->save();
            return;
        }

        $finalO = Answer::where('student_id', $student->id)
            ->where('question_id', 126)
            ->first()
            ?->text;
        if ($finalO) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::UGANFINALO, $finalO);
            $student->save();
        }

    }

    public function updateNational(Student $student, Curriculum $curriculum): void
    {
        $answer = Answer::where('student_id', $student->id)
            ->where('question_id', 462)
            ->first();

        if ($answer?->text) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::OTHERLEAVING, $answer->text);
            $student->save();
        }
    }

    public function updateIndian(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 839)
            ->first()?->text;

        if ($score) {
            $score = round(Helpers::stripNonNumeric($score), 0);
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::SENIOR_SCORE, $score);
            $student->save();
        }
    }

    public function updateVietnamese(Student $student, Curriculum $curriculum): void
    {
        $national1 = Answer::where('student_id', $student->id)
            ->where('question_id', 490)
            ->first()
            ?->text;
        $national2 = Answer::where('student_id', $student->id)
            ->where('question_id', 491)
            ->first()
            ?->text;
        if (is_numeric($national1) && is_numeric($national2)) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::NATIONAL_EXAM, round($national1/$national2,2));
            $student->save();
            return;
        }
        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 502)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::SEM_AVE, $mock);
            $student->save();
        }
    }

    public function updateGhanian(Student $student, Curriculum $curriculum): void
    {
        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 560)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::WASSCE_AVE, $mock);
            $student->save();
        }

        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 560)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::HIGH_SCHOOL_AVE, $mock);
            $student->save();
        }
    }

    public function updateMexican(Student $student, Curriculum $curriculum): void
    {
        $avg = Answer::where('student_id', $student->id)
            ->where('question_id', 487)
            ->first()
            ?->text;
        if ($avg) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::FINAL_AVERAGE, $avg);
            $student->save();
        }
    }

    public function updateNigerian(Student $student, Curriculum $curriculum): void
    {
        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 560)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::WASSCE_AVE, $mock);
            $student->save();
        }

        $mock = Answer::where('student_id', $student->id)
            ->where('question_id', 560)
            ->first()
            ?->text;
        if ($mock) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::HIGH_SCHOOL_AVE, $mock);
            $student->save();
        }
    }

    public function updateEthiopian(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 618)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::NATIONAL_EXAM, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 842)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::PREDICTED_EXAM, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 633)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::SEM_AVE, $score);
            $student->save();
        }
    }

    public function updateNepalese(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 636)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::SLCE_GRADE, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 638)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::NATIONAL_EXAM, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 641)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::SEE_RESULT, $score);
            $student->save();
        }
    }

    public function updateSaudiArabian(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 656)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::OVERALL_GPA, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 657)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::RECENT_GPA, $score);
            $student->save();
            return;
        }
    }

    public function updateIranian(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 845)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::NATIONAL_EXAM, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 846)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::RECENT_GPA, $score);
            $student->save();
        }
    }

    public function updateKuwaiti(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 849)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::GRADE_12, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 850)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::CUM_GPA, $score);
            $student->save();
        }
    }

    public function updateTurkish(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 662)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::RECENT_GRADE, $score);
            $student->save();
        }
    }

    public function updateBangladeshi(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 683)
            ->first()
            ?->text;
        if ($score) {
            $score = Helpers::stripNonNumeric($score);
            if (is_numeric($score)) {
                $score = round($score, 1);
                $student->equivalency = $this->getPercentile($curriculum, ScoreType::HSC_ALIM_GPA, $score);
                $student->save();
            }
        }
    }

    public function updateBrazillian(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 738)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::PREDICTED_EXAM, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 633)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::SEM_AVE, $score);
            $student->save();
        }
    }

    public function updateIndonesian(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 760)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::FINAL_GRADE_SCALE_1, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 760)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::FINAL_GRADE_SCALE_2, $score);
            $student->save();
        }
    }

    public function updateSouthAfrican(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 778)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::MATRIC_AGG, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 778)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::APS_AGG, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 779)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::APS_SCORE, $score);
            $student->save();
        }
    }

    public function updateMoroccan(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 794)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::FINAL_GRADE, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 795)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::RECENT_GRADE, $score);
            $student->save();
        }
    }

    public function updateEgyptian(Student $student, Curriculum $curriculum): void
    {
        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 811)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::THANAWEYA_AVE, $score);
            $student->save();
            return;
        }

        $score = Answer::where('student_id', $student->id)
            ->where('question_id', 823)
            ->first()
            ?->text;
        if ($score) {
            $student->equivalency = $this->getPercentile($curriculum, ScoreType::CNISE_MARKS, $score);
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
            default:
                return;
        }

        $uni->update([
            'min_grade_equivalency' => $minGradeEquivalency
        ]);
    }

    public function getScore(Student $student, array $question_ids): ?string
    {
        foreach ($question_ids as $question_id) {
            $score = Answer::where('student_id', $student->id)
                ->where('question_id', $question_id)
                ->first()
                ?->text;
            if ($score) {
                return $score;
            }
        }
    }

    public function getPercentile(Curriculum $curriculum, ScoreType $scoreType, string $score): int|null
    {
        //dd("Curriculum: $curriculum->value ScoreType: $scoreType->value Sore: $score");
        $equivalency = Equivalency::where('curriculum_id', $curriculum())->
            where('score_type', $scoreType())->
            where('score', $score)->
            first();
        if (is_null($equivalency)) {
            // echo "\n" . $curriculum->name . ", " . $scoreType->name . ", " . $score;
            return null;
        }
        return $equivalency?->percentile;
    }
}
