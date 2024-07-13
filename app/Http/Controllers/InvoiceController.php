<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function addSite(Request $request)
    {

        try {

            $validatedData = $request->validate([
                "invoice_no" => "required",
                "amount" => "required",
                "currency" => "required",
                "payment_method" => "required",
                "website" => "required",
                "cust_name" => "required",
                "cust_email" => "required",
                "cust_phone_no" => "required",
                "description" => "required",
            ]);


            $site = new Invoice;
            $site->invoice_no = $validatedData['invoice_no'];
            $site->user_id = session('user_det')['user_id'];
            $site->amount = $validatedData['amount'];
            $site->currency = $validatedData['currency'];;
            $site->payment_method = $validatedData['payment_method'];
            $site->website = $validatedData['website'];
            $site->status = "pending";
            $site->cust_name = $validatedData['cust_name'];
            $site->cust_email = $validatedData['cust_email'];
            $site->cust_phone_no = $validatedData['cust_phone_no'];
            $site->description = $validatedData['description'];

            $site->save();

            return redirect()->route('siteData');
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function siteData()
    {
        $userId = session('user_det')['user_id'];
        if (session('user_det')['role'] == "admin") {
            $data = Invoice::all();
        } else {
            $data = Invoice::where('user_id', $userId)->get();
        }

        foreach ($data as $datas) {

            $user = $datas['user_id'];
            $userData = User::where('id', $user)->first();
            $datas->user = $userData;
        }

        return view("request_invoice", compact('data'));
    }


    public function getInvoiceStatus(string $id)
    {
        try {
            $InvoiceStatus = Invoice::where('id', $id)->pluck('status')->first();
            return response()->json(["success" => true,  "status" => $InvoiceStatus], 200);
        } catch (\Exception $e) {
            return response()->json(["success" =>  false, "message" => $e->getMessage()], 500);
        }
    }

    public function getInvoiceTransData($id)
    {
        try {
            $InvoiceTrans = Transaction::where('id', $id)->first();
            $invouceAmout = Invoice::where('transaction_id', $id)->pluck('total_amount')->first();
            return response()->json(["success" => true,  "data" => $InvoiceTrans, "invouceAmout" => $invouceAmout], 200);
        } catch (\Exception $e) {
            return response()->json(["success" =>  false, "message" => $e->getMessage()], 500);
        }
    }

    public function updateTransStatus(Request $request, $id)
    {

        try {

            $validatedData = $request->validate([
                "status_update" => "required",
                "total_amount" => "nullable",
                "payable_amount" => "nullable",
                "note" => "nullable",
            ]);


            $transaction = Transaction::find($id);

            $transaction->user_id = $request->user_id;
            $transaction->transaction_remarks = $validatedData['note'];
            $transaction->credit = $validatedData['payable_amount'];
            $transaction->debit = 0;
            $transaction->balance = 0;
            $transaction->transaction_type = 0;
            $transaction->transaction_form = "invoice";

            $transaction->save();


            $updateStatus = Invoice::where('transaction_id',  $id)->first();
            $updateStatus->status = $validatedData['status_update'];
            $updateStatus->transaction_id =  $transaction->id;
            $updateStatus->total_amount =  $validatedData['total_amount'];
            $updateStatus->payable_amount =  $validatedData['payable_amount'];
            $updateStatus->update();
            return redirect('requestInvoice');
            // return response()->json(["success" => true,  "message" => "data get successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(["success" =>  false, "message" => $e->getMessage()], 500);
        }
    }

    public function updateInvoiceData($id)
    {

        $userId = session('user_det')['user_id'];
        if (session('user_det')['role'] == "admin") {
            $data = Invoice::all();
        } else {
            $data = Invoice::where('user_id', $userId)->get();
        }

        foreach ($data as $datas) {

            $user = $datas['user_id'];
            $userData = User::where('id', $user)->first();
            $datas->user = $userData;
        }
        $Invoicedata = Invoice::find($id);
        return view("request_invoice", compact('data', 'Invoicedata'));
    }

    public function updateInvoice(Request $request, $id)
    {

        try {

            $validatedData = $request->validate([
                "invoice_no" => "required",
                "amount" => "required",
                "currency" => "required",
                "payment_method" => "required",
                "website" => "required",
                "cust_name" => "required",
                "cust_email" => "required",
                "cust_phone_no" => "required",
                "description" => "required",
            ]);


            $site = Invoice::find($id);
            $site->invoice_no = $validatedData['invoice_no'];
            $site->user_id = session('user_det')['user_id'];
            $site->amount = $validatedData['amount'];
            $site->currency = $validatedData['currency'];;
            $site->payment_method = $validatedData['payment_method'];
            $site->website = $validatedData['website'];
            $site->status = "pending";
            $site->cust_name = $validatedData['cust_name'];
            $site->cust_email = $validatedData['cust_email'];
            $site->cust_phone_no = $validatedData['cust_phone_no'];
            $site->description = $validatedData['description'];

            $site->update();

            return redirect('../requestInvoice');
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }
}
