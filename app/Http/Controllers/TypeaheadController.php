<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TypeaheadController extends Controller
{
    // https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/

    public function index()
    {
        return view('welcome');
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        // $filterResult = User::where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
    }
}
