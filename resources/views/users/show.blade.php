@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-5" align="center">
            <ul class="list-unstyled">
                <li>ID: {{$user->id}}</li>
                <li>Naam: {{$user->name}}</li>
                <li>Email: {{$user->email}}</li>
                <li>Joined: {{$user->created_at}}</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5" align="center">
            <h3>Orders</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td scope="col">clip</td>
                        <td scope="col">engraving</td>
                        <td scope="col">location</td>
                        <td scope="col">status</td>
                        <td scope="col"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->orders as $order)
                    <tr>
                        <td scope="col">{{$order->clip}}</td>
                        <td scope="col">{{$order->engraving}}</td>
                        <td scope="col">{{$order->location}}</td>
                        <td scope="col">{{$order->status}}</td>
                        <td scope="col"><a class="btn btn-secondary" href="{{route('orders.show',['id' => $order->id])}}">Details</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <h3>Cups</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <td scope="col">ID</td>
                    <td scope="col">coffee ordered</td>
                    <td scope="col"></td>
                </tr>
                </thead>
                <tbody>
                @foreach($user->cups as $cup)
                    <tr>
                        <td scope="col">{{$cup->id}}</td>
                        <td scope="col">{{$order->coffee_ordered}}</td>
                        <td scope="col"><a class="btn btn-secondary" href="">Details</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection