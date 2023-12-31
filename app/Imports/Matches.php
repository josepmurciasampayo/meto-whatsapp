<?php

namespace App\Imports;

use App\Models\Institution;
use App\Models\Student;
use App\Models\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Matches
{
    public static function importFromGoogle(string $db) :int
    {
        $matches = DB::connection($db)->select('
            select relationship_id, student_id, i.institution_id, inst_name from inst_student_relationships as i join institutions_table as u on i.institution_id = u.institution_id  where i.imported = 0;
        ');
        foreach ($matches as $match) {
            $student = Student::where('google_id', $match->student_id)->first();
            if (is_null($student)) {
                Log::channel('import')->error("Couldn't find student ID: " . $match->student_id);
                continue;
            }
            $institution = Institution::where('name', $match->inst_name)->first();
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
        Log::channel('import')->info('Imported ' . count($matches) . ' new student/university matches');
        return 1;
    }

    private static function checkDupe($student, $institution) :bool
    {

        $existing = DB::select('
            select id from meto_connections where student_id = ' . $student->id . ' and institution_id = ' . $institution->id . ';
        ');
        return count($existing) > 0;
    }

    private static function importMatch($student, $institution) :void
    {
        $match = new Connection();
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
