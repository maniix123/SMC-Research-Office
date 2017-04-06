@extends('main')
@section('title', "Research Journals - Students")
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
<div class="container college {{ $name }}">
	<div class="row">
		<div class="col-lg-12">
			<div class="well">
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
							<button class="btn btn-primary btn-block" onclick="searchJournalsForStudents('Research Journal', 'Student', '{{ $name }}')"><i class="fa fa-search"></i> Search</button>
						</div>					
					</div>
				</div>
				{{ Form::hidden('department', $name, array('class' => 'form-control', 'id' => 'department')) }}
				<div id="posts">
					@foreach($posts as $post)
					<div class="hvr-float-shadow">
						<h3 class="proposal">{{ $post->proposal }}</h3>
						<p>Abstract: </p>
						<blockquote><i>"{{ $post->abstract }}"</i></blockquote>
						<p>Authors: <i class="fa fa-book" aria-hidden="true"></i> {{ $post->authors }}</p>
						<p>Department: {{ $post->course }}</p>
						<p>School Year: <i class = "fa fa-calendar" aria-hidden="true"></i> {{ $post->schoolyear }}</p>
						<p>Posted by: <i class="fa fa-user" aria-hidden="true"></i> {{ $post->user->name }}</p>
						<hr>
					</div>
					@endforeach
					{{ $posts->render() }}
				</div>
				<div class="search_results hide">
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection