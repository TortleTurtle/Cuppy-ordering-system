@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td scope="col">owner</td>
                    <td scope="col">Clip:</td>
                    <td scope="col">Engraving</td>
                    <td scope="col">location</td>
                    <td scope="col">ordered at</td>
                    <td scope="col">delivered at</td>
                    <td scope="col">status</td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td scope="col">{{$order->owner->name}}</td>
                        <td scope="col">@if ($order->clip == 1)Yes @else No @endif</td>
                        <td scope="col">@if ($order->engraving == 1)Yes @else No @endif</td>
                        <td scope="col">{{$order->location}}</td>
                        <td scope="col">{{$order->ordered_at}}</td>
                        <td scope="col">{{$order->delivered_at}}</td>
                        <td scope="col">{{$order->status}}</td>
                        <td scope="col"><a class="btn btn-secondary" href="orders/{{$order->id}}">Details</a></td>
                        <td scope="col"><a class="btn btn-primary" href="orders/edit/{{$order->id}}">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection