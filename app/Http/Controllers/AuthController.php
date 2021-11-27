<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        } else {
            return view('auth.login');
        }
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $cekuser = User::where('username', $request->get('username'))->first();
            if ($cekuser && Hash::check($request->get('password'), $cekuser->password)) {
                Auth::login($cekuser);
                session(['role' => $cekuser->role]);
                session()->flash('info', 'Selamat Datang  !');
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->back()->withErrors(['username atau password salah']);
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('alert-info', 'Anda telah keluar, Sampai ketemu lagi!');;
    }
}
