<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::where('role', '!=', 'admin')->get();
        return view('admin.usuarios', compact('usuarios'));
    }
}