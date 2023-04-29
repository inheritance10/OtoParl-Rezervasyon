<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function index()
    {
        return view('backend.login.login');
    }



    public function login(Request $request)
    {
        $credentials = $request->only('email','password');

        if(Auth::guard('admin')->attempt($credentials))
        {
            return redirect()->intended(route('dasboard'));
        }else{
            return back()->with('error','Hatalı kullanıcı');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
