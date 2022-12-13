<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function create()
    {
        return view('admin.movie-create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $data = $request->except('_token');
        $request->validate(
            [
                'title' => 'required',
                'small_thumbnail' => 'required|image|mimes:jpeg,jpg,png',
                'large_thumbnail' => 'required|image|mimes:jpeg,jpg,png',
                'trailer' => 'required|url',
                'movie' => 'required|url',
                'trailer' => 'required',
                'movie' => 'required',
                'casts' => 'required',
                'categories' => 'required',
                'release_date' => 'required',
                'duration' => 'required',
                'about' => 'required',
                'short_about' => 'required',
                'featured' => 'required',
            ],
            [
                'title.required' => 'Title tidak Boleh Kosong',
                'small_thumbnail.required' => 'Tidak Boleh Kosong',
                'small_thumbnail.image' => 'Type JPEG, JPG Dan PNG',
                'large_thumbnail.required' => 'Trailer tidak Boleh Kosong',
                'large_thumbnail.image' => 'Type JPEG, JPG Dan PNG',
                'trailer.required' => 'Trailer tidak Boleh Kosong',
                'trailer.url' => 'Trailer Harus Bersifat URL',
                'movie.required' => 'Movie tidak Boleh Kosong',
                'movie.url' => 'Movie Harus Bersifat URL',
                'casts.required' => 'Tidak Boleh Kosong',
                'categories.required' => 'Tidak Boleh Kosong',
                'release_date.required' => 'Tidak Boleh Kosong',
                'duration.required' => 'Tidak Boleh Kosong',
                'about.required' => 'Tidak Boleh Kosong',
                'short_about.required' => 'Tidak Boleh Kosong',
                'featured.required' => 'Tidak Boleh Kosong',
            ]
        );

        $smallThumbnail = $request->small_thumbnail;
        $largeThumbnail = $request->large_thumbnail;

        //Nama File Image
        $originalSmallThumbnailName = $smallThumbnail->getClientOriginalName();
        $originalLargeThumbnailName = $largeThumbnail->getClientOriginalName();

        //Memasukkan Ke Folder
        $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnailName);
        $largeThumbnail->storeAs('public/thumbnail', $originalLargeThumbnailName);

        //insert ke database
        $data['small_thumbnail'] = $originalSmallThumbnailName;
        $data['large_thumbnail'] = $originalLargeThumbnailName;

        Movie::create($data);

        return redirect()->route('movie.create')->with('success', "Data Berhasil Di Simpan");
    }
}
