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
                "ahrref_traffic" => "nullable",
                "traffic_major_from" => "nullable",
                "guest_post_price" => "nullable",
                "link_insertion_price" => "nullable",
                "exchange" => "nullable",
                "contact_no" => "nullable",
                "admin_gmail" => "nullable",
                "site_done_form" => "nullable",
                "dr" => "nullable",
                "da" => "nullable",
                "casino" => "nullable",
                "category" => "required",
                "guideline" => "nullable",
                "guest_post_crrency" => "nullable",
                "insertion_currency" => "nullable",
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
            $site->insertion_currency =  $validatedData['insertion_currency'];
            $site->guest_post_crrency =  $validatedData['guest_post_crrency'];

            $site->save();
            // return redirect("../addSite");
            return response()->json(['success' => true, 'message' => "Site add successfully"], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors()->toArray(),  // Send all validation errors with field names
            ], 422);
        }
    }


    protected function convertToNumeric($value)
    {
        if (strpos($value, 'k') !== false) {
            return (float) str_replace('k', '', $value) * 1000;
        }
        return (float) $value;
    }
    protected function convertToNumericPrice($value)
    {
        return (float) str_replace('$', '', $value);
    }
    public function getSite(Request $request)
    {

        $userId = session('user_det')['user_id'];
        $userRole = session('user_det')['role'];
        $users =  User::whereNot('role', 'admin')->get();
        $categories = Site::Select('category')->distinct()->get();
        $query = Site::query();
        if ($userRole == "admin" || $userRole == "manager") {
            $data = Site::all();
        } else {

            $query->where('user_id', $userId)->get();
        }


        if ($request->filled('filter') && $request->input('filter') !== 'All') {
            $query->where('user_id', $request->input('filter'));
        }

        if ($request->filled('category') && $request->input('category') !== 'All') {
            $query->where('category', $request->input('category'));
        }



        // if ($request->filled('max-price')) {
        //     $query->where('guest_post_price', '<=', $request->input('max-price'));
        // }

        // if ($request->filled('min-traffic')) {
        //     $query->where('traffic', '>=', $request->input('min-traffic'));
        // }

        // if ($request->filled('max-traffic')) {
        //     $query->where('traffic', '<=', $request->input('max-traffic'));
        // }
        if ($request->filled('max-price')) {
            $maxPrice = $this->convertToNumericPrice($request->input('max-price'));
            $query->whereRaw('CAST(REPLACE(guest_post_price, "$", "") AS DECIMAL(10,2)) <= ?', [$maxPrice]);
        }
        if ($request->filled('min-traffic')) {
            $minTraffic = $this->convertToNumeric($request->input('min-traffic'));
            $query->whereRaw('CAST(REPLACE(traffic, "k", "") AS UNSIGNED) * 1000 >= ?', [$minTraffic]);
        }

        if ($request->filled('max-traffic')) {
            $maxTraffic = $this->convertToNumeric($request->input('max-traffic'));
            $query->whereRaw('CAST(REPLACE(traffic, "k", "") AS UNSIGNED) * 1000 <= ?', [$maxTraffic]);
        }
        $data = $query->get();

        return view("addsites", compact('data', 'users', 'categories'));
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
        $users =  User::wherenot('role', 'admin')->get();
        return view("addsites", compact("site", "data", "users"));
    }

    public function updateSite(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                "website_url" => "required",
                "traffic" => "required",
                "semrush_traffic" => "required",
                "ahrref_traffic" => "nullable",
                "traffic_major_from" => "nullable",
                "guest_post_price" => "required",
                "link_insertion_price" => "required",
                "exchange" => "nullable",
                "contact_no" => "nullable",
                "admin_gmail" => "nullable",
                "site_done_form" => "nullable",
                "dr" => "nullable",
                "da" => "nullable",
                "casino" => "nullable",
                "category" => "required",
                "guideline" => "nullable",
                "guest_post_crrency" => "nullable",
                "insertion_currency" => "nullable",
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
            $site->insertion_currency =  $validatedData['insertion_currency'];
            $site->guest_post_crrency =  $validatedData['guest_post_crrency'];
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
                    'insertion_currency' => $row[7],
                    'dr' => $row[8],
                    'da' => $row[9],
                    'exchange' => $row[10],
                    'contact_no' => $row[11],
                    'casino' => $row[12],
                    'category' => $row[13],
                    'site_done_from' => $row[14],
                    'admin_gmail' => $row[15],
                    'guideline' => $row[16],
                ]);
            }

            return redirect()->back();
        } catch (\Exception $e) {

            // return redirect()->back();
            return response()->json($e->getMessage());
        }
    }
}
