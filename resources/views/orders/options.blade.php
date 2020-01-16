@extends('layouts.app')

@section('menubuttons')
            <a href="/" class="btn navbar-button-back home"></a>
            <button type="submit" class="btn">Selecteer beker</button>
@endsection

@section('content')
    <div class="container">
        <a class="btn" href="../newcuppy">Eigen ontwerp</a>
        <a class= "btn" href="nietgraveren">Geen ontwerp</a>
    </div>
@endsection
