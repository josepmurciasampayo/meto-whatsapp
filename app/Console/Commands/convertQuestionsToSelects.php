<?php

namespace App\Console\Commands;

use App\Enums\QuestionFormat;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Console\Command;

class convertQuestionsToSelects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:questionFormats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take questions in one-off formats and convert to standard select format';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $questions = Question::whereIn('format', [
            QuestionFormat::ALEVELGRADE(),
            QuestionFormat::ALEVEL(),
            QuestionFormat::AP(),
            QuestionFormat::CAMSUBJECT(),
            QuestionFormat::IBGRADE(),
            QuestionFormat::IBSUBJECT(),
            QuestionFormat::IGCSEGRADE(),
            QuestionFormat::LETTERGRADE(),
        ])->get();

        $responses = array();
        foreach ($questions as $question) {
            switch ($question->format) {
                case QuestionFormat::ALEVELGRADE():
                    $responses = [
                        "A*",
                        "A",
                        "B",
                        "C",
                        "D",
                        "E",
                        "I do not plan to take the A2 exam for this subject",
                        "I do not have a predicted A2 score for this subject yet, but I plan to have one in the future",
                    ];
                    $this->createResponses($question, $responses);
                    break;
                case QuestionFormat::ALEVEL():
                    $responses = [
                        "Accounting",
                        "Afrikaans - Language (AS Level only)",
                        "Arabic",
                        "Arabic - Language (AS Level only)",
                        "Art & Design",
                        "Biblical Studies",
                        "Biology",
                        "Business",
                        "Chemistry",
                        "Chinese - Language & Literature (A Level only)",
                        "Chinese - Language (AS Level only)",
                        "Chinese (A Level only)",
                        "Chinese Language (AS Level)",
                        "Classical Studies",
                        "Computer Science",
                        "Design & Technology",
                        "Design & Textiles",
                        "Digital Media & Design",
                        "Divinity (A Level only)",
                        "Drama",
                        "Economics",
                        "English - Language and Literature (AS Level only)",
                        "English - Literature",
                        "English General Paper (AS Level only)",
                        "English Language",
                        "Environmental Management (AS only)",
                        "French - Language (AS Level only)",
                        "French (A Level only)",
                        "French Language & Literature",
                        "French Language (AS Level)",
                        "Geography",
                        "German",
                        "German - Language (AS Level only)",
                        "German - Language (AS Level)",
                        "German (A Level only)",
                        "Global Perspectives & Research",
                        "Hindi - Language (AS Level only)",
                        "Hindi - Literature (AS Level only)",
                        "Hindi (A Level only)",
                        "Hinduism",
                        "History",
                        "Information Technology",
                        "Islamic Studies",
                        "Japanese Language (AS Level only)",
                        "Law",
                        "Marine Science",
                        "Mathematics",
                        "Mathematics - Further",
                        "Media Studies",
                        "Music",
                        "Physical Education",
                        "Physics",
                        "Portuguese - Language (AS Level only)",
                        "Portuguese (A Level only)",
                        "Psychology",
                        "Sociology",
                        "Spanish - First Language (AS Level only)",
                        "Spanish - Language & Literature (A Level only)",
                        "Spanish - Language (AS Level only)",
                        "Spanish - Literature (AS Level only)",
                        "Spanish (A Level only)",
                        "Spanish Language (AS Level)",
                        "Sport & Physical Education (AS Level only)",
                        "Tamil",
                        "Tamil - Language",
                        "Thinking Skills",
                        "Travel & Tourism",
                        "Urdu - Language (AS Level only)",
                        "Urdu - Pakistan only (A Level only)",
                        "Urdu (A Level only)",
                    ];
                    $this->createResponses($question, $responses);
                    break;
                case QuestionFormat::AP():
                    $responses = [
                         "AP Research",
                        "AP Seminar",
                        "AP 2-D Art and Design",
                        "AP 3-D Art and Design",
                        "AP Art History",
                        "AP Drawing",
                        "AP Music Theory",
                        "AP English Language and Composition",
                        "AP English Language and Composition",
                        "AP English Literature and Composition",
                        "AP Comparative Government and Politics",
                        "AP European History",
                        "AP Human Geography",
                        "AP Macroeconomics",
                        "AP Microeconomics",
                        "AP Psychology",
                        "AP United States Government and Politics",
                        "AP United States History",
                        "AP World History: Modern",
                        "AP Calculus AB",
                        "AP Calculus BC",
                        "AP Computer Science A",
                        "AP Computer Science Principles",
                        "AP Statistics",
                        "AP Biology",
                        "AP Chemistry",
                        "AP Environmental Science",
                        "AP Physics 1: Algebra-Based",
                        "AP Physics 2: Algebra-Based",
                        "AP Physics C: Electricity and Magnetism",
                        "AP Physics C: Mechanics",
                        "AP Chinese Language and Culture",
                        "AP French Language and Culture",
                        "AP German Language and Culture",
                        "AP Italian Language and Culture",
                        "AP Japanese Language and Culture",
                        "AP Latin",
                        "AP Spanish Language and Culture",
                        "AP Spanish Literature and Culture",
                    ];
                    $this->createResponses($question, $responses);
                    break;
                case QuestionFormat::CAMSUBJECT():
                    $responses = [
                        "Accounting",
                        "Accounting (9-1)",
                        "Afrikaans - Second Language",
                        "Agriculture",
                        "Arabic - First Language",
                        "Arabic - First Language (9-1)",
                        "Arabic - Foreign Language",
                        "Art & Design",
                        "Art & Design (9-1)",
                        "Bahasa Indonesia",
                        "Biology",
                        "Biology (9-1)",
                        "Business Studies",
                        "Business Studies (9-1)",
                        "Chemistry",
                        "Chemistry (9-1)",
                        "Chinese - First Language",
                        "Chinese - Second Language",
                        "Chinese (Mandarin) - Foreign Language",
                        "Computer Science",
                        "Computer Science (9-1)",
                        "Design & Technology",
                        "Design & Technology (9-1)",
                        "Development Studies",
                        "Drama",
                        "Drama (9-1)",
                        "Dutch - Foreign Language",
                        "Economics",
                        "Economics (9-1)",
                        "English - First Language",
                        "English - First Language (9-1)",
                        "English - First Language (US)",
                        "English Literature (US)",
                        "English - Literature in English",
                        "English - Literature in English (9-1)",
                        "English as a Second Language (Count-in speaking)",
                        "English as a Second Language (Count-in Speaking) (9-1)",
                        "English as a Second Language (Speaking Endorsement)",
                        "English as a Second Language (Speaking Endorsement) (9-1)",
                        "Enterprise",
                        "Environmental Management",
                        "Food & Nutrition",
                        "French - First Language",
                        "French - Foreign Language",
                        "French (9-1)",
                        "Geography",
                        "Geography (9-1)",
                        "German - First Language",
                        "German - Foreign Language",
                        "German (9-1)",
                        "Global Perspectives",
                        "Greek - Foreign Language",
                        "Hindi as a Second Language",
                        "History",
                        "History - American (US)",
                        "History (9-1)",
                        "Indonesian - Foreign Language",
                        "Information & Communication Technology",
                        "Information & Communication Technology (9-1)",
                        "IsiZulu as a Second Language",
                        "Islamiyat",
                        "Italian - Foreign Language",
                        "Italian (9-1)",
                        "Japanese - Foreign Language",
                        "Korean (First Language)",
                        "Latin",
                        "Malay - First Language",
                        "Malay - Foreign Language",
                        "Marine Science (Maldives only)",
                        "Mathematics",
                        "Mathematics - Additional",
                        "Mathematics - Additional (US)",
                        "Mathematics - International",
                        "Mathematics (9-1)",
                        "Mathematics (US)",
                        "Music",
                        "Music (9-1)",
                        "Pakistan Studies",
                        "Physical Education",
                        "Physical Education (9-1)",
                        "Physical Science",
                        "Physics",
                        "Physics (9-1)",
                        "Portuguese - First Language",
                        "Portuguese - Foreign Language",
                        "Religious Studies",
                        "Russian - First Language",
                        "Sanskrit",
                        "Science - Combined",
                        "Sciences - Co-ordinated (9-1)",
                        "Sciences - Co-ordinated (Double)",
                        "Sociology",
                        "Spanish - First Language",
                        "Spanish - Foreign Language",
                        "Spanish - Literature",
                        "Spanish (9-1)",
                        "Swahili",
                        "Thai - First Language",
                        "Travel & Tourism",
                        "Turkish - First Language",
                        "Urdu as a Second Language",
                        "World Literature",
                    ];
                    $this->createResponses($question, $responses);
                    break;
                case QuestionFormat::GPA():
                    for ($i = 5.0; $i >= 0; $i -= 0.1) {
                        $responses[] = number_format($i, 1);
                    }
                    $this->createResponses($question, $responses);
                    break;
                case QuestionFormat::IBGRADE():
                    $responses = [
                        "7*",
                        "6",
                        "5",
                        "4",
                        "3",
                        "2",
                        "1",
                    ];
                    $this->createResponses($question, $responses);
                    break;
                case QuestionFormat::IBSUBJECT():
                    $responses = [
                        "Biology",
                        "Business Management",
                        "Chemistry",
                        "Classical Languages",
                        "Computer Science",
                        "Dance",
                        "Design Technology",
                        "Digital Societies",
                        "Economics",
                        "Environmental Systems and Societies",
                        "Film",
                        "Further Mathematics",
                        "Geography",
                        "Global Politics",
                        "History",
                        "Information Technology in a Global Society",
                        "Language A (English): Literature",
                        "Language A (English): Language and Literature",
                        "Language A (French): Literature",
                        "Language A (French): Language and Literature",
                        "Language A (Portuguese): Literature",
                        "Language A (Portuguese): Language and Literature",
                        "Language B",
                        "Language ab initio",
                        "Literature and Performance",
                        "Mandarin",
                        "Mathematical Studies",
                        "Mathematics",
                        "Mathematics: Analysis and Approaches",
                        "Mathematics: Applications and Interpretation",
                        "Music",
                        "Philosophy",
                        "Physics",
                        "Psychology",
                        "Social and Cultural Anthropology",
                        "Sports, Exercise and Health Science",
                        "Theatre",
                        "World Religions",
                        "Visual Arts",
                    ];
                    $this->createResponses($question, $responses);
                    break;
                case QuestionFormat::IGCSEGRADE():
                    $responses = [
                        "A*",
                        "A",
                        "B",
                        "C",
                        "D",
                        "E",
                        "F",
                        "G",
                        "U",
                        "9",
                        "8",
                        "7",
                        "6",
                        "5",
                        "4",
                        "3",
                        "2",
                        "1",
                    ];
                    $this->createResponses($question, $responses);
                    break;
                case QuestionFormat::LETTERGRADE():
                    $responses = [
                        "A",
                        "A-",
                        "B+",
                        "B",
                        "B-",
                        "C+",
                        "C",
                        "C-",
                        "D+",
                        "D",
                        "D-",
                        "E",
                        "F",
                    ];
                    $this->createResponses($question, $responses);
                    break;
            }
        }

        return Command::SUCCESS;
    }

    public function createResponses(Question $question, array $responses): void
    {
        foreach ($responses as $response) {
            $r = new Response();
            $r->text = $response;
            $r->question_id = $question->id;
            $r->save();
        }

        $question->format = QuestionFormat::SELECT();
        $question->save();
    }
}
