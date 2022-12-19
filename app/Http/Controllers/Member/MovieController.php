<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\UserPremium;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function show($id)
    {
        return view('member.movie-detail');
    }

    public function watch($id)
    {
        //mengambil user yang sedang aktif
        $userId = auth()->user()->id;
        // dd($userId);

        //cek apakah member sudah melakukan subcription
        $userPremium = UserPremium::where('user_id', $userId)->first();

        //jika sudah lakukan ini
        if ($userPremium) {
            //mencari apakah masa langganan / end of subcription sudah kadaluarsa atau belum

            $endOfSubs = $userPremium->end_of_subcription; //masih dalam bentuk string, kita akan menggunakan carbon maka diconvert dulu 
            $date = Carbon::createFromFormat('Y-m-d', $endOfSubs); //memformat ke dalam carbon

            //membandingkan apakah tanggalnya sudah kadaluarsa dari pada tanggal saat ini
            //contohnya sekarang tangal 19 des dan masa end subs nya tgl 17, maka dia tidak dapat mengaksesnya lagi
            $isValid = $date->greaterThan(now());

            // dd($isValid);
            if ($isValid) {
                return view('member.movie-watching');
            }
        }
        return redirect()->route('pricing');
    }
}
