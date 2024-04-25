<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $car_data =  Session::get('car_data');
        if ($car_data) {
            // Session::forget('car_data');
        }
        // dd($car_data);

        return Inertia::render('Pcp/Index', [
            'data' => session('car_data'),
            'searchError' => session('search_error'),
        ]);
    }
}
