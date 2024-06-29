<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Transaction;
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
            $userId = $request['customer_account'];
            // $invoice = Invoice::where('user_id', $userId)->get();
            $transaction = Transaction::where('user_id', $userId)->get();
            return response()->json(["data" => $transaction], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
