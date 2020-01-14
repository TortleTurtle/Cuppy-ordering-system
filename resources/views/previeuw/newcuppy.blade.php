@extends('layouts.app');

@section('menubuttons')
            <button type="submit" class="btn navbar-button-back home"></button>
            <button type="submit" class="btn navbar-button-back">Selecteer beker</button>
            <button type="submit" class="btn">ontwerp</button>
@endsection

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"><h2>Cuppy lazer cut converter</h2></div>
                <div class="panel-body">

                    @if ($message = Session::get('success'))

                    <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                    </div>

                    <img class="cuppyprint" src="images/uploads/{{ Session::get('image') }}">
                    <img class="cuppyplaceholder" src="images/system/cuppyblack.png">


                    @php $userimg = "images" . Session::get('image') @endphp
                        <div id="container"></div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (!$message = Session::get('success'))
                    <div class="alert alert-info">
                        <strong>Info!</strong> Je ontwerp wordt omgezet in zwart wit. <br> Het witte gedeelde wordt van de beker afgehaald met een laser.
                    </div>

                    <form action="/newcuppy" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input onchange="this.form.submit()" type="file" name="image" class="form-control btn">
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
