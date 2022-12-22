<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

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
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'Data Tidak Ada'
            ], 404);
        }
        return response()->json($movie);
    }
}
