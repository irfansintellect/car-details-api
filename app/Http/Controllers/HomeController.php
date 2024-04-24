<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {

        // Session::forget('car_data');

        return Inertia::render('Pcp/Index', [
            'data' => session('car_data'),
            'searchError' => session('search_error'),
        ]);
    }
}
