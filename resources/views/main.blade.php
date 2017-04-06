<!DOCTYPE HTML>
<html>
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset('image/smclogo.png') }}">
        {{ Html::style('css/style.css') }}
        {{ Html::style('bootstrap/bootstrap.css') }}
        {{ Html::script('bootstrap/jquery.js') }}
        {{ Html::script('bootstrap/bootstrap.min.js') }}
        {{ Html::style('font-awesome-4.6.3/css/font-awesome.css') }}
        {{ Html::script('Js/functions.js') }}
        {{ Html::style('css/hover.css') }}
    </head>
    <body>
        @include('partials.navbar')
        @yield('content')
        @include('partials.footer') 
    </body>
</html>
