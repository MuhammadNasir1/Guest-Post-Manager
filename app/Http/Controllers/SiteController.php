<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiteController extends Controller
{
    public function siteAdd(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "website_url" => "required",
                "traffic" => "required",
                "semrush_traffic" => "required",
                "ahrref_traffic" => "required",
                "traffic_major_from" => "required",
                "guest_post_price" => "required",
                "link_insertion_price" => "required",
                "exchange" => "required",
                "contact_no" => "required",
                "admin_gmail" => "required",
                "site_done_form" => "required",
                "dr" => "required",
                "da" => "required",
                "casino" => "required",
                "category" => "required",
                "guideline" => "required",
                "insertion_currency" => "required",
            ]);

            $site = new Site;
            $site->user_id = session('user_det')['user_id'];
            $site->web_url = $validatedData['website_url'];
            $site->traffic = $validatedData['traffic'];
            $site->semrush_traffic = $validatedData['semrush_traffic'];
            $site->ahref_traffic = $validatedData['ahrref_traffic'];
            $site->traffic_from = $validatedData['traffic_major_from'];
            $site->guest_post_price = $validatedData['guest_post_price'];
            $site->link_insertion_price = $validatedData['link_insertion_price'];
            $site->exchange = $validatedData['exchange'];
            $site->contact_no = $validatedData['contact_no'];
            $site->admin_gmail = $validatedData['admin_gmail'];
            $site->site_done_from = $validatedData['site_done_form'];
            $site->dr = $validatedData['dr'];
            $site->da = $validatedData['da'];
            $site->casino = $validatedData['casino'];
            $site->category = $validatedData['category'];
            $site->guideline = $validatedData['guideline'];
            $site->insertion_currency = $validatedData['insertion_currency'];

            $site->save();
            return redirect("../addSite");
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function getSite(Request $request)
    {

        $userId = session('user_det')['user_id'];
        $userRole = session('user_det')['role'];
        $users =  User::wherenot('role', 'admin')->get();
        if ($userRole == "admin" || $userRole == "manager") {
            if ($request->has('filter') & $request['filter'] !== "All") {
                $data = Site::where('user_id', $request['filter'])->get();
            } else {

                $data = Site::all();
            }
        } else {

            $data = Site::where('user_id', $userId)->get();
        }
        return view("addsites", compact('data', 'users'));
    }

    public function updateData(string $id)
    {
        $userId = session('user_det')['user_id'];
        if (session('user_det')['role'] == "admin") {


            $data = Site::all();
        } else {

            $data = Site::where('user_id', $userId)->get();
        }
        $site = Site::find($id);
        return view("addsites", compact("site", "data"));
    }

    public function updateSite(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                "website_url" => "required",
                "traffic" => "required",
                "semrush_traffic" => "required",
                "ahrref_traffic" => "required",
                "traffic_major_from" => "required",
                "guest_post_price" => "required",
                "link_insertion_price" => "required",
                "exchange" => "required",
                "contact_no" => "required",
                "admin_gmail" => "required",
                "site_done_form" => "required",
                "dr" => "required",
                "da" => "required",
                "casino" => "required",
                "category" => "required",
                "guideline" => "required",
                "insertion_currency" => "required",
            ]);

            $site = Site::find($id);
            $site->user_id = session('user_det')['user_id'];
            $site->web_url = $validatedData['website_url'];
            $site->traffic = $validatedData['traffic'];
            $site->semrush_traffic = $validatedData['semrush_traffic'];
            $site->ahref_traffic = $validatedData['ahrref_traffic'];
            $site->traffic_from = $validatedData['traffic_major_from'];
            $site->guest_post_price = $validatedData['guest_post_price'];
            $site->link_insertion_price = $validatedData['link_insertion_price'];
            $site->exchange = $validatedData['exchange'];
            $site->contact_no = $validatedData['contact_no'];
            $site->admin_gmail = $validatedData['admin_gmail'];
            $site->site_done_from = $validatedData['site_done_form'];
            $site->dr = $validatedData['dr'];
            $site->da = $validatedData['da'];
            $site->casino = $validatedData['casino'];
            $site->category = $validatedData['category'];
            $site->guideline = $validatedData['guideline'];
            $site->insertion_currency = $validatedData['insertion_currency'];
            $site->update();
            return redirect("../addSite");
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function delSite($id)
    {

        $site = Site::find($id);
        $site->delete();

        return redirect('../addSite');
    }


    public function importsite(Request $request)
    {
        try {

            // Validate the uploaded file
            $validateData = $request->validate([
                'excel_file' => 'required|mimes:xlsx,xls',
            ]);

            // Get the uploaded file
            $file = $request->file('excel_file');

            // Convert the Excel data to an array
            $data = Excel::toArray([], $file);

            // Start the loop from the second row to skip the header
            foreach (array_slice($data[0], 1) as $row) {
                Site::create([
                    'user_id' => session('user_det')['user_id'],
                    'web_url' => $row[0],
                    'traffic' => $row[1],
                    'semrush_traffic' => $row[2],
                    'ahref_traffic' => $row[3],
                    'traffic_from' => $row[4],
                    'guest_post_price' => $row[5],
                    'link_insertion_price' => $row[6],
                    'dr' => $row[7],
                    'da' => $row[8],
                    'exchange' => $row[9],
                    'contact_no' => $row[10],
                    'casino' => $row[11],
                    'category' => $row[12],
                    'site_done_from' => $row[13],
                    'admin_gmail' => $row[14],
                    'guideline' => $row[15],
                ]);
            }

            return redirect()->back();
        } catch (\Exception $e) {

            // return redirect()->back();
            return response()->json($e->getMessage());
        }
    }
}
