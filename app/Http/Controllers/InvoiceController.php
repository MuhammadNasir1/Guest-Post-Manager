<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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

            $site->save();

            return redirect()->route('siteData');
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function siteData()
    {
        $data = Invoice::all();

        foreach ($data as $datas) {

            $user = $datas['user_id'];
            $userData = User::where('id', $user)->first();
            $datas->user = $userData;
        }

        return view("request_invoice", compact('data'));
    }
}
