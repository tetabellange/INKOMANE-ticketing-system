<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Show roles list (you might want to connect to a Role model later)
    public function index()
    {
        $roles = ['admin', 'agent', 'customer']; // static for now
        return view('admin.roles', compact('roles'));
    }
}
