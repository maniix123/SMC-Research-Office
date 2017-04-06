@extends('admin')
@section('title', 'User Profile')
@section('content')
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
				<li class="active"><a href="#"><i class="fa fa-user"></i> Profile</a></li>
			</ol>
			<div class="col-lg-12">
				@if($message = Session::get('message'))
				<div class="alert alert-info">
					<p class="text-center">{{ $message }}</p>
				</div>
				@endif
			</div>
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-body box-profile">
						<img src="{{ $user->image }}" alt="" class="profile-user-img img-responsive img-circle">
						<h3 class="profile-username text-center">{{ $user->name }}</h3>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Member since:</b>
								<a href="javascript:void(0)" class="pull-right">{{ $user->created_at->diffForHumans() }}</a>
							</li>
							<li class="list-group-item">
								<b>Number of posts</b>
								<a href="javascript:void(0)" class="pull-right">{{ $user->posts->count() }}</a>
							</li>
							<li class="list-group-item">
								<b>User Type: </b>
								<a href="javascript:void(0)" class="pull-right">{{ $user->type }}</a>
							</li>
						</ul>
						@if(Auth::id() !== $user->id)

						@else
						<a href="{{ url('Admin/Profile/'.$user->id.'/edit') }}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit Profile</a>
						@endif
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">About Me</h3>
					</div>
					<div class="box-body">
						<a href="{{ url('Admin/Profile/'.$user->id.'/edit') }}" class="pull-right {{ (Auth::id() !== $user->id) ? 'hide' : '' }}">Edit</a>
						<strong><i class="fa fa-book"></i> Course</strong>
						<p class="text-muted">{{ $user->course ? $user->course : 'Nothing here' }}</p>
						<hr>
						<a href="{{ url('Admin/Profile/'.$user->id.'/edit#address') }}" class="pull-right {{ (Auth::id() !== $user->id) ? 'hide' : '' }}">Edit</a>
						<strong><i class="fa fa-map-marker "></i> Address</strong>
						<p class="text-muted">{{ $user->address ? $user->address : 'Nothing here' }}</p>
						<hr>
						<a href="{{ url('Admin/Profile/'.$user->id.'/edit#contact') }}" class="pull-right {{ (Auth::id() !== $user->id) ? 'hide' : '' }}">Edit</a>
						<strong><i class="fa fa-mobile"></i> Contact</strong>
						<p class="text-muted">{{ $user->contact ? $user->contact : 'Nothing here' }}</p>
						<hr>
						<a href="{{ url('Admin/Profile/'.$user->id.'/edit#email') }}" class="pull-right {{ (Auth::id() !== $user->id) ? 'hide' : '' }}">Edit</a>
						<strong><i class="fa fa-envelope-o"></i> Email</strong>
						<p class="text-muted">{{ $user->email }}</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="well">
					<h3 class="text-center">Journals/Researches by {{ $user->name }}</h3>
					<hr>
					@if(count($user->posts) == 0)
						<p class="text-center">This user doesn't have any Journals or Researches </p>
					@else
						@foreach($user->posts as $post)
							<h3 class="proposal">{{ $post->proposal }}</h3>
							<p>Abstract: </p>
							<blockquote><i>"{{ $post->abstract }}"</i></blockquote>
							<p>Author: <i class="fa fa-book" aria-hidden="true"></i> {{ $post->author }}</p>
							<p>School Year: <i class = "fa fa-calendar" aria-hidden="true"></i> {{ $post->schoolyear }}</p>
							<hr>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</section>
</div>
{{ Html::script('plugins/daterangepicker/moment.min.js') }}
{{ Html::style('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}
{{ Html::script('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}
{{ Html::script('//js.pusher.com/3.1/pusher.js') }}
@include('partials.adminScripts')
@endsection