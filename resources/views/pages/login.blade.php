@extends('main')
@section('title')
    Login Page
@stop
@section('content')
<div class="container body">
	<div class="col-lg-3"></div>
	<div class="col-lg-6">
		<div class="panel panel-default" style="margin-top: 15px;">
			<div class="panel-heading">
				<h4>Login Form</h4>
			</div>
			<div class="panel-body">
				@if ($alert = Session::get('wrong'))
					<div class="alert alert-danger">
						<p class="text-center">{{ $alert }}</p>
					</div>
				@elseif(Session::get('not_activated'))
					<div class="alert alert-info">
						<p class="text-center">{{ Session::get('not_activated') }}</p>
					</div>
				@elseif(Session::get('rejected'))
					<div class="alert alert-danger">
						<p class="text-center">{{ Session::get('rejected') }}</p>
					</div>
				@endif
				{!! Form::open(['url' => 'login', 'method' => 'POST', 'class'=>'form-horizontal']) !!}
					<div class="form-group">
						{!! Form::label('username', 'Username', ['class'=>'col-lg-2 control-label'])!!}
						<div class="col-lg-10">
							<div class="input-group"><span class="input-group-addon">
							<i class="fa fa-user"></i></span>
							{!! Form::text('username', null , ['class' => 'form-control col-lg-10' , 'autofocus' => 'autofocus', 'placeholder' => 'Enter username here', old('username')])!!}	
							</div>
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('password', 'Password', ['class'=>'col-lg-2 control-label']) !!}
						<div class="col-lg-10">
							<div class="input-group"><span class="input-group-addon">
							<i class="fa fa-key"></i></span>
							{!! Form::password('password', ['class' => 'form-control col-lg-10', 'placeholder' => 'Enter password here'])!!}
							</div>	
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-sm-10">
							<button class="btn btn-primary"><i class="fa fa-sign-in"></i> Login</button>							
						</div>
					</div>
				{!! Form::close() !!}			
			</div>
		</div>
	</div>
	<div class="col-lg-3"></div>
</div>

@endsection