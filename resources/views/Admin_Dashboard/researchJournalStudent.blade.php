@extends('admin')
@section('title', 'Research Journals - Students')
@section('content')
<?php
if($name == 'CECS'){
	$department = 'College of Engineering and Computer Studies';
}
else if($name == 'CAS'){
	$department = 'College of Arts and Sciences';
}
else if($name == 'CON'){
	$department = 'College of Nursing';
}
else if($name == 'COC'){
	$department = 'College of Criminology';
}
else if($name == 'CED'){
	$department = 'College of Education';
}
else if($name == 'CHRM'){
	$department = 'College of Hotel and Retaurant Management';
}
else if($name == 'COA'){
	$department = 'College of Accountancy';
}
else if($name == 'CBA'){
	$department = 'College of Business Administration';
}
?>
<div class="content-wrapper">
	<section class="content">
		<ol class="breadcrumb">
			<li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#"><i class="fa fa-book"></i> Research Journal</a></li>
			<li><a href="#"><i class="fa fa-users"></i> Student</a></li>
			<li><a href="#"><i class="fa fa-graduation-cap"></i> {{ $department }}</a></li>
		</ol>
		<div class="row">
			<div class="col-lg-8">
				<div class="well">
					@if (Session::get('message'))
					<div class="alert alert-info text-center">
						{{ session('message') }}
					</div>
					@endif
					<h3 class="text-center">Research Journals by {{ $department }}</h3>
					<hr class="border">
					@if(count($posts) == 0)
					<h3 class="text-center">No posts found</h3>
					@else
					<h3>Search here:</h3>
					<div class="row">
						<div class="col-lg-5">
							<div class="form-group">
								<div class="input-group"><span class="input-group-addon">
									<i class="fa fa-search"></i></span>
									<input type="text" name="Search" id="searchInput" placeholder="Type something here" class="form-control">
								</div>
							</div>					
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<select name="search" id="optionSelect" class="form-control selectpicker" data-live-search="true">
									<option value="">Choose a filter here</option>
									<option value="author">Author</option>
									<option value="proposal">Proposal</option>
									<option value="schoolyear">School Year</option>
									<option value="abstract">Abstract</option>
								</select>
							</div>					
						</div>
						<div class="col-lg-2">
							<div class="form-group">
							<button class="btn btn-primary btn-block btn-sm" onclick="searchJournalsForStudents('Research Journal', 'Student', '{{ $name }}')"><i class="fa fa-search"></i> Search</button>
							</div>					
						</div>
					</div>
					<div id="posts">
						@foreach($posts as $post)
						<h3 class="proposal">{{ $post->proposal }}</h3>
						<p>Abstract: </p>
						<blockquote><i>"{{ $post->abstract }}"</i></blockquote>
						<p>Authors: <i class="fa fa-book" aria-hidden="true"></i> {{ $post->author }}</p>
						<p>College: <i class="fa fa-graduation-cap"></i>{{ $post->college }}</p>
						<p>School Year: <i class = "fa fa-calendar" aria-hidden="true"></i> {{ $post->schoolyear }}</p>
						<p>Posted by: <i class="fa fa-user" aria-hidden="true"></i> {{ $post->user->name }}</p>
						<hr>
						@endforeach
						{!! $posts->render() !!}
					</div>
					<div class="search_results hide">
					</div>
					@endif
				</div>
			</div>
			<div class="col-lg-4">
				<div class="well posts">
					<h2 class="text-center">Add new post here</h2>
					{{ Form::open(['method' => 'post', 'url' => 'Admin/storePost'], ['class' => 'form-control', 'role' => 'form']) }}
					<div class="form-group {{ $errors->has('author') ? ' has-error has-feedback' : '' }}">
						{{ Form::label('author', 'Authors:', ['class' => 'control-label']) }}
						<div class="input-group"><span class="input-group-addon">
							<i class="fa fa-user"></i></span>
							{{ Form::text('author', '',array('class' => 'form-control', 'placeholder' => 'Enter author names', 'autofocus' => 'autofocus', 'required', 'value' => old('author'))) }}
						</div>					
						@if ($errors->has('author'))
						<span class="help-block">
							<i>{{ $errors->first('author') }}</i>
						</span>
						@endif				
					</div>
					<div class="form-group {{ $errors->has('proposal') ? ' has-error has-feedback' : '' }}">
						{{ Form::label('label', 'Proposal:', ['class' => 'control-label']) }}
						<div class="input-group"><span class="input-group-addon">
							<i class="fa fa-book"></i></span>
							{{ Form::text('proposal', '',array('class' => 'form-control', 'placeholder' => 'Enter proposal', 'required', 'value' => old('proposal'))) }}
						</div>					
						@if ($errors->has('proposal'))
						<span class="help-block">
							<i>{{ $errors->first('proposal') }}</i>
						</span>
						@endif			
					</div>
					<div class="form-group {{ $errors->has('abstract') ? ' has-error has-feedback' : '' }}">
						{{ Form::label('label', 'Abstract:', ['class' => 'control-label']) }}					
						{{ Form::textarea('abstract', '',array('class' => 'form-control', 'placeholder' => 'Enter abstract here', 'style' => 'resize: none', 'rows' => '6', 'cols' => '20', 'required', 'value' => old('abstract'))) }}	
						@if ($errors->has('abstract'))
						<span class="help-block">
							<i>{{ $errors->first('abstract') }}</i>
						</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('schoolyear') ? ' has-error has-feedback' : '' }}">
						{{ Form::label('label', 'School Year:', ['class' => 'control-label']) }}
						<select class="form-control" required="required" name='schoolyear'>
							<option value="">Select school year</option>
							@for($i = date('Y'); $i <= (date('Y') +10); $i++)
							<option value="{{ $i }} - {{ $i+1 }}">{{ $i }} - {{ $i+1 }}</option>
							@endfor
						</select>					
						@if ($errors->has('schoolyear'))
						<span class="help-block">
							<i>{{ $errors->first('schoolyear') }}</i>
						</span>
						@endif
					</div>		
					<div class="form-group">				
						<button class="btn btn-primary" {{ (Auth::user()->college == strtoupper($department) || Auth::user()->role == 'Super Admin') ? "" : "disabled" }}><i class="fa fa-check"></i> Submit for review</button>
					</div>
					{{ Form::hidden('college', strtoupper($department)) }}
					{{ Form::hidden('collegeAbbvr', $name) }}
					{{ Form::hidden('tab', 'Research Journal') }}
					{{ Form::hidden('type', 'Student') }}	
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</section>
</div>
@endsection