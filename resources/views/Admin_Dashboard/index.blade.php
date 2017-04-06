@extends('admin')
@section('title', " Admin Dashboard")

@section('content')
<div class="content-wrapper"><!-- Content wrapper! -->
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h4>Welcome {{ Auth::user()->name }}</h4>
	</section>
	<section class="content"><!-- Here goes the CONTENT! -->
		@if($alert = Session::get('Error message'))
			<h4 class="text-center"><label class="label label-danger">{{ $alert }}</label></h4>
		@elseif($alert = Session::get('remarks'))
			<h4 class="text-center"><label class="label label-primary">{{ $alert }}</label></h4>
		@elseif($alert = Session::get('message'))
			<h4 class="text-center"><label class="label label-info">{{ $alert }}</label></h4>
		@endif
		@if(Auth::user()->role == 'Super Admin')
			@include('Admin_Dashboard.superAdminContent')
		@else
			@include('Admin_Dashboard.notAdminContent')
		@endif
		<div class="row"><!-- Calendar dire -->
			<div class="col-lg-12 col-sm-12 col-xs-12">
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">Calendar</h3>
						<div class="box-tools pull-right">
							<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Colapse"><i class="fa fa-minus"></i></button>
							<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body" id="calendar">	
						<a href="{{ url('Admin/Dashboard/create-event') }}" class="btn btn-info btn-block {{ (Auth::user()->role == 'Super Admin') ? '' : 'hide' }}">Create event</a>
						@if($alert = Session::get('Event'))
						<h4 class="text-center"><label class="label label-success">{{ $alert }}</label></h4>
						@endif
					</div>
				</div>					
			</div>
		</div><!-- End of Calendar -->
		<div id="fullCalModal" class="modal fade"><!-- Modal dire. -->
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header bg-aqua">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
						<h1 class="modal-title text-center">Event details:</h1>
					</div>
					<div class="modal-body bg-olive">
						<div class="table-responsive">
							<table class="table unbordered table-striped">
								<tr>
									<th class="bg-red">Event Name</th>
									<th class="bg-red">Event Description</th>
								</tr>
								<tr>
									<td><span id="modalTitle"></span></td>
									<td><span id="modalBody"></span></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="modal-footer bg-light-blue">
						<a id="eventUrl" class="btn btn-success"><i class="fa fa-pencil"></i> Edit event</a>
						<button type="button" class="btn btn-info bg-primary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					</div>
				</div>
			</div>
		</div><!-- End of Modal -->
	</section><!-- END OF THE CONTENT! -->
</div>
{{ Html::style('plugins/fullcalendar/fullcalendar.css') }}
{{ Html::script('plugins/daterangepicker/moment.min.js') }}
{{ Html::script('plugins/fullcalendar/fullcalendar.js') }}
{{ Html::style('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}
{{ Html::script('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}
{{ Html::script('//js.pusher.com/3.1/pusher.js') }}
@include('partials.adminScripts')
<script>
	$(document).ready(function(){
		$('#calendar').fullCalendar({
			header: {
				left:   'today prev,next',
				center: '',
				right:  'title month basicWeek basicDay prevYear nextYear'
			}, 
			timezone : 'Asia/Manila',
			allDay : true,
			editable: true,
	        events: '/events/events-json', //dire gikan ang mga events..
	        eventClick : function(event, jsEvent, view)
	        {
	        	$('#modalTitle').html(event.title);
	        	$('#modalBody').html(event.description);
	        	$('#eventUrl').attr('href', '/Admin/Dashboard/'+event.id+'/edit');
	        	$('#fullCalModal').modal();
	        },
	        eventResize : function(event, delta, revertFunc)
	        {
	        	var id = event.id;
	        	var title = event.title;
	        	var start = event.start.format();
	        	var end = (event.end == null) ? event.start.format() : event.end.format();
	        	$.ajax({
	        		url : '/event/resize/id/'+id+'/start/'+start+'/end/'+end,
	        		type: 'get',
	        		dataType : 'json',
	        		success : function(response){
	        			if(response.status != 'success')
	        			{
	        				revertFunc();
	        			}
	        			else
	        			{
	        				alert('Successfully edited event date');
	        			}
	        		},
	        		error : function(e){
	        			revertFunc();
	        			alert('You are not authorized to do that!');
	        		}
	        	});
	        },
	        eventDrop: function(event, delta, revertFunc) 
	        {
	        	if (!confirm("Are you sure about this change?")) {
	        		revertFunc();
	        	}
	        	else
	        	{
	        		var id = event.id;
	        		var title = event.title;
	        		var start = event.start.format();
	        		var end = (event.end == null) ? event.start.format() : event.end.format();
	        		$.ajax({
	        			url : '/event/drag/id/'+id+'/start/'+start+'/end/'+end,
	        			type: 'get',
	        			dataType : 'json',
	        			success : function(response){
	        				if(response.status != 'success')
	        				{
	        					revertFunc();
	        				}
	        				else
	        				{
	        					alert('Successfully dragged event');
	        				}
	        			},
	        			error : function(e){
	        				revertFunc();
	        				alert('You are not authorized to do that!');
	        			}
	        		});
	        	}
	        },
	    });
	});
</script>
@endsection