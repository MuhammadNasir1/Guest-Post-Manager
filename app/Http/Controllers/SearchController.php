<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public  function Search(Request $request)
    {
        try {
            $query = $request->input('query');
            $results = Site::where('web_url', 'LIKE', '%' . $query . '%')->get();
            if (!$results) {
                $results = Site::orderBy('id')->take(5)->get();
            }
            return response()->json(['success' => true, 'message' => "Data get successfully", 'data' => $results], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function siteData($siteId)
    {
        try {

            $data = Site::find($siteId);
            $user_name  = User::select('name')->where('id', $data->user_id)->first();
            $data->userName = $user_name;
            return response()->json(['success' => true, 'message' => "Data get successfully", 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
