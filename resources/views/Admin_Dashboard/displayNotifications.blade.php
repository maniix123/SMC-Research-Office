@extends('admin')
@section('title', "Notifications")

@section('content')
<div class="content-wrapper">
	<section class="content">
		<ol class="breadcrumb">
			<li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><a href="#"><i class="fa fa-globe"></i> Notifications</a></li>
		</ol>
		<div class="well">
			<div class="row">
				<div class="col-lg-12">
					<a href="javascript:void(0)" class="pull-right" onclick="markAllRead()">Mark all as read</a>
					<p>Legend: <i class="fa fa-circle text-blue"></i> = Read <i class="fa fa-circle text-red"></i> = Unread</p>
					<hr>
				</div>
				@if(count($notificationsBody) == 0)
					<div class="col-lg-12">
						<h1 class="text-center">You have no notifications yet.</h1>
					</div>
				@else
					@foreach($notificationsBody as $n)
					<div class="col-lg-12 customWell">
						<a href="{{ (strpos($n->action, 'logged in') !== false) ? 'javascript:void(0)' : $n->URL }}">
							<p class="pull-right">{{ $n->created_at->diffForHumans() }}</p>
							<p><i class="fa fa-circle {{ ($n->is_read == 'false') ? 'text-red' : 'text-blue' }}"></i> {{ $n->action }}</p>
							<p><small>{{ $n->created_at->format('D M-d-Y') }}</small></p>
						</a>
					</div>
					@endforeach
				@endif
			</div>

		</div>
	</section>
</div>
{{ Html::script('plugins/daterangepicker/moment.min.js') }}
{{ Html::style('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}
{{ Html::script('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}
{{ Html::script('//js.pusher.com/3.1/pusher.js') }}
@include('partials.adminScripts')
<script>
	function markAllRead()
	{
		if(confirm("Are you sure to mark all as read?"))
		{
			$.ajax({
				url: '/Admin/markAllAsRead',
				success: function(fuck)
				{
					location.reload();
				},
				error: function()
				{
					alert('Something bad happened!');
				}
			});
		}
	}
</script>
@endsection