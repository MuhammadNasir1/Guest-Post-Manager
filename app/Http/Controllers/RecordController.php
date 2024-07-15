<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function addRecord(Request $request)
    {
        try {
            $validateData = $request->validate([
                "client_from" => "required",
                "client_name" => "required",
                "client_company" => "required",
                "client_email" => "required",
                "client_profile" => "required",
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

    public function view()
    {
        $data = Record::all();
        return view('records', compact("data"));
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
        return view("records", compact('updateData', 'data'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $validateData = $request->validate([
                "client_from" => "required",
                "client_name" => "required",
                "client_company" => "required",
                "client_email" => "required",
                "client_profile" => "required",
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
}
