<?php

namespace App\Models;

use App\Enums\EnumGroup;
use App\Enums\Student\Curriculum;
use App\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    protected $guarded = [];

    public static $questions = [
        /* question ID => question column in the student table */
        318 => 'curriculum',
        244 => 'efc',
        61 => 'actively_applying',
        275 => 'dob',
        283 => 'birth_city',
        281 => 'birth_country',
        285 => 'refugee',
        308 => 'disability',
        312 => 'submission_device',
        104 => 'countryHS',
        288 => 'citizenship',
        290 => 'citizenship_extra',
        13 => 'track',
        260 => 'destination',
        271 => 'gender',
        44 => 'ranking',
        69 => 'det',
        67 => 'act',
        73 => 'toefl',
        70 => 'ielts',
        164 => 'affiliations',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function connections(): HasMany
    {
        return $this->hasMany(Connection::class, 'student_id');
    }

    public function curriculum(): ?Curriculum
    {
        $curriculum_id = Answer::where('student_id', $this->id)
            ->where('question_id', \App\Enums\Question::CURRICULUM())
            ->first()
            ?->response_id;

        if (is_null($curriculum_id)) {
            $curriculum_id = \App\Models\Curriculum::where('enum_id', $this->curriculum_id)->first()?->response_id;
        }

        if (is_null($curriculum_id)) {
            return null;
        }

        return match ($curriculum_id) {
            46 => Curriculum::CAMBRIDGE,
            47 => Curriculum::AMERICAN,
            48 => Curriculum::IB,
            49 => Curriculum::UGANDAN,
            50 => Curriculum::KENYAN,
            51 => Curriculum::RWANDAN,
            52 => Curriculum::NATIONAL,

            109523 => Curriculum::BANGLADESH,
            109524 => Curriculum::BRAZIL,
            109525 => Curriculum::EGYPT,
            109526 => Curriculum::ETHIOPIA,
            109527 => Curriculum::GHANA,
            109528 => Curriculum::INDIA,
            109529 => Curriculum::INDONESIA,
            109530 => Curriculum::IRAN,
            109531 => Curriculum::KUWAIT,
            109532 => Curriculum::MEXICO,
            109533 => Curriculum::MOROCCO,
            109534 => Curriculum::NEPAL,
            109535 => Curriculum::NIGERIA,
            109536 => Curriculum::SAUDIARABIA,
            109537 => Curriculum::SOUTHAFRICA,
            109538 => Curriculum::TURKIYE,
            109539 => Curriculum::VIETNAM,

            default => null,
        };
    }

    public function updateFromAnswers(): void
    {
        $question_ids = array_keys(Student::$questions);
        $answers = Answer::with('student')->where('student_id', $this->id)->whereIn('question_id', $question_ids)->get();
        foreach ($answers as $answer) {
            $this->updateFromAnswer($answer);
        }
    }

    public function updateFromAnswer(Answer $answer): void
    {
        switch ($answer->question_id) {
            case 318:
                $this->curriculum = str_replace(" Curriculum", "", $answer->text);
                $c = \App\Models\Curriculum::where('response_id', $answer->response_id)->first();
                $this->curriculum_id = $c?->enum_id;
                break;
            case 244:
                $this->efc = Helpers::stripNonNumeric($answer->text);
                break;
            case 61:
                $this->actively_applying = $answer->text;
                $this->actively_applying_id = $answer->response_id;
                break;
            case 275:
                $this->dob = $answer->text;
                break;
            case 283:
                $this->birth_city = $answer->text;
                break;
            case 281:
                $this->birth_country = $answer->text;
                break;
            case 285:
                $this->refugee = $answer->text;
                break;
            case 308:
                $this->disability = $answer->text_expanded;
                break;
            case 312:
                $this->submission_device = $answer->text;
                break;
            case 104:
                $this->countryHS = $answer->text;
                break;
            case 288:
                $this->citizenship = $answer->text;
                break;
            case 290:
                $this->citizenship_extra = $answer->text;
                break;
            case 13:
                $this->track = $answer->text;
                break;
            case 260:
                $this->destination = $answer->text_expanded;
                break;
            case 271:
                $this->gender = $answer->text;
                break;
            case 44:
                $this->ranking = $answer->text;
                break;
            case 69:
                $this->det = $answer->text;
                break;
            case 67:
                $this->act = $answer->text;
                break;
            case 73:
                $this->toefl = $answer->text;
                break;
            case 70:
                $this->ielts = $answer->text;
                break;
            case 164:
                $this->affiliations = $answer->text;
                break;
            default: return;
        }
        $this->save();
    }
}
