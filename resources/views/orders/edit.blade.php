@extends('layouts.app');

@section('content')
<div class="container">
    <section class="col-md-8 mx-auto">
        <form action="{{route('orders.update', ['id' => $id ?? ''])}}" method="POST">
            @method("PUT")
            @csrf
            <div class="form-group" align="center">
                <label for="clip">Wil je een clip bij je Cuppler?</label>
                <select class="form-control" name="clip">
                    <option value="1" @if ($order->clip = 1) selected @endif >Ja</option>
                    <option value="0" @if ($order->clip = 0) selected @endif>Nee</option>
                </select>
                <label for="engraving">Wil je je Cuppler graveren</label>
                <select class="form-control" name="engraving">
                        <option value="1" @if ($order->engraving = 1) selected @endif>Ja</option>
                        <option value="0" @if ($order->engraving = 0) selected @endif>Nee</option>
                </select>
            </div>
            <div class="form-group" align="center">
                <label for="front_img">Welk plaatje wil je op de voorkant?</label>
                <input class="from-control" type="text" name="front_img" value="{{$order->front_img}}"><br>
                <label for="back_img">Welk plaatje wil je op de achterkant?</label>
                <input class="from-control" type="text" name="back_img" value="{{$order->back_img}}">
            </div>
            <div class="form-group" align="center">
                <label for="location">Waar wil je je Cuppler ophalen?</label>
                <select class="from-control" name="location">
                    <option value="Greenhouse" @if ($order->location = "Greenhouse") selected @endif>Greenhouse</option>
                    <option value="Foodlab" @if ($order->location = "Foodlab") selected @endif>Foodlab</option>
                </select>
            </div>
            <div class="form-group" align="center">
                <label for="cup_id">Cup ID</label>
                <input class="form-control" type="number" name="cup_id" value="{{$order->cup_id}}"><br>
                <label for="owner">Owner</label>
                <input class="form-control" type="number" name="user_id" value="{{$order->user_id}}"><br>
                <label for="status">Order status:</label>
                <input class="form-control" type="text" name="status" value="{{$order->status}}">
            </div>
            <div class="form-group" align="center">
            <input type="submit" name="submit">
            </div>
        </form>
    </section>
</div>
@endsection