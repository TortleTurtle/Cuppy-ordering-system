<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
            <div class="center-box">
                <div class="cuppler-img-home"></div>
            </div>
            <div id="tabel-cuppy"></div>
            <div class="buttons-header-box">
                <a class="btnhome" href="/orders/new">ONTWERP BEKER</a>
                <a class="btnhome" href="/home">Login</a>
            </div>
        </header>
        <div class="cuppy-info">
            <div class="cuppy-logo">

            </div>
            <div class="cuppy-slogun">
                Een bakkie pleur me niet weg
            </div>
        </div>
        <div class="about">
            <div class="about-item">
                <div class="about-title">
                Korting
                </div>
                <div class="about-text">
                Korting op elke kop koffie in de kantine
                </div>
            </div>
                <div class="about-item">
                    <div class="about-title">
                    Orgineel
                    </div>
                    <div class="about-text">
                    Upload je eigen ontwerp!
                    </div>
                </div>
                <div class="about-item">
                    <div class="about-title">
                    Bewust
                    </div>
                    <div class="about-text">
                    Bespaar op wegwerp plastic
                    </div>
                </div>
            </div>
        </div>
        @extends('layouts.footer')
</body>
</html>
