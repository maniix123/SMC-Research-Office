@extends('admin')
@section('title', 'Edit event')

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h4>Edit <b>{{ $event->title }}</b></h4>
	</section>
	<section class="content">
		<ol class="breadcrumb">
			<li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="{{ url('Admin/Dashboard/create-event') }}"><i class="fa fa-calendar"></i> Events</a></li>
		</ol>
		<div class="row">
			<div class="col-lg-6">
				<div class="well">
					{{ Form::model($event, ['url' => 'Admin/Dashboard/' . $event->id, 'method' => 'PUT', 'role' => 'form', 'class' => 'form-horizontal']) }}
					<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
						{{ Form::label('title', 'Event Name:', ['class' => 'control-label col-lg-3']) }}
						<div class="col-lg-9">
							<div class="input-group"><span class="input-group-addon">
								<i class="fa fa-user"></i></span>
								{{ Form::text('title', null, ['class' => "form-control ", 'placeholder' => 'Enter event name here', 'required', 'autofocus', 'value' => old("title")]) }}	
							</div>
							@if ($errors->has('title'))
							<span class="help-block">
								<i>{{ $errors->first('title') }}</i>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
						{{ Form::label('description', 'Event description:', ['class' => 'control-label col-lg-3']) }}
						<div class="col-lg-9">
							{{ Form::textarea('description', null, ['class' => "form-control ", 'placeholder' => 'Enter event description here', 'required', 'value' => old("description"), 'style' => 'resize: none']) }}	
							@if ($errors->has('description'))
							<span class="help-block">
								<i>{{ $errors->first('description') }}</i>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('start', 'Event date start: ', ['class' => 'control-label col-lg-3']) }}
						<div class="col-lg-9">
							<div class="input-group"><span class="input-group-addon">
								<i class="fa fa-calendar"></i></span>
								{{ Form::text('start', null, ['class' => "form-control", 'required', 'value' => old("start"), 'id' => 'datetimepicker1']) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('end', 'Event date end: ', ['class' => 'control-label col-lg-3']) }}
						<div class="col-lg-9">
							<div class="input-group"><span class="input-group-addon">
								<i class="fa fa-calendar"></i></span>
								{{ Form::text('end', null, ['class' => "form-control", 'required', 'value' => old("end"), 'id' => 'datetimepicker2']) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-9 col-lg-offset-3">
							<button class="btn btn-success" type="submit"><i class="fa fa-pencil"></i> Update event</button>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
			<div class="col-lg-6">
				<div class="well">
					<h1 class="text-center">Or just delete the event</h1>
					<h5 class="text-center text-danger">(Warning: This can't be undone.)</h5>
					{{ Form::open(['url' => 'Admin/Dashboard/' . $event->id, 'method' => 'DELETE', 'role' => 'form', 'class' => 'form-horizontal']) }}
					<button class="btn btn-danger btn-block" type="submit"><i class="fa fa-trash"></i> Delete event</button>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</section>
</div>
{{ Html::script('plugins/datepicker/js/bootstrap-datepicker.js') }}
{{ Html::style('plugins/datepicker/css/bootstrap-datepicker.min.css') }}
{{ Html::script('plugins/daterangepicker/moment.min.js') }}
{{ Html::style('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}
{{ Html::script('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}
{{ Html::script('//js.pusher.com/3.1/pusher.js') }}
@include('partials.adminScripts')
<script>
	$(function () {
		$.fn.datepicker.defaults.format = "yyyy-mm-dd";
		$.fn.datepicker.defaults.autoclose = true;
		$.fn.datepicker.defaults.clearBtn = true;
		$.fn.datepicker.defaults.changeMonth = true;
		$.fn.datepicker.defaults.todayHighlight = true;
		$.fn.datepicker.defaults.startDate = 'today';
		$.fn.datepicker.defaults.orientation = 'auto';
		$('#datetimepicker1').datepicker();
		$('#datetimepicker2').datepicker();
	});
</script>
@endsection