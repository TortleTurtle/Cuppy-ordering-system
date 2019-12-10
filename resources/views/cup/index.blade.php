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
                            </tr>
                            </thead>
                        @foreach($cup as $cuppy)
                            <tbody>
                            <tr>
                                <td>{{$cuppy->owner->name}}</td>
                                <td>{{$cuppy->coffee_ordered}}</td>
                                <td>{{$cuppy->created_at}}</td>
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
