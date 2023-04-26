<?php

namespace App\Services;

use App\Enums\General\YesNo;
use App\Enums\QuestionFormat;
use App\Enums\QuestionStatus;
use App\Enums\Student\Curriculum;
use App\Enums\Student\QuestionType;
use App\Helpers;
use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionScreen;
use App\Models\Response;
use App\Models\ResponseBranch;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Fluent;

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
            $toReturn[$question->id] = new Fluent($question->toArray());
        }
        return $toReturn;
    }

    public function getAcademic(int $curriculum, int $screen = null) :array
    {
        if (is_null($screen)) {
            //$questions = Question::where('type', QuestionType::ACADEMIC())->where($curriculum,YesNo::YES())->whereNot('format', 0)->orderBy('order')->get();
            $questions = Helpers::dbQueryArray('
                select * from view_questions where type = ' . QuestionType::ACADEMIC() . ' and curriculum = ' . $curriculum . ' and format != 0 order by screen, `order`
            ');
        } else {
            $questions = Helpers::dbQueryArray('
                select * from view_questions where type = ' . QuestionType::ACADEMIC() . ' and curriculum = ' . $curriculum . ' and screen = ' . $screen . ' and format != 0 order by `order`
            ');
        }

        $toReturn = array();
        foreach ($questions as $question) {
            $toReturn[$question['question_id']] = (new Fluent($question))->id($question['question_id']);
        }
        return ($toReturn);
    }

    public function getAcademicNextScreen(int $curriculum, int $screen) :int
    {
        $branchingQuestionID = QuestionScreen::where('curriculum', $curriculum)->where('screen', $screen)->where('branch', YesNo::YES())->first();
        if (is_null($branchingQuestionID)) {
            $destination = QuestionScreen::where('curriculum', $curriculum)->where('screen', $screen)->whereNotNull('destination_screen')->first();
            return $destination->destination_screen;
        }
        $answer = Answer::where('question_id', $branchingQuestionID->question_id)->where('student_id', Auth::user()->student_id())->first();
        $responseBranches = ResponseBranch::where('question_id', $branchingQuestionID->question_id)->where('curriculum', $curriculum)->get();
        foreach ($responseBranches as $branch) {
            if ($branch->response_id == $answer->response_id) {
                return $branch->to_screen;
            }
        }
        Log::error('Could not find screen for curriculum ' . $curriculum . ' and screen ' . $screen);
        return 0;
    }

    public function getCurriculum(User $user) :?Curriculum
    {
        $answer = Answer::where('question_id', 318)->where('student_id', $user->student_id())->first();
        if ($answer) {
            // response IDs are coded, Curriculum IDs aren't used but should be?
            return match($answer->response_id) {
                46 => Curriculum::CAMBRIDGE,
                47 => Curriculum::AMERICAN,
                48 => Curriculum::IB,
                49 => Curriculum::UGANDAN,
                50 => Curriculum::KENYAN,
                51 => Curriculum::RWANDAN,
                52 => Curriculum::OTHER,
            };
        } else {
            return null;
        }
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
        $question->save();

        foreach (Curriculum::descriptions() as $index => $value) {
            $question->curriculum($index, false);
        }
        $question->save();

        // reset all info before saving just-submitted info
        $q = QuestionScreen::where('question_id', $question->id)->get();

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
                    if ($questionScreen->branch == YesNo::YES() && $request->has('destination') && isset($request->input('destination')[$curriculum])) {
                        $questionScreen->destination_screen = $request->input('destination')[$curriculum];
                    } else {
                        $questionScreen->destination_screen = null;
                    }
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
        foreach ($questions as $id => $question) {
            $question_ids[] = $id;
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
        foreach ($questions as $id => $question) {
            $question_ids[] = $id;
        }
        $answers = Answer::whereIn('question_id', $question_ids)->where('student_id', Auth::user()->student_id())->get();
        $answerArray = array();
        foreach ($answers as $answer) {
            $answerArray[$answer->question_id] = $answer->text;
        }
        return $answerArray;
    }

    public function getProgress(QuestionType $questionType) :int
    {
        $questions = Question::where('type', $questionType)->where('required', YesNo::YES())->get();
        if (count($questions) == 0) {
            return 0;
        }
        foreach ($questions as $question) {
            $IDs[] = $question->id;
        }
        $student_id = Auth::user()->student_id();
        $answers = Answer::where('student_id', $student_id)->whereIn('question_id', $IDs)->whereNotNull('text')->get();

        $type = QuestionType::descriptions()[$questionType()];
        Debugbar::info($type . ": " . count($questions) . " questions, " . count($answers) . " answers");
        return round(count($answers) / count($questions) * 100);
    }
}
