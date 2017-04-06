<!DOCTYPE html>
<html>
<head>
    <title>Please don't go snooping around</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    {{ Html::style('bootstrap/bootstrap.css') }}
    {{ Html::script('bootstrap/jquery.js') }}
    {{ Html::script('bootstrap/bootstrap.min.js') }}
    {{ Html::style('font-awesome-4.6.3/css/font-awesome.css') }}
    {{ Html::style('dist/css/AdminLTE.css') }}
    <style>
        body {
            font-family: 'Lato';
        }
        .container{
            margin-top: 50px;
            text-align: center;
        }
        .container > h1{
            font-size: 90px;
        }
    </style>
</head>
<body>
    <div class="container">
        <i class="fa fa-exclamation-triangle fa-5x text-red" aria-hidden="true"></i>
        <h1 class="text-center">Sorry we can not find what you're looking for!</h1>
        <a href="{{ url('Admin/Dashboard') }}" class="btn btn-danger btn-lg"><i class="fa fa-arrow-circle-left"></i> Go back</a>
    </div>
</body>
</html>
