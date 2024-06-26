<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Invoice;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function addTransaction(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                "status_update" => "required",
                "total_amount" => "nullable",
                "payable_amount" => "nullable",
                "note" => "nullable",
            ]);

            // return $request;
            $updateStatus = Invoice::find($id);
            $updateStatus->status = $validatedData['status_update'];
            $updateStatus->update();


            $transaction = new Transaction;
            $transaction->user_id = $request->user_id;
            $transaction->transaction_remarks = $validatedData['note'];
            $transaction->credit = $validatedData['payable_amount'];
            $transaction->debit = "null";
            $transaction->balance = "null";
            $transaction->transaction_date = "null";
            $transaction->transaction_type = "null";
            $transaction->transaction_form = "null";
            $transaction->save();

            return redirect('requestInvoice');
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }
}
