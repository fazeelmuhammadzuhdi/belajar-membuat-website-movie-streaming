<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\UserPremium;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function show($id)
    {
        return view('member.movie-detail');
    }

    public function watch($id)
    {
        $userId = auth()->user()->id;

        //cek apakah member sudah melakukan subcription
        $userPremium = UserPremium::where('user_id', $userId)->first();

        //jika sudah lakukan ini
        if ($userPremium) {
            return view('member.movie-watching');
        }
        return redirect()->route('pricing');
        // dd($userId);


    }
}
