<?php

namespace App\Imports;

use App\Models\Institution;
use App\Models\Student;
use App\Models\StudentUniversity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Matches
{
    public static function importFromGoogle(string $db) :int
    {
        $matches = DB::connection($db)->select('
            select * from inst_student_relationships where imported = 0;
        ');
        foreach ($matches as $match) {
            $student = Student::where('google_id', $match->student_id)->first();
            if (is_null($student)) {
                Log::channel('import')->error("Couldn't find student ID: " . $match->student_id);
                continue;
            }
            $institution = Institution::where('google_id', $match->institution_id)->first();
            if (is_null($institution)) {
                Log::channel('import')->error("Couldn't find institution ID: " . $match->institution_id);
                continue;
            }

            if (self::checkDupe($student, $institution)) {
                self::markImported($match, $db);
                continue;
            }
            self::importMatch($student, $institution);
            // TODO: check about phone owner or multiple numbers
            // $student = Student::where('student_id', $match->student_id);
            // MessageState::queueCampaign($student->user_id, Campaign::ENDOFCYCLE, 3);
            self::markImported($match, $db);
        }
        return 1;
    }

    private static function checkDupe($student, $institution) :bool
    {
        $existing = DB::select('
            select id from meto_students_universities where student_id = ' . $student->id . ' and institution_id = ' . $institution->id . ';
        ');
        return count($existing) > 0;
    }

    private static function importMatch($student, $institution) :void
    {
        $match = new StudentUniversity();
        $match->student_id = $student->id;
        $match->institution_id = $institution->id;
        $match->save();
    }

    private static function markImported(\stdClass $match, string $db) :void
    {
        DB::connection($db)->update('
            update inst_student_relationships set imported = 1 where relationship_id = ' . $match->relationship_id . ';
        ');
    }
}
