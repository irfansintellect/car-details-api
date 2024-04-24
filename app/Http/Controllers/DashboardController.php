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
            'quries' => Pcp::orderBy('id', 'desc')->paginate(10),
        ]);
    }

    public function setting()
    {

        return Inertia('Setting', [
            'setting' => Setting::first(),
        ]);
    }

    public function settingUpdate(Request $request): RedirectResponse
    {


        $request->validate([
            'logo_white' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'logo_black' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'companyName' => 'required',
        ]);

        $setting = Setting::first();
        $setting->company_name = $request->companyName;
        if ($request->logo_white) {
            if ($setting->logo_white) {
                Storage::disk('public')->delete($setting->logo_white);
            }
            $path = $request->logo_white->store('logo-white' . $setting->id, 'public');
            $setting->update(['logo_white' => $path]);
        }

        if ($request->logo_black) {
            if ($setting->logo_black) {
                Storage::disk('public')->delete($setting->logo_black);
            }
            $path = $request->logo_black->store('logo-black' . $setting->id, 'public');
            $setting->update(['logo_black' => $path]);
        }


        $setting->save();
        return back();
    }
}
