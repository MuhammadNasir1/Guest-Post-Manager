<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

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

            $site->save();
            return redirect("../addSite");
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function getSite()
    {
        $userId = session('user_det')['user_id'];
        $userRole = session('user_det')['role'];
        if ($userRole == "admin" || $userRole == "manager") {


            $data = Site::all();
        } else {

            $data = Site::where('user_id', $userId)->get();
        }
        return view("addsites", compact('data'));
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
}
