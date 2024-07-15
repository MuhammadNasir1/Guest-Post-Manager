<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        return view('dashboard');
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
