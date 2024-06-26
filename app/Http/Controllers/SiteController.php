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
            $site->save();
            return redirect("../addSite");
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()]);
        }
    }

    public function getSite()
    {
        $data = Site::all();
        return view("addsites", compact('data'));
    }
}
