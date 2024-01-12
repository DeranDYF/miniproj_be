<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'user';
        $data['title'] = 'USER';
        return view('dashboard/dashboard', $data);
    }
}
