@extends('layouts.app')

@section('content')
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td scope="col">Name</td>
                    <td scope="col">Email</td>
                    <td scope="col">Cups</td>
                    <td scope="col">Orders</td>
                    <td scope="col"></td>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td scope="col">{{$user->name}}</td>
                    <td scope="col">{{$user->email}}</td>
                    <td scope="col">{{$user->cups_count}}</td>
                    <td scope="col">{{$user->orders_count}}</td>
                    <td scope="col"><a href="" class="btn btn-secondary">Details</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection