@extends('admin.layouts.base')

@section('title', 'Data Transactions')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Transactions</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Package</th>
                                        <th>User Email</th>
                                        <th>Amount</th>
                                        <th>Transaction Code</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->package->name }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->transaction_code }}</td>
                                            <td>{{ $item->status }}</td>
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
