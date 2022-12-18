<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('member.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'Tidak Boleh Kosong',
            'phone_number.required' => 'Tidak Boleh Kosong',
            'email.required' => 'Tidak Boleh Kosong',
            'password.required' => 'Tidak Boleh Kosong'
        ]);
    }
}
