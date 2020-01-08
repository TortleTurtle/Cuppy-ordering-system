@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <a class="dropdown-item" href="/cup/create">link cup account</a>
                    @if(count($cup)>0)
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Coffee</th>
                                <th scope="col">Started at</th>
                                <th scope="col">+ Coffee</th>
                                <th scope="col">- Coffee</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                        @foreach($cup as $cuppy)
                            <tbody>
                            <tr>
                                <td>{{$cuppy->owner->name}}</td>
                                <td>{{$cuppy->coffee_ordered}}</td>
                                <td>{{$cuppy->created_at}}</td>
                                <td><a class="btn btn-success" href="cup/plus_coffee/{{$cuppy->id}}">+</a></td>
                                <td><a class="btn btn-warning" href="cup/min_coffee/{{$cuppy->id}}">-</a></td>
                                <td><a class="btn btn-danger" href="cup/delete/{{$cuppy->id}}">Delete</a></td>

                            </tr>
                            </tbody>
                        </table>

                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Punten</th>
                                <th scope="col">Tot gratis warme drank</th>

                            </tr>
                            </thead>
                                <tbody>
                                <tr>
                                    <td>{{$cuppy->points}}</td>
                                    @if((4-($cuppy->points)===0))
                                        <td>Gratis!!!</td>
                                     @else
                                    <td>{{4-($cuppy->points)}}</td>
                                    @endif
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    @endif
                    {{$errors->name}}

                </div>
            </div>
        </div>
    </div>
@endsection
