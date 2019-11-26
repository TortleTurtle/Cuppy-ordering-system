@extends('layouts.app')

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
                    <label for="engraving">Wil je je Cuppler graveren</label>
                    <select class="form-control" name="engraving">
                            <option value="1">Ja</option>
                            <option value="0">Nee</option>
                    </select>
                </div>
                <div class="form-group" align="center">
                    <label for="front_img">Welk plaatje wil je op de voorkant?</label>
                    <input class="from-control" type="text" name="front_img"><br>
                    <label for="back_img">Welk plaatje wil je op de achterkant?</label>
                    <input class="from-control" type="text" name="back_img">
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
        </section>
    </div>
@endsection