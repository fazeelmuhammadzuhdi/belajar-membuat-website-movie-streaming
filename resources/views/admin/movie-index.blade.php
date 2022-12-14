@extends('admin.layouts.base')

@section('title', 'Data Film')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Movies</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ route('movie.create') }}" class="btn btn-warning"><i class="fas fa-plus-square">
                                    Create Movie</i>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Small Thumbnail</th>
                                        <th>Large Thumbnail</th>
                                        <th>Categories</th>
                                        <th>Casts</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movies as $movie)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $movie->title }}</td>
                                            <td><img src="{{ asset('storage/thumbnail/' . $movie->small_thumbnail) }} "
                                                    alt="" width="30"></td>
                                            <td><img src="{{ asset('storage/thumbnail/' . $movie->large_thumbnail) }} "
                                                    alt="" width="30"></td>
                                            <td>{{ $movie->categories }}</td>
                                            <td>{{ $movie->casts }}</td>
                                            <td>

                                                <a href="{{ route('movie.edit', $movie->id) }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt">
                                                        Edit</i></a>
                                                <form action="{{ route('movie.destroy', $movie->id) }}" method="POST"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm hapus"><i
                                                            class="fas fa-trash"
                                                            onclick="return confirm('Apakah Yakin Ingin Menghapus Data Ini?')">
                                                            Hapus</i></button>
                                                </form>

                                                {{-- <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"
                                                        id="hapus"> Hapus</i></button> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')

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
        $(document).ready(function() {
            $('#example2').DataTable();
        });

        $('#release-date').datetimepicker({
            format: 'YYYY-MM-DD'
        })
    </script>
@endpush


{{-- @push('after-script')
    <script>
        $('#release-date').datetimepicker({
            format: 'YYYY-MM-DD'
        })
    </script>
@endpush --}}
