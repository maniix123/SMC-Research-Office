<!DOCTYPE HTML>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('image/smclogo.png') }}">
    {{--  {{ Html::style('css/style.css') }} --}}
    {{ Html::style('bootstrap/bootstrap.css') }}
    {{ Html::script('bootstrap/jquery.js') }}
    {{ Html::script('bootstrap/bootstrap.min.js') }}
    {{ Html::style('font-awesome-4.6.3/css/font-awesome.css') }}
    {{ Html::style('dist/css/AdminLTE.css') }}
    {{ Html::script('plugins/slimScroll/jquery.slimscroll.js') }}
    {{ Html::script('dist/js/app.js') }}
    {{ Html::style('dist/css/skins/_all-skins.css') }}
    {{ Html::script('Js/functions.js') }}
</head>
<body class="skin-blue sidebar-mini hold-transition">
    @include('partials.topAdmin')
    @yield('content')
    @include('partials.adminfooter')
</body>
</html>
