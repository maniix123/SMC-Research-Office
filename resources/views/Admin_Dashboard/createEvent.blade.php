@extends('admin')
@section('title', "Create Event")

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h4>Create an event</h4>
	</section>
	<section class="content">
		<ol class="breadcrumb">
			<li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="{{ url('Admin/Dashboard/create-event') }}"><i class="fa fa-calendar"></i> Events</a></li>
		</ol>
		<div class="row">
			<div class="col-lg-12">
				<div class="well">
					{{ Form::open(['url' => 'Admin/Dashboard/create-event', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal']) }}
					<div class="form-group {{ $errors->has('eventName') ? ' has-error' : '' }}">
						{{ Form::label('eventName', 'Event Name:', ['class' => 'control-label col-lg-3']) }}
						<div class="col-lg-9">
							<div class="input-group"><span class="input-group-addon">
								<i class="fa fa-user"></i></span>
								{{ Form::text('eventName', '', ['class' => "form-control ", 'placeholder' => 'Enter event name here', 'required', 'autofocus', 'value' => old("eventName")]) }}	
							</div>
							@if ($errors->has('eventName'))
							<span class="help-block">
								<i>{{ $errors->first('eventName') }}</i>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group {{ $errors->has('eventDescription') ? ' has-error' : '' }}">
						{{ Form::label('eventDescription', 'Event description:', ['class' => 'control-label col-lg-3']) }}
						<div class="col-lg-9">
							{{ Form::textarea('eventDescription', '', ['class' => "form-control ", 'placeholder' => 'Enter event description here', 'required', 'value' => old("eventDescription"), 'style' => 'resize: none']) }}	
							@if ($errors->has('eventDescription'))
							<span class="help-block">
								<i>{{ $errors->first('eventDescription') }}</i>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('eventStart', 'Event date start: ', ['class' => 'control-label col-lg-3']) }}
						<div class="col-lg-9">
							<div class="input-group"><span class="input-group-addon">
								<i class="fa fa-calendar"></i></span>
								{{ Form::text('eventStart', '', ['class' => "form-control", 'required', 'value' => old("eventName"), 'id' => 'datetimepicker1', 'placeholder' => 'Event start date']) }}		
							</div>
							@if ($errors->has('eventStart'))
							<span class="help-block">
								<i>{{ $errors->first('eventStart') }}</i>
							</span>
							@endif	
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('eventEnd', 'Event date end: ', ['class' => 'control-label col-lg-3']) }}
						<div class="col-lg-9">
							<div class="input-group"><span class="input-group-addon">
								<i class="fa fa-calendar"></i></span>
								{{ Form::text('eventEnd', '', ['class' => "form-control", 'required', 'value' => old("eventName"), 'id' => 'datetimepicker2', 'placeholder' => 'Event end date']) }}
							</div>
							@if ($errors->has('eventEnd'))
							<span class="help-block">
								<i>{{ $errors->first('eventEnd') }}</i>
							</span>
							@endif	
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-9 col-lg-offset-3">
							<button class="btn btn-success"><i class="fa fa-check"></i> Create Event</button>
						</div>
					</div>
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