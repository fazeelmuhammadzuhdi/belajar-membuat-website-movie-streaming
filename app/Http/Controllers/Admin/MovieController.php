<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        return view('admin.movie-index', [
            'movies' => $movies
        ]);
    }

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
        $originalSmallThumbnailName = Str::random(10) . $smallThumbnail->getClientOriginalName();
        $originalLargeThumbnailName = Str::random(10) . $largeThumbnail->getClientOriginalName();

        //Memasukkan Ke Folder
        $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnailName);
        $largeThumbnail->storeAs('public/thumbnail', $originalLargeThumbnailName);

        //insert ke database
        $data['small_thumbnail'] = $originalSmallThumbnailName;
        $data['large_thumbnail'] = $originalLargeThumbnailName;

        Movie::create($data);

        return redirect()->route('movie.index')->with('success', "Data Berhasil Di Simpan");
    }

    public function edit($id)
    {
        // cara Pertama
        $movies = Movie::find($id);

        //Cara kedua
        // $movies = Movie::where('id', $id)->first();
        return view('admin.movie-edit', [
            'movies' => $movies
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $request->validate(
            [
                'title' => 'required',
                'small_thumbnail' => 'image|mimes:jpeg,jpg,png',
                'large_thumbnail' => 'image|mimes:jpeg,jpg,png',
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
                'small_thumbnail.image' => 'Type JPEG, JPG Dan PNG',
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

        $movies = Movie::find($id);

        if ($request->small_thumbnail) {
            //menyimpan image baru
            $smallThumbnail = $request->small_thumbnail;
            $originalSmallThumbnailName = Str::random(10) . $smallThumbnail->getClientOriginalName();
            $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnailName);
            $data['small_thumbnail'] = $originalSmallThumbnailName;

            //delete data lama
            Storage::delete('public/thumbnail/' . $movies->small_thumbnail);
        }

        if ($request->large_thumbnail) {
            //menyimpan image baru
            $largeThumbnail = $request->large_thumbnail;
            $originalLargeThumbnailName = Str::random(10) . $largeThumbnail->getClientOriginalName();
            $largeThumbnail->storeAs('public/thumbnail', $originalLargeThumbnailName);
            $data['large_thumbnail'] = $originalLargeThumbnailName;

            //delete data lama
            Storage::delete('public/thumbnail/' . $movies->large_thumbnail);
        }

        $movies->update($data);

        return redirect()->route('movie.index')->with('success', "Data Berhasil Di Update");
    }

    public function destroy($id)
    {

        // Movie::where('id', $id)->delete();
        // return back();

        $data = Movie::findOrFail($id);
        $hapus = $data->delete();

        if ($hapus) {
            return redirect()->route('movie.index')->with('success', "Data Berhasil Di Hapus");
        } else {
            abort(404);
        }

        // $item = Movie::findOrFail($id);

        // $hapus = $item->delete();

        // return redirect()->route('movie.index');
    }
}
