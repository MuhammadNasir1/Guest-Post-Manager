<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Record;
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
                "sending_date" => "required",
                "amount" => "required",
                "currency" => "required",
                "payment_method" => "required",
                "website" => "required",
                "cust_name" => "nullable",
                "cust_email" => "nullable",
                "cust_phone_no" => "nullable",
                "description" => "nullable",
                "req_invoice_url" => "nullable",
            ]);


            $site = new Invoice;
            $site->invoice_no = $validatedData['invoice_no'];
            $site->sending_date = $validatedData['sending_date'];
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
            $site->req_invoice_url = $validatedData['req_invoice_url'];
            $site->invoice_status = "request";

            $site->save();

            return redirect()->route('siteData');
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function siteData(Request $request)
    {
        $userId = session('user_det')['user_id'];
        $users =  User::wherenot('role', 'admin')->get();
        if (session('user_det')['role'] == "admin") {


            if ($request->has('filter') & $request['filter'] !== "All") {
                $data = Invoice::where('user_id', $request['filter'])->get();
            } else if ($request->has('status') & $request['status'] !== "All") {
                $data = Invoice::where('status', $request['status'])->get();
            } else {

                $data = Invoice::all();
            }
        } else {
            if ($request->has('status') & $request['status'] !== "All") {
                $data = Invoice::where('status', $request['status'])->Where('user_id', $userId)->get();
            } else {

                $data = Invoice::where('user_id', $userId)->get();
            }
        }

        foreach ($data as $datas) {

            $user = $datas['user_id'];
            $userData = User::where('id', $user)->first();
            $datas->user = $userData;
        }
        $clients = Record::all();
        return view("request_invoice", compact('data', 'users', 'clients'));
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
            $invouceAmout =
                Invoice::where('transaction_id', $id)
                ->select('total_amount', 'paypal_no', 'received_Amount', 'invoice_url')
                ->first();
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
                "paypal_no" => "nullable",
                "received_amount" => "nullable",
                "invoice_url" => "nullable",
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
            $updateStatus->paypal_no =  $validatedData['paypal_no'];
            $updateStatus->received_amount =  $validatedData['received_amount'];
            $updateStatus->invoice_url =  $validatedData['invoice_url'];
            $updateStatus->update();
            return redirect('requestInvoice');
            // return response()->json(["success" => true,  "message" => "data get successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(["success" =>  false, "message" => $e->getMessage()], 500);
        }
    }

    public function updateInvoiceData($id)
    {
        $users =  User::wherenot('role', 'admin')->get();
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
        $clients = Record::all();
        return view("request_invoice", compact('data', 'Invoicedata',  'users', 'clients'));
    }
    public function viewInvoiceData($id)
    {

        $Invoicedata = Invoice::find($id);
        return response()->json(['data' => $Invoicedata]);
    }

    public function updateInvoice(Request $request, $id)
    {

        try {

            $validatedData = $request->validate([
                "invoice_no" => "required",
                "sending_date" => "required",
                "amount" => "required",
                "currency" => "required",
                "payment_method" => "required",
                "website" => "required",
                "cust_name" => "nullable",
                "cust_email" => "nullable",
                "cust_phone_no" => "nullable",
                "description" => "nullable",
                "req_invoice_url" => "nullable",
            ]);


            $site = Invoice::find($id);
            $site->invoice_no = $validatedData['invoice_no'];
            $site->sending_date = $validatedData['sending_date'];
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
            $site->req_invoice_url = $validatedData['req_invoice_url'];

            $site->update();

            return redirect('../requestInvoice');
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function addSendInvoiceData(Request $request) {}
}
