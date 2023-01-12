<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    public function halamanlogin(){
        return view('login.login-aplikasi');
    }

    public function postlogin(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/home');
        }
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return view('login.login-aplikasi');
    }

    public function registrasi(){
        return view('login.registrasi');
    }

    public function simpanregistrasi(Request $request){
        User::create([
            'name' => $request->name,
            'level' => 'Karyawan',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ]);
        return view('login.login-aplikasi');
    }
}
