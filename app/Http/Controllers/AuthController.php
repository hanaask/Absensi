<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Backtrace\Arguments\ReducedArgument\ReducedArgument;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        if(Auth::guard('karyawan')->attempt(['npm'=>$request->npm, 'password'=>$request->password])){
            return view('dashboard.dashboard');
        }else{
            return redirect('/')->with(['warning'=> 'NPM / Password Salah']);
        }
    }

    public function __construct()
    {
        $this->middleware('auth')->only('logout');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
