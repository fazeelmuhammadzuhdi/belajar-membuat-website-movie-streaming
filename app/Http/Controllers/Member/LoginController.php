<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('member.auth');
    }

    public function auth(Request $request)
    {
        $request->validate([

            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Tidak Boleh Kosong',
            'password.required' => 'Tidak Boleh Kosong'
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'member';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // return 'Login Success';
            return redirect()->route('member.dashboard');
        }

        return back()->withErrors(['credentials' => "Your Credentials Wrongg !!"])->withInput();
        // return 'visa login niihh';
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
