<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function addCompany(Request $request)
    {

        $company = new Company;

        if ($request->hasFile('upload_image')) {
            $upload_image = $request->file('upload_image');
            $name = time() . '.' . $upload_image->getClientOriginalExtension();
            $upload_image->storeAs('public/company_logo', $name);
            $company->logo = 'storage/company_logo/' . $name;
        }
        $company->name = $request->company_name;
        $company->phone_no = $request->company_phone;
        $company->email_or_website = $request->email_or_website;
        $company->primary_color = $request->primary_color;
        $company->secondary_color = $request->secondary_color;
        $company->personal_no = $request->personal_no;
        $company->ntn = $request->company_ntn;
        $company->address = $request->company_address;
        $company->personal_no = $request->personal_no;

        $company->save();
        return redirect('company');
    }
}
