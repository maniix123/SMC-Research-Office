@extends('admin')
@section('title', "All Journals/Researches")

@section('content')
<div class="content-wrapper">
	<section class="content">
		<ol class="breadcrumb">
			<li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><a href="#"><i class="fa fa-pencil"></i> All Pots</a></li>
		</ol>
		<div class="well">
			<div class="row">
				<div class="col-lg-8 col-md-8">
					@foreach($groupedPost as $posts => $groupedPostArray)
					<h4 id="{{ $posts }}"><b># SchoolYear: {{ $posts }}</b> <span class="badge bg-teal">{{count($groupedPostArray)}}</span></h4>
					<hr>
					<div class="row">
						@foreach($groupedPostArray as $f)
						<div class="col-lg-12">
							<div class="customDiv">
								<h3>Proposal: <i class="fa fa-book"></i> {{ $f->proposal }}</h3>
								<p>Author(s): <i class="fa fa-user"></i> {{ $f->author }}</p>
								<blockquote>
									<i>{{ $f->abstract }}</i>
								</blockquote>
								<p>SchoolYear: <i class="fa fa-calendar"></i> {{ $f->schoolyear }}</p>
								<p class="{{ ($f->course !== null) ? '' : 'hide' }}">College: {{ $f->course }}</p>
								<p class="{{ ($f->college !== null) ? '' : 'hide' }}">Department: {{ $f->college }}</p>
								<p>Type: {{ $f->tab }}</p>			
							</div>
						</div>
						@endforeach
					</div>
					<hr>
					@endforeach
				</div>
				<div class="col-lg-3 col-md-3 floating-menu">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center"><i class="fa fa-archive text-aqua" aria-hidden="true"></i> Archives</h4>
						</div>
						<div class="panel-body">
							<ul class="list-group">
								@foreach($groupedPost as $posts => $groupedPostArray)
								<li class="list-group-item"><p><a href="#{{$posts}}">{{$posts}}</a></p></li>
								@endforeach
							</ul>
						</div>
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