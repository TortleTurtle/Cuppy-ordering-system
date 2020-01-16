@extends('layouts.app')

@section('menubuttons')
            <a href="/" class="btn navbar-button-back home"></a>
            <a href="../orders/new" class="btn navbar-button-back ">Selecteer beker</a>
            <a href="../newcuppy" class="btn navbar-button-back ">upload ontwerp</a>
            <a  type="submit" class="btn">Accessoires</a>
@endsection

@section('content')
    <div class="container">
        <section class="col-md-8 mx-auto">
            <form action="/orders" method="POST">
                @csrf
                <div class="form-group" align="center">
                    <label for="clip">Wil je een clip bij je Cuppler?</label>
                    <select class="form-control" name="clip">
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </div>
                <div class="form-group" align="center">
                <label for="location">Waar wil je je Cuppler ophalen?</label>
                <select class="from-control" name="location">
                    <option value="Greenhouse">Greenhouse</option>
                    <option value="Foodlab">Foodlab</option>
                </select>
                <br>
                <input type="submit" name="submit">
                </div>
            </form>
        </form>
        </section>
    </div>
@endsection
