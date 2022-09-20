<?php

namespace App\Imports;

use App\Models\Institution;
use App\Models\MatchStudentInstitution;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Matches
{
    public static function importMatchesFromGoogle()
    {
        $query = '
            select * from inst_student_relationships where imported = 0;
        ';
        $matches = DB::connection('google')->select($query);
        foreach ($matches as $match) {
            self::importMatch($match);
            //self::markImported($match);
        }
        return 0;
    }

    private static function importMatch(\stdClass $matchDB) :void
    {
        $student = Student::where('google_db_id', $matchDB->student_id)->first();
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

    private static function markImported($match) :void
    {
        DB::connection('google')->update('
            update inst_student_relationships set imported = 1 where relationship_id = ' . $match->relationship_id . ';
        ');
    }
}
