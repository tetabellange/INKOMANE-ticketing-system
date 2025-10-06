<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Show list of users
    public function index()
    {
        $users = User::all(); // fetch all users
        return view('admin.users.index', compact('users'));
    }
}
