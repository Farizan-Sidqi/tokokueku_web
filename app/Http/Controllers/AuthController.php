<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function getForgetPassword()
    {
        return view('auth.forget_password');
    }

    public function doLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'aktif'
        ];

        if (auth()->attempt($credentials)) {


            return redirect('/beranda');
        }

        return redirect()->back()->with('status', 'username atau password salah');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function doRegister(Request $request)
    {
        dd($request->all(), bcrypt($request->password));
        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'level_akses_id' => 2,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'no_wa' => $request->no_wa
        ]);

        return redirect()->route('login')->with('success', 'Register berhasil, silahkan login');
    }

    public function doLogout()
    {

        auth()->logout();

        return redirect('/login');
    }
}
