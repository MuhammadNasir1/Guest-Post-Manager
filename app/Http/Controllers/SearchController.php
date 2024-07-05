<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public  function Search(Request $request)
    {
        try {
            $query = $request->input('query');
            $results = Site::where('web_url', 'LIKE', '%' . $query . '%')->get();
            if(!$results){
                $results = Site::orderBy('id')->take(5)->get();
            }
            return response()->json(['success' => false , 'error' => "Data get successfully" , 'data' => $results], 500);
        }   catch (\Exception $e) {
            return response()->json(['success' => false , 'error' => $e->getMessage() ], 500);

        }
    }
}
