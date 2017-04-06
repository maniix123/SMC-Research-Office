@extends('admin')
@section('title', " Admin Dashboard")

@section('content')
<div class="content-wrapper">
	<section class="content">
		<ol class="breadcrumb">
			<li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#"><i class="fa fa-users"></i> Users</a></li>
		</ol>
		<div class="well">
			<div class="table-responsive">
				<table class = "table" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Imge</th>
							<th>Name</th>
							<th>Email</th>
							<th>Contact</th>		
							<th>Number of Posts</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td><a href="{{ url('Admin/Profile/' .$user->id) }}" target="_blank"><img src="{{ $user->image }}" alt="" class="img-thumbnail img-responsive" width="50" height="50"></a></td>
								<td><a href="{{ url('Admin/Profile/' .$user->id) }}" target="_blank">{{ $user->name }}</a></td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->contact }}</td>
								<td>{{ $user->posts->count() }} posts</td>
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
</script>
@endsection