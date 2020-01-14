@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6" align="center">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td scope="col">Id:</td>
                        <td scope="col">Clip:</td>
                        <td scope="col">Engraving</td>
                        @if ($order->engraving == 1)
                        <td scope="col">Front Image</td>
                        <td scope="col">Back Image</td>
                        @endif
                        <td scope="col">location</td>
                        <td scope="col">ordered at</td>
                        <td scope="col">delivered at</td>
                        <td scope="col">status</td>
                        <td scope="col">cup id</td>
                        <td scope="col">owner</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="col">{{$order->id}}</td>
                        <td scope="col">@if ($order->clip == 1)Yes @else No @endif</td>
                        @if ($order->engraving == 0)
                        <td scope="col">No</td>
                        @else
                        <td scope="col">Yes</td>
                        <td scope="col">{{$order->front_img}}</td>
                        <td scope="col">{{$order->back_img}}</td>
                        @endif
                        <td scope="col">{{$order->location}}</td>
                        <td scope="col">{{$order->ordered_at}}</td>
                        <td scope="col">{{$order->delivered_at}}</td>
                        <td scope="col">{{$order->status}}</td>
                        <td scope="col">{{$order->cup_id}}</td>
                        <td scope="col">{{$order->owner->name}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <form action="{{route('orders.delete', ['id' => $order->id])}}" method="POST">
            @method('DELETE')
            @csrf
            <input type="submit" class="btn btn-danger" value="Delete" name="submit">
        </form>
    </div>
@endsection