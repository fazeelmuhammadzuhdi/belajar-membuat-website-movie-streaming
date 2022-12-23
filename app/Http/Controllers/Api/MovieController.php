<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use App\Models\UserPremium;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        //search
        $search = $request->query('search');

        $movies = Movie::where('title', 'like', '%' . $search . '%')->orderBy('featured', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($movies);
    }

    public function show(Request $request, $id)
    {
        //cek apakah member sudah melakukan subcription
        $user = $request->get('user');

        $userPremium = UserPremium::where('user_id', $user->id)->first();

        $movie = Movie::find($id);

        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'Data Tidak Ada'
            ], 404);
        }

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
                return response()->json($movie);
            }
        }
        return response()->json(['message' => "You didn't have subscription plan"]);
    }
}
