<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        // $data = $request->except('_token');

        $data = $request->all();

        $isEmailExist = User::where('email', $request->email)->exists();

        if ($isEmailExist) {
            return back()->withErrors([
                'email' => 'Email Already Exists'
            ])->withInput();
        }

        $data['password'] = Hash::make($request->password);
        $data['role'] = 'member';

        User::create($data);

        return redirect()->route('member.login');
        // dd($data);
    }
}
