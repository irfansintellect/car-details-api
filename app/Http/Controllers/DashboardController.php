<?php

namespace App\Http\Controllers;

use App\Models\Pcp;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia('Dashboard', [
            'quries' => Pcp::orderBy('id', 'desc')->paginate(50),
        ]);
    }

    public function setting()
    {

        return Inertia('Setting', [
            'setting' => Setting::first(),
        ]);
    }

    public function settingUpdate(Request $request)
    {
        $request->validate([
            'logo_white' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'logo_black' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'companyName' => 'required',
            'companyEmail' => 'nullable|email',
            'companyPhone' => 'nullable|numeric',
        ]);

        $setting = Setting::first();

        $setting->update([
            'company_name' => $request->companyName,
            'company_email' => $request->companyEmail,
            'company_phone' => $request->companyPhone,
        ]);

        if ($request->hasFile('logo_white')) {
            $path = $request->file('logo_white')->store('logo-white', 'public');
            if ($setting->logo_white) {
                Storage::disk('public')->delete($setting->logo_white);
            }
            $setting->update(['logo_white' => $path]);
        }
        if ($request->hasFile('logo_black')) {
            $path = $request->file('logo_black')->store('logo-black', 'public');
            if ($setting->logo_black) {
                Storage::disk('public')->delete($setting->logo_black);
            }
            $setting->update(['logo_black' => $path]);
        }

        return back();
    }


    // public function settingUpdate(Request $request)
    // {


    //     $request->validate([
    //         'logo_white' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
    //         'logo_black' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
    //         'companyName' => 'required',
    //         'companyEmail' => 'nullable|email',
    //         'companyPhone' => 'nullable|numeric',
    //     ]);
    //     $setting = Setting::first();
    //     $setting->company_name = $request->companyName;
    //     $setting->company_name = $request->companyEmail;
    //     $setting->company_name = $request->companyPhone;
    //     if ($request->logo_white) {
    //         if ($setting->logo_white) {
    //             Storage::disk('public')->delete($setting->logo_white);
    //         }
    //         $path = $request->logo_white->store('logo-white' . $setting->id, 'public');
    //         $setting->update(['logo_white' => $path]);
    //     }

    //     if ($request->logo_black) {
    //         if ($setting->logo_black) {
    //             Storage::disk('public')->delete($setting->logo_black);
    //         }
    //         $path = $request->logo_black->store('logo-black' . $setting->id, 'public');
    //         $setting->update(['logo_black' => $path]);
    //     }


    //     $setting->save();
    //     return back();
    // }
}
