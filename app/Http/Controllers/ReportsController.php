<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ReportsController extends Controller
{
    // get data for Ledger
    public function getLedgerData(Request $request)
    {
        try {

            $userId = $request->input('customer_account');
            if ($request->has('customer_account')) {
                $transactionQuery = Transaction::where('user_id', $userId);

                if ($request->has('from_date') && $request->has('to_date')) {
                    try {
                        $fromDate = $request->input('from_date');
                        $toDate = $request->input('to_date');
                        $transactionQuery->whereBetween('created_at', [$fromDate, $toDate]);
                    } catch (\Exception $e) {
                        return response()->json(['error' => 'Invalid date format'], 400);
                    }
                }

                $transactionQuery = Transaction::where('user_id', $userId);
                $transactions = $transactionQuery->get();
                $userData = User::select('name', 'phone')->find($userId);

                // Return the transactions in the desired format, for example as a JSON response
                return response()->json(['success' => true, "message" => "Data get successfully", "data" => $transactions, "user" => $userData], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'customer_account is required'], 500);
            }

            // return response()->json(["data" => $transaction], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
