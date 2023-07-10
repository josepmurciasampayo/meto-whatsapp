<?php

namespace App\Services;

use App\Enums\QuestionFormat;
use App\Helpers;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Response;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;


class AnswerService
{
    public function store(Question $question, mixed $input): Answer
    {
        $existing = Answer::where('question_id', $question->id)->where('student_id', Auth::user()->student_id())->first();
        if (!$existing) {
            $existing = new Answer();
            $existing->student_id = Auth::user()->student_id();
            $existing->question_id = $question->id;
        }

        switch ($question->format) {
            case QuestionFormat::DATE():
                //dd($input);
                //break;
            case QuestionFormat::INPUT():
            case QuestionFormat::TEXTAREA():
            case QuestionFormat::EMAIL():
            case QuestionFormat::NUMBER():
            case QuestionFormat::LOOKUP():
            case QuestionFormat::LOOKUPORG():
            case QuestionFormat::COUNTRY():
                $existing->text = $input;
                break;
            case QuestionFormat::PHONE():
            case QuestionFormat::SELECTWITHOTHER():
                $existing->text = json_encode($input);
                break;
            case QuestionFormat::SELECT():
            case QuestionFormat::RADIO():
                $existing->response_id = $input;
                $response = \App\Models\Response::find($existing->response_id);
                $existing->text = $response->text; // or we can save the index
                break;
            case QuestionFormat::CHECKBOX():
                $existing->text = implode(',', array_keys($input));
                $responses = Response::select('text')->whereIn('id', array_keys($input))->get()->pluck('text')->toArray();
                $existing->text_expanded = implode(", ", $responses);
                break;
            case QuestionFormat::COUNTRY_CHECKBOX():
                $existing->text = implode(',', $input);
                $responses = Response::select('text')->whereIn('id', $input)->get()->pluck('text')->toArray();
                $existing->text_expanded = implode(", ", $responses);
                break;
            default:

        }
        $existing->save();
        return $existing;
    }

    public function getForQuestionArray(Collection $questions, int $student_id) :array
    {
        $question_ids = array();
        foreach ($questions as $question) {
            $question_ids[] = $question->id;
        }
        $answers = Answer::whereIn('question_id', $question_ids)->where('student_id', $student_id)->get();
        $answerArray = array();
        foreach ($answers as $answer) {
            $answerArray[$answer->question_id] = $answer;
        }

        return $answerArray;
    }

    public function updateStudent(Student $student, int $question_id, string $answer): void
    {
        switch ($question_id) {
            case 244:
                $student->efc = Helpers::stripNonNumeric($answer);
                break;
            case 104:
                $student->countryHS = $answer;
                break;
            case 318:
                $student->curriculum = substr($answer, strpos($answer, ''));
                break;
            case 288:
                $student->citizenship = $answer;
                break;
            case 290:
                $student->citizenship_extra = $answer;
                break;
            case 13:
                $student->track = $answer;
                break;
            case 260:
                $student->destination = $answer;
                break;
            case 271:
                $student->gender = $answer;
                break;
            case 44:
                $student->ranking = $answer;
                break;
            case 69:
                $student->det = $answer;
                break;
            case 67:
                $student->act = $answer;
                break;
            case 73:
                $student->toefl = $answer;
                break;
            case 70:
                $student->ielts = $answer;
                break;
            case 164:
                $student->affiliations = $answer;
                break;
            case 285:
                $student->refugee = $answer;
                break;
            case 308:
                $student->disability = $answer;
                break;
            case 275:
                $student->dob = $answer;
                break;
            case 296:
                $student->email_owner = $answer;
                break;
            case 312:
                $student->submission_device = $answer;
                break;
            case 283:
                $student->birth_city = $answer;
                break;
            case 281:
                $student->birth_country = $answer;
                break;
        }
        $student->save();
    }
}
