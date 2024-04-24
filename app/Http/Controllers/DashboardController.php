<?php

namespace App\Http\Controllers;

use App\Models\Pcp;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia('Dashboard', [
            'quries' => Pcp::orderBy('id', 'desc')->paginate(10),
        ]);
    }
}
