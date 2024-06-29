<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ReportsController extends Controller
{
    // get data for Ledger
    public function getLedgerData(Request $request)
    {
        try {

            if ($request->has('customer_account')) {
            }

            return response()->json(["data" => "ldsk"], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
