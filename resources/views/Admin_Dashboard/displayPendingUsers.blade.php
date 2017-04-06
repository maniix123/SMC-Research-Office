@extends('admin')
@section('title', "Pending Users")
@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h4>Pending Users</h4>
	</section>
	<section class="content">
		<ol class="breadcrumb">
			<li class="active"><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#"><i class="fa fa-user"></i> Users</a></li>
		</ol>
		<div class="well">
			<div class="table-responsive">
				<table class = "table" id="example">
					<thead>
						<tr>
							<th>ID #</th>
							<th>Name</th>
							<th>Email</th>
							<th>Username</th>
							<th>Password</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pendings as $pending)
						<?php
						if($pending->pending_status == 'accepted') $labelClass = 'label-success';
						else if($pending->pending_status == 'rejected') $labelClass = 'label-danger';
						else $labelClass = 'label-info';
						?>
						<tr>
							<td>{{ $pending->id }}</td>
							<td><a href="{{ url('Admin/Profile/' .$pending->id) }}">{{ $pending->name }}</a></td>
							<td>{{ $pending->email }}</td>
							<td>{{ $pending->username }}</td>
							<td>**********</td>
							<td><label class="label {{ $labelClass }}">{{ $pending->pending_status }}</label></td>
							<td class="text-center">
							<button class="btn  btn-info btn-xs {{ (($pending->pending_status == 'accepted' || $pending->pending_status == 'rejected') ? 'hide' : '') }}"  onclick="acceptUser({{$pending->id}}, '{{ $pending->name }}')"><i class="fa fa-check"></i> Accept</button>
								<button class="btn  btn-danger btn-xs {{ (($pending->pending_status == 'accepted' || $pending->pending_status == 'rejected') ? 'hide' : '') }}" onclick="rejectUser({{$pending->id}},'{{$pending->name}}')"><i class="fa fa-trash"></i> Reject</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section>
</div>
{{ Html::style('https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css') }}
{{ Html::script('https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js') }}
{{ Html::script('https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js') }}
{{ Html::style('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css') }}
{{ Html::script('//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}
{{ Html::script('//js.pusher.com/3.1/pusher.js') }}
@include('partials.adminScripts')
<script>
	$(document).ready(function(){
		$('#example').DataTable();
	});
	function acceptUser(id, name)
	{
		if(confirm('Are you sure you want to accept ' +name+ '?'))
		{
			$.ajax({
				dataType: "json",
				url: '/Admin/AcceptUsers/' +id,
				success: function (result) 
				{
					alert(name + '\'s account has been accepted.');
					location.reload(true);
				},
			});
		}
	}
	function rejectUser(id, name)
	{
		if(confirm('Are you sure you want to reject ' +name+ '?'))
		{
			$.ajax({
				dataType: "json",
				url: '/Admin/RejectUsers/' +id,
				success: function (result) 
				{
					alert(name + '\'s account has been rejected.');
					location.reload(true);
				},
			});
		}
	}
</script>
@endsection