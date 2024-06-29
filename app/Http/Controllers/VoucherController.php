<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function addVoucher(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "date" => "required",
                "account" => "required",
                "voucher_type" => "required",
                "hint" => "nullable",
            ]);

            $voucher = new Voucher;
            $voucher->transaction_id = 1;
            $voucher->date = $validatedData['date'];
            $voucher->user_id = $validatedData['account'];
            $voucher->voucher_type = $validatedData['voucher_type'];
            $voucher->credit = $request->credit;
            $voucher->debit = $request->debit;
            $voucher->hint = $validatedData['hint'];
            $voucher->save();

            return redirect('../transactionVoucher');
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function getUser()
    {
        $user = User::all();
        $data = Voucher::all();

        return view('transaction_voucher', compact('user', 'data'));
    }

    public function printVoucher(string $id)
    {
        $print = Voucher::find($id);
        return view('print_voucher', compact('print'));
    }
}
