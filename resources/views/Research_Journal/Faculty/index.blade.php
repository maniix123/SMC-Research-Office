@extends('main')
@section('content')
@section('title', "Research Journals - Faculty")
<div class="container body">
	<div class="row">
		<div class="col-lg-12">
			<div class="well">
				<h3 class="text-center">Research Journals by SMC Faculty</h3>
				<hr class="border">
				@if($posts->count() == 0)
				<h3 class="text-center">No posts found</h3>
				@else
				<h3>Search Here:</h3>
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
							<button class="btn btn-primary btn-block" onclick="searchJournals('Research Journal', 'Faculty')"><i class="fa fa-search"></i> Search</button>
						</div>					
					</div>
				</div>
				<div id="posts">
					@foreach($posts as $post)
					<div class="hvr-float-shadow">
						<h3 class="proposal">{{ $post->proposal }}</h3>
						<p>Abstract: </p>
						<blockquote><i>"{{ $post->abstract }}"</i></blockquote>
						<p>Author: <i class="fa fa-book" aria-hidden="true"></i> {{ $post->author }}</p>
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