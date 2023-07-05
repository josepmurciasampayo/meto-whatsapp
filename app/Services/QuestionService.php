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
    public function getAcademic(int $curriculum_id, int $screen = null) :Collection
    {
        // TODO: refactor all this with expert Eloquent stuff
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
        if ($id_array) {
            $order = 'FIELD(id,' . implode(',', $id_array) . ')';
            return Question::with('academic', 'responses')->whereIn('id', $id_array)->orderByRaw($order)->get();
        }
        return new Collection();
    }

    public function getAcademicNextScreen(int $curriculum, int $screen) :int
    {
        $branchingQuestionID = QuestionCurriculum::where('curriculum_id', $curriculum)->where('screen', $screen)->where('branch', YesNo::YES())->first();

        if (is_null($branchingQuestionID)) {
            $destination = QuestionCurriculum::where('curriculum_id', $curriculum)->where('screen', $screen)->whereNotNull('destination_screen')->first();
            if (is_null($destination)) {
                $max = QuestionCurriculum::where('curriculum_id', $curriculum)->max('screen');
                return ($max == $screen) ? 0 : $screen+1;
            }
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

    public function store(Request $request, Question $question): void
    {
        if ($request->input('toDelete') > 0) {
            Response::destroy($request->input('toDelete'));
            return;
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
            if ($request->has('join')) {
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
            } else if ($request->has('addCurricula')) {
                $questionScreen = new QuestionCurriculum();
                $questionScreen->question_id = $question->id;
                $questionScreen->curriculum_id = $request->input('addCurricula');
                $questionScreen->save();
            }
        }
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
