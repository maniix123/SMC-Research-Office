@extends('admin')
@section('title', "Journal Review")

@section('content')
<div class="content-wrapper">
	<section class="content">
		<ol class="breadcrumb">
			<li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><a href="#"><i class="fa fa-book"></i> Journal Review</a></li>
		</ol>
		<div class="row">
			<div class="col-lg-7">
				<div class="well">
					@if($alert = Session::get('remarks'))
					<h4 class="text-center"><label class="label label-danger">{{ $alert }}</label></h4>
					@endif
					<div class="row">
						<h4 class="text-center">Submitted by: {{ $post->user->name }}</h4>
						<hr>
						<div class="col-lg-4 col-sm-4 col-xs-4">
							<img src="{{ $post->user->image }}" alt="" class="img-thumbnail">
						</div>
						<div class="col-lg-8 col-sm-4 col-xs-8">
							<p><b>Name:</b> {{ $post->user->name }}</p>
							<p><b>Member since:</b> {{ $post->user->created_at->diffForHumans() }}</p>
							<p><b>Number of posts:</b> {{ $post->count() }}</p>
							<p><b>User type:</b> {{ $post->user->type }}</p>
						</div>
					</div>
					<hr>
					<h2>{{ $post->proposal }}</h2>
					<p><b>Abstract:</b></p>
					<blockquote>
						<p><i>{{ $post->abstract }}</i></p>
					</blockquote>
					<p><i class="fa fa-user"></i> <b>Author:</b> {{ $post->author }}</p>
					<p class="{{ ($post->course) != NULL ? $post->course : 'hide' }}"><i class="fa fa-graduation-cap"></i> <b>Course:</b> {{ $post->course }}</p>
					<p class="{{ ($post->college) != NULL ? $post->college : 'hide' }}"><i class="fa fa-graduation-cap"></i> <b>College:</b> {{ $post->college }}</p>
					<p><i class="fa fa-calendar"></i> <b>School Year:</b> {{ $post->schoolyear }}</p>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="well">
					<h2 class="text-center">Select your action here:</h2>
					<div class="row">
						<div class="col-lg-12">
							{{ Form::open(['url' => 'Admin/PostAction/' . $post->id, 'method' => 'POST']) }}
							<div class="form-group">
								<div class="btn-group btn-group-justified">
									<a href="javascript:void(0)" class="btn btn-default btn-sm" onclick="displayTextarea()"><i class="fa fa-pencil"></i> Add remark</a>
									<a href="javascript:void(0)" class="btn btn-default btn-sm" onclick="acceptProposal()"><i class="fa fa-check"></i> Accept proposal</a>
								</div>
							</div>
							<div class="form-group" id="formFields"></div>
							{{ Form::close() }}	
						</div>
					</div>
				</div>
				<div class="well">
					<h4 class="text-center">Previous Remarks:</h4>
					<ul class="list-group">
						@if(count($post->postRemarks) == 0)
							<li class="list-group-item">No remarks yet.</li>
						@else
							@foreach($post->postRemarks as $postRemark)
								<li class="list-group-item text-red">{{ $postRemark->remark_name }}</li>
							@endforeach
						@endif
					</ul>
				</div>
			</div>
		</div>
	</section>
</div>
{{ Html::style('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}
{{ Html::script('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}
{{ Html::script('//js.pusher.com/3.1/pusher.js') }}
@include('partials.adminScripts')
<script>
	function displayTextarea()
	{
		$('#formFields').empty();
		$('<div class="form-group"><textarea name="remark" id="" placeholder="Type in your remark here" class="form-control" rows="6" style="resize: none;" required></textarea></div><button class="btn btn-info"><i class="fa fa-check"></i> Submit</button>').appendTo('#formFields');

	}
	function acceptProposal()
	{
		$('#formFields').empty();
		$('<h3 class="text-center"><label class="label label-default bg-yellow">Proposal will be accepted</label></h3><input type="hidden" name="action" value="Accept Proposal"><button class="btn btn-info"><i class="fa fa-check"></i> Submit</button>').appendTo('#formFields');
	}
</script>
@endsection