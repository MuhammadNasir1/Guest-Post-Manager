<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Site;
use App\Models\Transaction;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class userController extends Controller
{


    public function language_change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return redirect()->back();
    }
    // dashboard  Users Couny
    public function users()
    {
        $users =  User::where('role', 'seller')->orWhere('role', 'manager')->get();
        return view('users', ['users'  => $users]);
    }

    public function  addCustomer(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone_no' => 'required',
                'address' => 'required',
                'user_id' => 'required'
            ]);
            $customer =  User::create([
                'user_id' => $validateData['user_id'],
                'name' => $validateData['name'],
                'email' => $validateData['email'],
                'password' => Hash::make(12345678),
                'phone' => $validateData['phone_no'],
                'role' => "customer",
                'address' => $validateData['address'],
            ]);

            return response()->json(['success' => true, 'message' => "Customer Add Successfully"]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }
    public function  addAdminCustomer(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone_no' => 'required',
                'address' => 'required',
            ]);
            $customer =  User::create([
                'name' => $validateData['name'],
                'email' => $validateData['email'],
                'password' => Hash::make(12345678),
                'phone' => $validateData['phone_no'],
                'role' => "customer",
                'address' => $validateData['address'],
                'tax_number' => $request['tax_number'],
                'client_type' => $request['client_type'],
                'postal_code' => $request['postal_code'],
                'city' => $request['city'],
                'note' => $request['note'],
            ]);

            return response()->json(['success' => true, 'message' => "Customer Add Successfully"]);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }
    }

    public function delCustomer($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        return redirect('customers');
    }
    public function CustomerUpdateData($user_id)
    {
        try {

            $customer = User::find($user_id);
            return response()->json(['success' => true,  'message' => "Data  Get Successfully", 'customer' => $customer]);
        } catch (\Exception $e) {
            return response()->json(['success' => false,  'message' => $e->getMessage()]);
        }
    }
    public function CustomerUpdate(Request $request, $user_id)
    {
        try {

            $customer = User::find($user_id);

            $validatedData = $request->validate([
                'name' => 'nullable',
                'email' => 'nullable',
                'phone_no' => 'nullable',
                'address' => 'nullable',
            ]);

            $customer->name = $validatedData['name'];
            $customer->phone = $validatedData['phone_no'];
            $customer->email = $validatedData['email'];
            $customer->address = $validatedData['address'];
            $customer->update();
            return response()->json(['success' => true,  'message' => "Data  Get Successfully", 'customer' => $customer]);
        } catch (\Exception $e) {
            return response()->json(['success' => false,  'message' => $e->getMessage()]);
        }
    }

    public function getCustomer()
    {

        try {
            $customers =  User::where('role', "customer")->get();
            return response()->json(['success' => true,  'message' => "Customer get successfully ", 'customers' => $customers]);
        } catch (\Exception $e) {
            return response()->json(['success' => false,  'message' => $e->getMessage()]);
        }
    }


    public function Dashboard()
    {
        $dasboard_data = [];
        $user_id = session('user_det')['user_id'];
        $invoice_chart = [];

        if (session('user_det')['role'] == "admin") {
            $total_user = User::whereNotIn('role', ['admin'])->count();
            $total_sites = Site::all()->count();
            $total_invoices = Invoice::all()->count();
            $invoice_chart['pending']  = Invoice::where('status', 'pending')->get()->count();
            $invoice_chart['approved']  = Invoice::where('status', 'approved')->get()->count();
            $invoice_chart['processing']  = Invoice::where('status', 'processing')->get()->count();

            $sevenDaysAgo = Carbon::now()->subDays(7);
            // Fetch transactions from the last 7 days
            $transactions = Transaction::where('created_at', '>=', $sevenDaysAgo)
                ->orderBy('created_at', 'asc')
                ->get();
            // return response()->json($transactions);

            // $transactionData = $transactions->map(function ($transaction) {
            //     return [
            //         'date' => $transaction->created_at->format('Y-m-d'),
            //         'credit' => $transaction->credit,
            //         'debit' => $transaction->debit,
            //     ];
            // });
            // Group transactions by date and sum credit and debit
            $transactionData = $transactions->groupBy(function ($transaction) {
                return $transaction->created_at->format('Y-m-d');
            })->map(function (Collection $dailyTransactions) {
                $date = $dailyTransactions->first()->created_at;
                $formattedDate = $date->format('Y') . ', ' . $date->format('n') . ', ' . $date->format('j');
                return [
                    'date' => $formattedDate,
                    // 'date' => $dailyTransactions->first()->created_at->format('Y-n-j'),
                    'total_credit' => $dailyTransactions->sum('credit'),
                    'total_debit' => $dailyTransactions->sum('debit'),
                ];
            })->values(); // Use values() to reset the keys

            // return response()->json($transactionData);


            // return response()->json($transactions);
        } else {
            $total_sites = Site::Where('user_id', $user_id)->get()->count();
            $total_user = User::whereNotIn('role', ['admin'])->count();
            $total_invoices = Invoice::where('user_id', $user_id)->count();
        }


        $dasboard_data['total_user'] = $total_user;
        $dasboard_data['total_sites'] = $total_sites;
        $dasboard_data['total_invoices'] = $total_invoices;
        $dasboard_data['invoice_chart'] = $invoice_chart;



        return view('dashboard', compact('dasboard_data', 'transactionData'));
    }

    public function changeVerifictionStatus(Request $request, $user_id)
    {


        try {
            $validatedData = $request->validate([
                'verification' => 'required|string', // Add more validation rules as needed
            ]);
            $user =   User::find($user_id);
            $user->verification = $validatedData['verification'];
            $user->save();

            return response()->json(['success' => true, 'message' => "User Status successfull Update"], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteUser(string $id)
    {
        $del = User::find($id);
        $del->delete();
        return redirect("../users");
    }

    public function updateUser(string $id)
    {
        $users =  User::where('role', 'seller   ')->get();
        $user = User::find($id);
        return view("users", compact("user", "users"));
    }

    public function updateUserCar(Request $request, $id)
    {

        try {

            $validatedData = $request->validate([
                'name' => 'required|string',
                'role' => 'nullable',
            ]);

            if ($request->has('password'))

                $user = User::find($id);
            $user->name = $validatedData['name'];
            $user->role = $validatedData['role'];


            if ($request->has('email')) {
                $user->email = $request['email'];
            }
            if ($request->has('password')) {
                $user->password = Hash::make($request['password']);
            }


            if ($request->hasFile('upload_image')) {
                $image = $request->file('upload_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/user_images', $imageName); // Adjust storage path as needed
                $user->user_image = 'storage/user_images/' . $imageName;
            }
            $user->update();
            return redirect('../users');
        } catch (\Exception $e) {

            return redirect('../users');
        }
    }
}
