<?php

namespace App\Console\Commands;

use App\Enums\General\YesNo;
use App\Enums\QuestionFormat;
use App\Enums\QuestionStatus;
use App\Enums\Student\QuestionType;
use App\Helpers;
use App\Models\Curriculum;
use App\Enums\Student\Curriculum as CurriculumEnum;
use App\Models\Curriculum as CurriculumModel;
use App\Models\Question;
use App\Models\QuestionCurriculum;
use App\Models\Response;
use App\Models\ResponseBranch;
use Illuminate\Console\Command;

class ImportCurriculumQuestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:questions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // self::createCurricula();

        $files = [
            \App\Enums\Student\Curriculum::IRAN() => 'Iran.csv',
            \App\Enums\Student\Curriculum::KUWAIT() => 'Kuwait.csv',
            /*
            \App\Enums\Student\Curriculum::INDIA() => 'India.csv',
            \App\Enums\Student\Curriculum::MEXICO() => 'Mexico.csv',
            \App\Enums\Student\Curriculum::VIETNAM() => 'Vietnam.csv',
            \App\Enums\Student\Curriculum::GHANA() => 'Ghana.csv',
            \App\Enums\Student\Curriculum::NIGERIA() => 'Nigeria.csv',
            \App\Enums\Student\Curriculum::ETHIOPIA() => 'Ethiopia.csv',
            \App\Enums\Student\Curriculum::NEPAL() => 'Nepal.csv',
            \App\Enums\Student\Curriculum::SAUDIARABIA() => 'Saudi Arabia.csv',
            \App\Enums\Student\Curriculum::TURKIYE() => 'Turkiye.csv',
            \App\Enums\Student\Curriculum::BANGLADESH() => 'Bangladesh.csv',
            \App\Enums\Student\Curriculum::BRAZIL() => 'Brazil.csv',
            \App\Enums\Student\Curriculum::INDONESIA() => 'Indonesia.csv',
            \App\Enums\Student\Curriculum::SOUTHAFRICA() => 'South Africa.csv',
            \App\Enums\Student\Curriculum::MOROCCO() => 'Morocco.csv',
            \App\Enums\Student\Curriculum::EGYPT() => 'Egypt.csv',
            */
        ];

        foreach ($files as $curriculum_id => $file) {
            if (file_exists(resource_path('curricula/' . $file))) {
                $data = Helpers::arrayFromCSV(resource_path('curricula/' . $file));
                echo "\n\nStarting $file";
                $question_id = null;
                $i=0;
                foreach ($data as $row) {
                    if (strlen($row['question']) > 0) {
                        $question_id = self::importQuestion($row);
                        self::importCurriculumJoin($row, $question_id, $curriculum_id);
                    }

                    if (strlen($row['responses'])) {
                        $response_id = self::importResponse($row, $question_id);
                        self::importBranch($row, $curriculum_id, $question_id, $response_id);
                    }
                    ++$i;
                    //echo "\nRow $i";
                }
                echo "\nImported $file";
            }
        }
        return Command::SUCCESS;
    }

    public function createCurricula(): void
    {
        if (Curriculum::all()->count() == 0) {
            foreach (CurriculumEnum::descriptions() as $id => $name) {
                $curr = new CurriculumModel();
                $curr->id = $id;
                $curr->name = $name;
                $curr->save();
            }
        }
    }

    public function importQuestion(array $row): int
    {
        $question = new Question();
        $question->text = trim($row['question']);
        $question->type = QuestionType::ACADEMIC();
        $question->format = self::lookupType($row['type']);
        $question->status = QuestionStatus::ACTIVE();
        $question->required = ($row['required'] == "Yes") ? YesNo::YES() : YesNo::NO();
        if (strlen($row['help']) > 0) {
            $question->help = $row['help'];
        }
        $question->save();
        return $question->id;
    }

    public function importResponse(array $row, int $question_id): int
    {
        $response = new Response();
        $response->question_id = $question_id;
        $response->text = $row['responses'];
        $response->save();

        return $response->id;
    }

    public function importCurriculumJoin(array $row, int $question_id, $curriculum_id): void
    {
        $join = new QuestionCurriculum();
        $join->question_id = $question_id;
        $join->curriculum_id = $curriculum_id;
        $join->screen = $row['screen'];
        $join->order = $row['order'];
        $join->branch = ($row['branch'] == "Yes") ? YesNo::YES() : YesNo::NO();
        $join->required = ($row['required'] == "Yes") ? YesNo::YES() : YesNo::NO();
        if ($row['destination'] == '0') {
            $join->destination_screen = 0;
        }
        $join->save();
    }

    public function importBranch(array $row, int $curriculum_id, int $question_id, int $response_id): void
    {
        $branch = new ResponseBranch();
        $branch->question_id = $question_id;
        $branch->response_id = $response_id;
        $branch->curriculum_id = $curriculum_id;
        $branch->to_screen = $row['destination'];
        $branch->save();
    }

    public function lookupType(string $type): int
    {
        return match($type) {
            "Multiple Choice (single Select)" => QuestionFormat::SELECT(),
            "Text Field (short)" => QuestionFormat::INPUT(),
            "Text Field (long)" => QuestionFormat::TEXTAREA(),
            "Dropdown (mulitple select)" => QuestionFormat::CHECKBOX(),
            default => QuestionFormat::INPUT()
        };
    }
}
