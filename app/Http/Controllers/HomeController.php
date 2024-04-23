<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Pcp/Index', [
            'data' => session('car_data'),
            'searchError' => session('search_error'),
        ]);
    }
}
