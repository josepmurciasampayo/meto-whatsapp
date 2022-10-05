<?php

namespace App\Imports;

use App\Enums\Chat\Campaign;
use App\Models\Chat\MessageState;
use App\Models\Institution;
use App\Models\MatchStudentInstitution;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Matches
{
    public static function importFromGoogle(string $db) :int
    {
        $query = '
            select * from inst_student_relationships where imported = 0;
        ';
        $matches = DB::connection($db)->select($query);
        foreach ($matches as $match) {
            self::importMatch($match);
            $student = Student::where('student_id', $match->student_id);
            // TODO: check about phone owner or multiple numbers
            // MessageState::queueCampaign($student->user_id, Campaign::ENDOFCYCLE, 3);
            self::markImported($match, $db);
        }
        return 1;
    }

    private static function importMatch(\stdClass $matchDB) :void
    {
        $student = Student::where('google_id', $matchDB->student_id)->first();
        if (is_null($student)) {
            Log::channel('import')->error("Couldn't find student ID" . $matchDB->student_id);
            return;
        }
        $institution = Institution::where('google_id', $matchDB->institution_id)->first();
        if (is_null($institution)) {
            Log::channel('import')->error("Couldn't find institution ID" . $matchDB->institution_id);
            return;
        }
        $match = new MatchStudentInstitution();
        $match->student_id = $student->id;
        $match->institution_id = $institution->id;
        $match->created_at = $matchDB->date_connected;
        $match->save();
    }

    private static function markImported(\stdClass $match, string $db) :void
    {
        DB::connection($db)->update('
            update inst_student_relationships set imported = 1 where relationship_id = ' . $match->relationship_id . ';
        ');
    }
}
