<?php

namespace App\Http\Controllers;

use App\Enums\General\YesNo;
use App\Enums\HighSchool\Type;
use Illuminate\Http\Request;
use App\Models\HighSchool;


class TypeaheadController extends Controller
{
    // https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/

    public function index()
    {
        return view('welcome');
    }

    public function autocompleteSearch(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            return;
        } else {
            $schools = HighSchool::select('id','name')->
                where('name', 'like', '%' .$search . '%')->
                whereNot('type', Type::ACCESS())->
                where('verified', YesNo::YES())->
                orderby('name','asc')->
                limit(5)->get();
        }

        $response = array();
        foreach ($schools as $school){
            $response[] = array(
                "value" => $school->id,
                "label" => $school->name,
            );
        }

        return response()->json($response);
    }

    public function autocompleteOrgSearch(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            return;
        } else {
            $schools = HighSchool::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->where('type', Type::ACCESS())->limit(5)->get();
        }

        $response = array();
        foreach ($schools as $school){
            $response[] = array(
                "value" => $school->id,
                "label" => $school->name,
            );
        }

        return response()->json($response);
    }
}
