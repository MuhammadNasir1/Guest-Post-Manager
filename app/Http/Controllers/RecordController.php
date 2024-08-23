<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function addRecord(Request $request)
    {
        try {
            $validateData = $request->validate([
                "client_from" => "required",
                "client_name" => "required",
                "client_company" => "nullable",
                "client_email" => "nullable",
                "client_profile" => "nullable",
                "client_contact" => "required",
            ]);

            $record = new Record;
            $record->user_id = session('user_det')['user_id'];
            $record->client_from = $validateData['client_from'];
            $record->client_name = $validateData['client_name'];
            $record->client_company = $validateData['client_company'];
            $record->client_email = $validateData['client_email'];
            $record->client_profile = $validateData['client_profile'];
            $record->client_contact = $validateData['client_contact'];
            $record->save();

            return redirect('../customer');
        } catch (\Exception $error) {
            return response()->json(['success' => false, 'message' => $error->getMessage()]);
        }
    }

    public function view(Request $request)
    {

        $userId = session('user_det')['user_id'];
        $userRole = session('user_det')['role'];
        $users =  User::wherenot('role', 'admin')->get();

        if ($userRole == "admin" || $userRole == "manager") {
            if ($request->has('filter') & $request['filter'] !== "All") {
                $data = Record::where('user_id', $request['filter'])->get();
            } else {

                $data = Record::all();
            }
        } else {

            $data = Record::where('user_id', $userId)->get();
        }
        return view('records', compact("data", "users"));
    }

    public function deleteRecord(string $id)
    {
        $delRecord = Record::find($id);
        $delRecord->delete();
        return redirect()->back();
    }

    public function getForUpdate(string $id)
    {
        $updateData = Record::find($id);
        $data = Record::all();
        $users =  User::wherenot('role', 'admin')->get();
        return view("records", compact('updateData', 'data', 'users'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $validateData = $request->validate([
                "client_from" => "required",
                "client_name" => "required",
                "client_company" => "nullable",
                "client_email" => "nullable",
                "client_profile" => "nullable",
                "client_contact" => "required",
            ]);

            $record = Record::find($id);
            $record->user_id = session('user_det')['user_id'];
            $record->client_from = $validateData['client_from'];
            $record->client_name = $validateData['client_name'];
            $record->client_company = $validateData['client_company'];
            $record->client_email = $validateData['client_email'];
            $record->client_profile = $validateData['client_profile'];
            $record->client_contact = $validateData['client_contact'];
            $record->update();

            return redirect('../customer');
        } catch (\Exception $error) {
            return response()->json(['success' => false, 'message' => $error->getMessage()]);
        }
    }

    public function getSelectedData($id)
    {

        try {

            $clientData = Record::find($id);
            return response()->json(['data' => $clientData], 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
