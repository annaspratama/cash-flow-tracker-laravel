<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    /**
     * Control all dashboard requests.
     */
    public function __construct() {
        // $this->middleware('verified')->only('dashboardPage');
    }

    /**
     * Display dashboard page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function dashboardPage(Request $request)
    {
        return view(view: 'dashboard/dashboard/dashboard');
    }
}
