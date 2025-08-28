<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Throwable;

class LoginController extends Controller
{
    //GENERAL
    public function index()
    {
        return view('Authentication.views.login');
    }

    public function doLogin(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            // Coba Authentication sebagai User
            if ($user = User::where('email', $credentials['email'])->first()) {

                try {
                    if (Hash::check($credentials['password'], $user->password)) {
                        Auth::guard('web')->login($user, true);
                        $request->session()->regenerate();
                        Session::flash('login-message', ['type' => 'success', 'msg' => 'Anda berhasil login sebagai User!']);
                        return redirect()->intended(route('dashboard.index'));
                    }
                    return redirect()->back()->withErrors(['password' => 'Password tidak cocok'])->withInput($request->except('password'));
                } catch (\Throwable $th) {
                    //throw $th;
                    __log('Login: Do Login -> Terjadi kesalahan', $th->getMessage(), 'error');
                    return redirect()->back()->withErrors(["errors" => ["Terjadi kesalahan"]]);
                }
            }

            // Jika email tidak ditemukan di kedua tabel
            return redirect()->back()->withErrors(['email' => 'Email tidak terdaftar'])->withInput($request->except('password'));
        } catch (\Throwable $th) {
            __log('Login: Do Login -> Terjadi kesalahan', $th->getMessage(), 'error');
            return redirect()->back()->withErrors(["errors" => ["Terjadi kesalahan"]]);
        }
    }
}
