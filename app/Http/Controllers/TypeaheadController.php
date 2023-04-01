<?php

namespace App\Http\Controllers;

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
            $schools = HighSchool::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
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
