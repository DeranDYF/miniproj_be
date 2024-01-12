<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        if ($user) {
            return redirect()->to('/');
        }
        return view('auth/login');
    }
    public function proses_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);


        // ambil data request username & password saja 
        $credential = $request->only('username', 'password');

        // cek jika data username dan password valid (sesuai) dengan data
        if (Auth::attempt($credential)) {
            $user =  Auth::user();
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Terjadi Kesalahan Login!'));
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function proses_register(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }
        $request['level'] = 'user';
        $request['password'] = bcrypt($request->password);
        User::create($request->all());
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
