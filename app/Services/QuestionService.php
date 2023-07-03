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
use App\Models\QuestionCurriculum;
use App\Models\Response;
use App\Models\ResponseBranch;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function get(QuestionType $type) :Collection
    {
        return Question::
            where('type', $type())
            ->where('status', QuestionStatus::ACTIVE())
            ->whereNot('format', 0)
            ->orderBy('order', 'asc')
            ->get();
    }

    public function getAcademic(int $curriculum_id, int $screen = null) :Collection
    {
        if (is_null($screen)) {
            $id_array = DB::select("
                select q.id
                from meto_questions as q
                    join meto_question_curricula as j on j.question_id = q.id and j.curriculum_id = $curriculum_id
                    where q.format != 0
                    order by j.screen, j.order
                    "
            );

        } else {
            $id_array = DB::select("
                select q.id
                from meto_questions as q
                    join meto_question_curricula as j on j.question_id = q.id and j.curriculum_id = $curriculum_id and j.screen = $screen
                    where q.format != 0
                    order by j.screen, j.order
                    "
            );
        }

        $id_array = (Arr::pluck($id_array, 'id'));
        $order = 'FIELD(id,' . implode(',', $id_array) . ')';
        return Question::with('academic', 'responses')->whereIn('id', $id_array)->orderByRaw($order)->get();
    }

    public function getAcademicNextScreen(int $curriculum, int $screen) :int
    {
        $branchingQuestionID = QuestionCurriculum::where('curriculum_id', $curriculum)->where('screen', $screen)->where('branch', YesNo::YES())->first();

        if (is_null($branchingQuestionID)) {
            $destination = QuestionCurriculum::where('curriculum_id', $curriculum)->where('screen', $screen)->whereNotNull('destination_screen')->first();
            return $destination->destination_screen;
        }
        $answer = Answer::where('question_id', $branchingQuestionID->question_id)->where('student_id', Auth::user()->student_id())->first();
        $responseBranches = ResponseBranch::where('question_id', $branchingQuestionID->question_id)->where('curriculum_id', $curriculum)->get();
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

    public function store(Request $request) :?Question
    {
        if ($request->input('toDelete') > 0) {
            Response::destroy($request->input('toDelete'));
            return null;
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
        $question->required = $request->input('required');
        $question->equivalency = $request->input('equivalency');
        $question->status = $request->input('active');
        $question->order = (is_array($request->input('order'))) ? null : $request->input('order');
        $question->notes = $request->input('notes');

        $question->save();

        if ($question->type == \App\Enums\Student\QuestionType::ACADEMIC()) {
            foreach ($request->input('join') as $curriculum_id => $join_id) {
                $questionScreen = QuestionCurriculum::find($join_id);
                $questionScreen->screen = $request->input('screen')[$join_id];
                $questionScreen->order = $request->input('order')[$join_id];
                $questionScreen->branch = isset($request->input('hasBranch')[$join_id]) ? YesNo::YES() : YesNo::NO();
                if ($request->has('destination') && isset($request->input('destination')[$join_id])) {
                    $questionScreen->destination_screen = $request->input('destination')[$join_id];
                } else {
                    $questionScreen->destination_screen = null;
                }
                $questionScreen->save();
            }
        }

        (new ResponseService())->create($question, $request);

        return $question;
    }

    public function getProgress(QuestionType $questionType, int $student_id) :int
    {
        $questions = Question::where('type', $questionType)
            ->where('status', QuestionStatus::ACTIVE())
            ->whereNot('format', 0)
            ->where('required', YesNo::YES())
            ->get();
        if (count($questions) == 0) {
            return 0;
        }
        foreach ($questions as $question) {
            $IDs[] = $question->id;
        }
        $answers = Answer::where('student_id', $student_id)->whereIn('question_id', $IDs)->whereNotNull('text')->get();

        //$type = QuestionType::descriptions()[$questionType()];
        //Debugbar::info($type . ": " . count($questions) . " questions, " . count($answers) . " answers");
        return round(count($answers) / count($questions) * 100);
    }

    public function getAllProgress(int $student_id) :bool
    {
        $types = [
            QuestionType::HIGHSCHOOL,
            QuestionType::GENERAL,
            QuestionType::TESTING,
            QuestionType::UNIVERSITY,
            QuestionType::EXTRACURRICULAR,
            QuestionType::FINANCIAL,
            QuestionType::DEMOGRAPHIC,
        ];
        foreach ($types as $type) {
            if ($this->getProgress($type, $student_id) != 100) {
                return false;
            }
        }
        return true;
    }
}
