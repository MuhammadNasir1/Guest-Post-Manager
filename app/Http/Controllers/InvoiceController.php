<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Record;
use App\Models\SendingInvoice;
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



            if ($request['type'] == "sending") {
                // if ($request->has('filter') && $request['filter'] !== "All") {
                //     $sendInvoice = SendingInvoice::where("user_id", $request['filter'])->get();
                // }
                // if ($request->has('status') &&  $request['status'] !== "All") {
                //     $sendInvoice = SendingInvoice::where('status', $request['status'])->get();
                // }
                $sendInvoice = SendingInvoice::when(
                    $request->has('filter') && $request['filter'] !== "All",
                    function ($query) use ($request) {
                        return $query->where("user_id", $request['filter']);
                    }
                )->when(
                    $request->has('status') && $request['status'] !== "All",
                    function ($query) use ($request) {
                        return $query->where('status', $request['status']);
                    }
                )->get();
            } else {

                $sendInvoice = SendingInvoice::all();
            }
            $data = Invoice::when(
                $request->has('filter') && $request->input('filter') !== "All",
                function ($query) use ($request) {
                    return $query->where('user_id', $request->input('filter'));
                }
            )->when(
                $request->has('status') && $request->input('status') !== "All",
                function ($query) use ($request) {
                    return $query->where('status', $request->input('status'));
                }
            )->get();






            $clients = Record::all();
        } else {
            if ($request->has('status') & $request['status'] !== "All") {
                $clients = Record::where('user_id', $userId)->get();
                $data = Invoice::where('status', $request['status'])->Where('user_id', $userId)->get();
                $sendInvoice = SendingInvoice::where('status', $request['status'])->Where('user_id', $userId)->get();
            } else {
                $clients = Record::where('user_id', $userId)->get();
                $data = Invoice::where('user_id', $userId)->get();
                $sendInvoice = SendingInvoice::where('user_id', $userId)->get();
            }
        }

        foreach ($data as $datas) {

            $user = $datas['user_id'];
            $userData = User::where('id', $user)->first();
            $datas->user = $userData;
        }
        // return response()->json($data);
        return view("request_invoice", compact('data', 'users', 'clients', 'sendInvoice'));
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
            $clients = Record::all();
            $data = Invoice::all();
        } else {
            $clients = Record::where('user_id', $userId)->get();
            $data = Invoice::where('user_id', $userId)->get();
        }

        foreach ($data as $datas) {

            $user = $datas['user_id'];
            $userData = User::where('id', $user)->first();
            $datas->user = $userData;
        }
        $Invoicedata = Invoice::find($id);

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

    public function addSendInvoiceData(Request $request)
    {
        try {

            $validatedData = $request->validate([

                "user_id" => 'nullable',
                "invoice_no" => 'nullable',
                "sending_date" => 'nullable',
                "amount" => 'required',
                "payment_method" => 'required',
                "website" => 'required',
                "invoice_url" => 'required',
                "pkr_amount" => 'nullable',
                "bank_name" => 'nullable',
                "Transaction_id" => 'nullable',
            ]);

            $send_invoice = SendingInvoice::create([
                "user_id" => session('user_det')['user_id'],
                "invoice_no" => $validatedData['invoice_no'],
                "sending_date" => $validatedData['sending_date'],
                "amount" => $validatedData['amount'],
                "payment_method" => $validatedData['payment_method'],
                "website" => $validatedData['website'],
                "invoice_url" => $validatedData['invoice_url'],
                "pkr_amount" => $validatedData['pkr_amount'],
                "bank_name" => $validatedData['bank_name'],
                "Transaction_id" => $validatedData['Transaction_id'],


            ]);
            return redirect('../requestInvoice?type=sending');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function changeSendingStatus(Request $request,  $id)
    {
        try {
            $send_invoice = SendingInvoice::find($id);
            $send_invoice->status = $request['status'];
            $send_invoice->update();
            return response()->json(['success' => true, 'message' => "Status update successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
