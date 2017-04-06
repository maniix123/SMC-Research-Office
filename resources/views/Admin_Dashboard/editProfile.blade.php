@extends('admin')
@section('title', "Edit profile")

@section('content')
	<div class="content-wrapper">
		<section class="content-header">
			<h4>Edit your profile</h4>
		</section>
		<section class="content">
			<ol class="breadcrumb">
				<li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
				<li><a href="#"><i class="fa fa-calendar"></i> Edit profile</a></li>
			</ol>
			<div class="row">
				<div class="col-lg-12">
					<div class="well">
						<div class="form-group">
							<h1 id="commoninfo"><a href="#"># Common Information</a></h1>
							<hr>
						</div>
						{{ Form::model($user, ['url' => 'Admin/Profile/' . $user->id, 'method' => 'PUT', 'role' => 'form', 'class' => 'form-horizontal',  'files' => 'true']) }}
							<div class="form-group">
								<div class="col-lg-12 text-center">
									<img src="{{ $user->image }}" alt="" class="img-circle img-thumbnail">
								</div>
							</div>
							<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
								<div class="col-lg-12">
									{{ Form::label('name', 'Name:', ['class' => 'control-label']) }}
									<div class="input-group"><span class="input-group-addon">
									<i class="fa fa-user"></i></span>
										{{ Form::text('name', null, ['class' => "form-control ", 'placeholder' => 'Enter your name', 'required', 'value' => old("name")]) }}	
									</div>
									@if ($errors->has('name'))
									    <span class="help-block">
									        <i>{{ $errors->first('name') }}</i>
									    </span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
								<div class="col-lg-12">
								{{ Form::label('email', 'Email:', ['class' => 'control-label']) }}
								<div class="input-group"><span class="input-group-addon">
								<i class="fa fa-envelope-o"></i></span>
									{{ Form::email('email', null, ['class' => "form-control ", 'placeholder' => 'Enter your email', 'required', 'value' => old("email"), 'id' => 'email']) }}
								</div>	
									@if ($errors->has('email'))
									    <span class="help-block">
									        <i>{{ $errors->first('email') }}</i>
									    </span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('contact') ? ' has-error' : '' }}">
								<div class="col-lg-12">
								{{ Form::label('contact', 'Contact number:', ['class' => 'control-label']) }}
									<div class="input-group"><span class="input-group-addon">
									<i class="fa fa-phone"></i></span>
										{{ Form::text('contact', null, ['class' => "form-control ", 'placeholder' => 'Enter your email', 'required', 'value' => old("contact"), 'id' => 'contact']) }}
									</div>	
									@if ($errors->has('contact'))
									    <span class="help-block">
									        <i>{{ $errors->first('contact') }}</i>
									    </span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
								<div class="col-lg-12">
								{{ Form::label('username', 'Username: ', ['class' => 'control-label']) }}
									<div class="input-group"><span class="input-group-addon">
									<i class="fa fa-calendar"></i></span>
										{{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Enter your username' ,'required', 'value' => old('username')]) }}
									</div>
									@if ($errors->has('username'))
									    <span class="help-block">
									        <i>{{ $errors->first('username') }}</i>
									    </span>
									@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
								<div class="col-lg-12">
								{{ Form::label('password', 'Password: ', ['class' => 'control-label']) }}
								<div class="input-group"><span class="input-group-addon">
								<i class="fa fa-key"></i></span>
								{{ Form::password('password', ['class' => "form-control", 'required', 'value' => old("password"), 'placeholder' => 'Enter your password']) }}
								</div>
								@if ($errors->has('password'))
								    <span class="help-block">
								        <i>{{ $errors->first('password') }}</i>
								    </span>
								@endif
								</div>
							</div>
							<hr>
							<div class="form-group">
								<h1 id="additionalinfo"><a href="#"># Additional Info</a></h1>
								<hr>
							</div>
							<div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
								<div class="col-lg-12">
								{{ Form::label('address', 'Address: ', ['class' => 'control-label']) }}
								{{ Form::textarea('address', null, ['class' => "form-control", 'required', 'value' => old("address"), 'style' => 'resize: none', 'rows' => '5', 'id' => 'address']) }}
								@if ($errors->has('address'))
								    <span class="help-block">
								        <i>{{ $errors->first('address') }}</i>
								    </span>
								@endif
								</div>
							</div>
							<div class="form-group {{ $errors->has('image') ? ' has-error ' : '' }}">
								<div class="col-lg-12">
									{{ Form::label('image', 'Profile image', ['class' => 'control-label']) }}
									{{ Form::file('image', ['class' => 'control-label']) }}	
									@if ($errors->has('image'))
									    <span class="help-block">
									        <i>{{ $errors->first('image') }}</i>
									    </span>
									@endif	
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-12">
									<button class="btn btn-success" type="submit"><i class="fa fa-pencil"></i> Update profile</button>
								</div>
							</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection