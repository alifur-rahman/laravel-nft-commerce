<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CompanySettingsController extends Controller
{
    public function companySettings()
    {
        $company_infos = CompanyInfo::all()->first();
        return view('admin.settings.company-settings', compact('company_infos'));
    }

    public function companyInfoUpdate(Request $request)
    {
        if ($request->ajax()) {
            $validation_rules = [
                'com_logo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
                'com_name' => 'required|max:100',
                'com_license' => 'required|max:100',
                'com_email' => 'required|email',
                'com_phone' => 'required|max:20',
                'com_website' => 'required',
                'com_authority' => 'required|max:50',
                'com_address' => 'required|max:100',
                'copyright' => 'required',
                'support_email' => 'required',
                'auto_email' => 'required',
            ];
            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) {
                return Response::json([
                    'status' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Please fix the following errors!'
                ]);
            } else {
                $company_infos = CompanyInfo::where('id', 1)->first();
                if ($company_infos) {
                    if ($request->file('com_logo') != null) {
                        if (file_exists(public_path('assets/admin/logo/'.$company_infos->com_logo))) {
                            unlink(public_path('assets/admin/logo/'.$company_infos->com_logo));
                        }
                        $com_logo = $request->file('com_logo');
                        $com_logo_name = date('YmdHi').$com_logo->getClientOriginalName();
                        $com_logo->move(public_path('assets/admin/logo'), $com_logo_name);
                    }
                    $company_info = $company_infos->update([
                        'com_logo' => $com_logo_name,
                        'com_name' => $request->com_name,
                        'com_license' => $request->com_license,
                        'com_email' => $request->com_email,
                        'com_phone' => $request->com_phone,
                        'com_website' => $request->com_website,
                        'com_authority' => $request->com_authority,
                        'com_address' => $request->com_address,
                        'copyright' => $request->copyright,
                        'support_email' => $request->support_email,
                        'auto_email' => $request->auto_email,
                    ]);
                    if ($company_info) {
                        return Response::json([
                            'status' => true,
                            'message' => 'Company Info Added Successfully!'
                        ]);
                    }
                } else {
                    $com_logo = $request->file('com_logo');
                    $com_logo_name = date('YmdHi').$com_logo->getClientOriginalName();
                    $com_logo->move(public_path('assets/admin/logo'), $com_logo_name);
                    $company_info_create = CompanyInfo::create([
                        'com_logo' => $com_logo_name,
                        'com_name' => $request->com_name,
                        'com_license' => $request->com_license,
                        'com_email' => $request->com_email,
                        'com_phone' => $request->com_phone,
                        'com_website' => $request->com_website,
                        'com_authority' => $request->com_authority,
                        'com_address' => $request->com_address,
                        'copyright' => $request->copyright,
                        'support_email' => $request->support_email,
                        'auto_email' => $request->auto_email,
                    ]);
                    if ($company_info_create) {
                        return Response::json([
                            'status' => true,
                            'message' => 'Company Info Added Successfully!'
                        ]);
                    }
                }
            }
        }
    }

    public function socialInfo(Request $request)
    {
        if ($request->ajax()) {
            $validation_rules = [
                'facebook' => 'nullable|url|max:100',
                'instagram' => 'nullable|url|max:100',
                'github' => 'nullable|url|max:100',
                'twitter' => 'nullable|url|max:100',
                'linkedin' => 'nullable|url|max:100',

            ];
            $validator = Validator::make($request->all(), $validation_rules);

            if ($validator->fails()) {
                return Response::json([
                    'status' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Please fix the following errors!'
                ]);
            } else {
                $social = [];
                $social['facebook'] = $request->facebook;
                $social['instagram'] = $request->instagram;
                $social['github'] =$request->github;
                $social['twitter'] = $request->twitter;
                $social['linkedin'] = $request->linkedin;
                $social = json_encode($social);

                $data = CompanyInfo::where('id', 1)->update([
                    'com_social_info' => $social
                ]);

                if ($data) {
                    return Response::json([
                        'status' => true,
                        'message' => 'Social Info Added Successfully!'
                    ]);
                }
            }
        }

        $social_infos = CompanyInfo::all()->first();
        $social_info= json_decode($social_infos->com_social_info);

        return view('admin.settings.company-social-info', compact('social_info'));
    }
}
