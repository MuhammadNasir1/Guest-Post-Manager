<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Voucher;
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


            $transaction = new Transaction;

            $transaction->user_id = $request->user_id;
            $transaction->transaction_remarks = $validatedData['note'];
            $transaction->credit = $validatedData['payable_amount'];
            $transaction->debit = 0;
            $transaction->balance = 0;
            $transaction->transaction_type = 0;
            $transaction->transaction_form = 0;

            $transaction->save();


            $updateStatus = Invoice::find($id);
            $updateStatus->status = $validatedData['status_update'];
            $updateStatus->transaction_id =  $transaction->id;
            $updateStatus->update();
            return redirect('requestInvoice');
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function getData()
    {
        $data = Transaction::all();
        $users = User::all();
        return view("reports", compact("data", "users"));
    }


    public function deleteTransaction($id)
    {
        $transaction = Transaction::find($id);
        $vouchers  = Voucher::where('transaction_id',  $id)->get();
        foreach ($vouchers  as $voucher) {
            $voucher->delete();
        }
        $transaction->delete();

        return redirect('transactionVoucher');
    }

    public function editVoucher(Request $request, string $id)
    {
        $validatedData = $request->validate([
            "date" => "required",
            "account" => "required",
            "voucher_type" => "required",
            "hint" => "nullable",
        ]);

        $transaction = Transaction::find($id);

        $transaction->user_id = $validatedData['account'];
        $transaction->transaction_remarks = $validatedData['hint'];
        $transaction->credit = $request->credit;
        $transaction->debit =  $request->debit;
        $transaction->balance = 0;
        $transaction->transaction_type = $validatedData['voucher_type'];
        $transaction->transaction_form = "voucher";

        $transaction->save();

        $voucher = Voucher::Where('transaction_id', $id)->first();
        // $voucher = new Voucher;
        $voucher->date = $validatedData['date'];
        $voucher->user_id = $validatedData['account'];
        $voucher->voucher_type = $validatedData['voucher_type'];
        $voucher->credit = $request->credit;
        $voucher->debit = $request->debit;
        $voucher->hint = $validatedData['hint'];
        $voucher->save();
        return response()->json("data updated");
    }
    // get update dataz

    public function transctionData($id)
    {
        $transaction = Transaction::find($id);
        $voucher = Voucher::find($id);
        $user = User::all();
        $data = Voucher::all();

        return view('transaction_voucher', compact('transaction', 'voucher', 'user', 'data'));
    }
}
