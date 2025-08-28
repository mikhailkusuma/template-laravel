<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        session()->flush();
        session()->regenerate();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->to(route('authentication.login_index'));
    }
}
