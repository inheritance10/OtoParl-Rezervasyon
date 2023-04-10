<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('frontend.login.login');
    }

    public function loginPost(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->post('email'), 'password' => $request->post('password')])){
                $request->session()->regenerate();
                return response()->json([
                    'status' => 1,
                    'message' => 'Giriş Başarılı'
                ]);
            }else {
                return response()->json([
                    'status' => 2,
                    'message' => 'Kullanıcı Kaydı bulunamadı'
                ]);
            }
        }catch (Exception $e){
            return response()->json([
                'status' => 0,
                'message' => $e.getMessage()
            ]);
        }



    }

    public function register()
    {
        return view('frontend.register.register');
    }

    public function registerPost(Request $request)
    {
        try {
            $save = User::create([
               'email' => $request->post('email'),
                'password' => Hash::make($request->post('password')),
                'name' => $request->post('name')
            ]);

            if ($save) {
                return response()->json([
                    'status' => 1,
                    'message' => 'Kayıt Başarılı'
                ]);
            }else{
                return response()->json([
                    'status' => 2,
                    'message' => 'Kayıt Başarısız'
                ]);
            }
        } catch (Exception $e){
            return response()->json([
                'status' => 0,
                'message' => $e.getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('signin');
    }
}
