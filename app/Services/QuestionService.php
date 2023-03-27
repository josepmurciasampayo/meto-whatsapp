<?php

namespace App\Services;

use App\Enums\General\YesNo;
use App\Enums\QuestionFormat;
use App\Enums\QuestionStatus;
use App\Enums\Student\Curriculum;
use App\Enums\Student\QuestionType;
use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionScreen;
use App\Models\Response;
use App\Models\ResponseBranch;
use Illuminate\Http\Request;


class QuestionService
{
    public function create() :Question
    {
        $question = new Question();
        $question->type = QuestionType::GENERAL();
        $question->format = QuestionFormat::INPUT();
        $question->save();

        return $question;
    }
    public function get(QuestionType $type) :array
    {
        $questions = Question::
            where('type', $type())
            ->where('status', QuestionStatus::ACTIVE())
            ->whereNot('format', 0)
            ->orderBy('order', 'asc')
            ->get();

        $toReturn = array();
        foreach ($questions as $question) {
            $toReturn[$question->id] = $question;
        }
        return $toReturn;
    }

    public function store(Request $request) :Question
    {
        if ($request->input('toDelete') > 0) {
            Response::destroy($request->input('toDelete'));
            return Question::find($request->input('question_id'));
        }

        if (is_numeric($request->input('question_id'))) {
            $question = Question::find($request->input('question_id'));
        } else {
            $question = new Question();
        }
        $question->text = $request->input('text');
        $question->format = $request->input('format');
        $question->type = $request->input('category');
        $question->help = $request->input('help');
        $question->required = match($request->input('required')) {
            'Yes' => YesNo::YES(),
            'No' => YesNo::NO(),
        };
        $question->status = match($request->input('active')) {
            'Active' => QuestionStatus::ACTIVE(),
            'Inactive' => QuestionStatus::INACTIVE(),
        };

        $question->screen = (is_array($request->input('screen'))) ? null : $request->input('screen') ;
        $question->order = (is_array($request->input('order'))) ? null : $request->input('order');

        foreach (Curriculum::descriptions() as $index => $value) {
            $question->curriculum($index, false);
        }
        $question->save();

        // reset all info before saving just-submitted info
        QuestionScreen::where('question_id', $question->id)->delete();

        if ($question->type == \App\Enums\Student\QuestionType::ACADEMIC()) {
            if ($request->has('inUse')) {
                foreach ($request->input('inUse') as $curriculum => $value) {
                    $question->curriculum($curriculum, true);

                    $questionScreen = new QuestionScreen();
                    $questionScreen->question_id = $question->id;
                    $questionScreen->curriculum = $curriculum;
                    $questionScreen->screen = $request->input('screen')[$curriculum];
                    $questionScreen->order = $request->input('order')[$curriculum];
                    $questionScreen->branch = isset($request->input('hasBranch')[$curriculum]) ? YesNo::YES() : YesNo::NO();
                    $questionScreen->save();
                }
            }
        }

        if ($request->input('responses')) { // number of responses to create
            $responses = $request->input('responses');
            for ($i = 0; $i < $responses; ++$i) {
                $response = new Response();
                $response->question_id = $question->id;
                $response->save();
            }
        }

        if ($request->input('response')) { // text for existing responses
            $responses = $request->input('response');
            ResponseBranch::where('question_id', $question->id)->delete();

            foreach ($responses as $id => $r) {
                $response = Response::find($id);
                $response->text = $r;
                $response->save();

                if ($request->input('responseBranch') && $request->input('responseBranch')[$id]) {
                    foreach ($request->input('responseBranch')[$id] as $curriculum => $value) {
                        $rb = new ResponseBranch();
                        $rb->question_id = $question->id;
                        $rb->response_id = $id;
                        $rb->curriculum = $curriculum;
                        $rb->to_screen = $value;
                        $rb->save();
                    }
                }
            }
        }
        return $question;
    }

    public function responses(array $questions) :array
    {
        $question_ids = array();
        foreach ($questions as $question) {
            $question_ids[] = $question->id;
        }
        $responses = Response::whereIn('question_id', $question_ids)->get();
        $responseArray = array();
        foreach ($responses as $response) {
            $responseArray[$response->question_id][] = $response;
        }
        return $responseArray;
    }

    public function answers(array $questions) :array
    {
        $question_ids = array();
        foreach ($questions as $question) {
            $question_ids[] = $question->id;
        }
        $answers = Answer::whereIn('question_id', $question_ids)->where('student_id', 7777)->get();
        $answerArray = array();
        foreach ($answers as $answer) {
            $answerArray[$answer->question_id] = $answer->text;
        }
        return $answerArray;
    }
}
