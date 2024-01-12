<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'role';
        $data['title'] = 'ROLE';
        return view('dashboard/dashboard', $data);
    }
}