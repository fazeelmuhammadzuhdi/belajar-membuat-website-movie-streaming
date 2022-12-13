@extends('admin.layouts.base')

@section('title', 'Movie')

@section('content')
    <div class="row">
        <div class="col-md-12">

            {{-- Alert Here --}}

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create Movie</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form enctype="multipart/form-data" method="POST" action="{{ route('movie.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" placeholder="e.g Guardian of The Galaxy"
                                    value="{{ old('title') }}" autofocus>

                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label for="trailer">Trailer</label>
                                <input type="text" class="form-control @error('trailer') is-invalid @enderror"
                                    id="trailer" name="trailer" placeholder="Video url" value="{{ old('trailer') }}">

                                @error('trailer')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-4">
                                <label for="movie">Movie</label>
                                <input type="text" class="form-control @error('movie') is-invalid @enderror"
                                    id="movie" name="movie" placeholder="Video url" value="{{ old('movie') }}">

                                @error('movie')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="duration">Duration</label>
                                <input type="text" class="form-control @error('duration') is-invalid @enderror"
                                    id="duration" name="duration" placeholder="1h 39m" value="{{ old('duration') }}">

                                @error('duration')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label>Date:</label>
                                <div class="input-group date" id="release-date" data-target-input="nearest">
                                    <input type="text" name="release_date"
                                        class="form-control datetimepicker-input @error('release_date') is-invalid @enderror"
                                        data-target="#release-date" value="{{ old('release_date') }}" />
                                    <div class="input-group-append" data-target="#release-date"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    @error('release_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="short-about">Casts</label>
                                <input type="text" class="form-control @error('casts') is-invalid @enderror"
                                    id="casts" name="casts" placeholder="Jackie Chan" value="{{ old('casts') }}">
                                @error('casts')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="short-about">Categories</label>
                                <input type="text" class="form-control @error('categories') is-invalid @enderror"
                                    id="categories" name="categories" placeholder="Action, Fantasy"
                                    value="{{ old('categories') }}">

                                @error('categories')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label for="small-thumbnail">Small Thumbnail</label>
                                <input type="file" class="form-control" name="small_thumbnail">
                            </div>
                            <div class="form-group col-4">
                                <label for="large-thumbnail">Large Thumbnail</label>
                                <input type="file" class="form-control" name="large_thumbnail">
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-4">
                                <label for="short-about">Short About</label>
                                <input type="text" class="form-control @error('short_about') is-invalid @enderror"
                                    id="short_about" name="short_about" placeholder="Awesome Movie"
                                    value="{{ old('short_about') }}">

                                @error('short_about')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label for="short-about">About</label>
                                <input type="text" class="form-control @error('about') is-invalid @enderror"
                                    id="about" name="about" placeholder="Awesome Movie"
                                    value="{{ old('about') }}">
                                @error('about')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label>Featured</label>
                                <select class="custom-select" name="featured">
                                    <option value="0" {{ old('featured') == '0' ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('featured') == '1' ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

    @if (session('success') == true)
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif
    <script>
        $('#release-date').datetimepicker({
            format: 'YYYY-MM-DD'
        })
    </script>
@endsection
{{-- @push('after-script')
    <script>
        $('#release-date').datetimepicker({
            format: 'YYYY-MM-DD'
        })
    </script>
@endpush --}}
