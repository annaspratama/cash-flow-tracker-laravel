<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display roles page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function rolesPage()
    {
        return view(view: 'dashboard.dashboard.users.roles.roles');
    }
}
