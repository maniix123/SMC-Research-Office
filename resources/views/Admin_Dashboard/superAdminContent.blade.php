<div class="row"><!-- User display here -->
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active"><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
		</ol>
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title text-center">List of other users <label class="label label-info">{{ $users->count() }}</label></h3> 
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body">
				@if(count($users) == 0)
				<h1 class="text-center">You are currently the only user</h1>
				@else
				<ul class="users-list clearfix">
					@foreach($users as $user)
					<li>
						<a href="{{ url('Admin/Profile/' . $user->id) }}"><img src="{{ $user->image }}" alt="" class="img-thumbnail"></a>
						<a href="javascript:void(0)" class="users-list-name">{{ $user->name }}</a>
						<p class="users-list-name">Number of posts: {{ $user->posts()->count() }}</p>
						<span class="users-list-date">Member since: {{ $user->created_at->format('M d, Y') }}</span>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
			<div class="box-footer text-center">
				<a href="{{ url('Admin/Users') }}">View all</a>
			</div>
		</div>
	</div>
</div><!-- End of user display-->
<div class="row">
	<div class="col-lg-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<p class="box-title"><small>Research Journals by SMC Faculty</small></p>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body custom-box-body">
				@if(count($RjFposts) == 0)
				<h3 class="text-center">There are no posts yet :)</h3>
				@else
				<ul class="products-list product-list-in-box testing-custom-list">
					@foreach($RjFposts as $RjFpost)
					<li class="item">
						<div class="product-img">
							<img src="{{ $RjFpost->user->image}}" alt="" class="img-circle">
						</div>
						<div class="product-info">
							<a href="javascript:void(0)" class="product-title">Title: {{ $RjFpost->proposal }}</a>
							<span class="product-description">
								<b>Abstract:</b> {{ $RjFpost->abstract }}
							</span>
							<span class="product-description">
								<b>Author:</b> {{ $RjFpost->author }}
							</span>
							<span class="product-description">
								<b>Posted by: </b><span style="white-space: normal">{{ $RjFpost->user->name }}</span>
							</span>
							<span class="product-description">
								<b>Posted: </b> {{ $RjFpost->created_at->diffForHumans() }}
							</span>
						</div>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
			<div class="box-footer text-center">
				<a href="{{ url('Admin/Research-Journal/Faculty') }}">View all posts</a>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<p class="box-title"><small>Research Journals by Students</small></p>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body custom-box-body">
				@if(count($RjSposts) == 0)
				<h3 class="text-center">There are no posts yet :)</h3>
				@else
				<ul class="products-list product-list-in-box testing-custom-list">
					@foreach($RjSposts as $RjSpost)
					<li class="item">
						<div class="product-img">
							<img src="{{ $RjSpost->user->image}}" alt="" class="img-circle">
						</div>
						<div class="product-info">
							<a href="javascript:void(0)" class="product-title">Title: {{ $RjSpost->proposal }}</a>
							<span class="product-description">
								<b>Abstract:</b> {{ $RjSpost->abstract }}
							</span>
							<span class="product-description">
								<b>Author:</b> {{ $RjSpost->author }}
							</span>
							<span class="product-description">
								<b>Course: </b> {{ $RjSpost->course }}
							</span>
							<span class="product-description">
								<b>Posted by: </b><span style="white-space: normal">{{ $RjSpost->user->name }}</span>
							</span>
							<span class="product-description">
								<b>Posted: </b> {{ $RjSpost->created_at->diffForHumans() }}
							</span>
						</div>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
			<div class="box-footer text-center">
				<a href="{{ url('Admin/Research-Journal/Student/CECS') }}">View all posts</a>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<p class="box-title"><small>Institutional Researches by SMC Faculty</small></p>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body custom-box-body">
				@if(count($IrFposts) == 0)
				<h3 class="text-center">There are no posts yet :)</h3>
				@else
				<ul class="products-list product-list-in-box testing-custom-list">
					@foreach($IrFposts as $IrFpost)
					<li class="item">
						<div class="product-img">
							<img src="{{ $IrFpost->user->image}}" alt="" class="img-circle">
						</div>
						<div class="product-info">
							<a href="javascript:void(0)" class="product-title">Title: {{ $IrFpost->proposal }}</a>
							<span class="product-description">
								<b>Abstract:</b> {{ $IrFpost->abstract }}
							</span>
							<span class="product-description">
								<b>Author:</b> {{ $IrFpost->author }}
							</span>
							<span class="product-description">
								<b>Posted by: </b><span style="white-space: normal">{{ $IrFpost->user->name }}</span>
							</span>
							<span class="product-description">
								<b>Posted: </b> {{ $IrFpost->created_at->diffForHumans() }}
							</span>
						</div>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
			<div class="box-footer text-center">
				<a href="{{ url('Admin/Institutional-Research/Faculty') }}">View all posts</a>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<p class="box-title"><small>Institutional Researches by SMC Staff</small></p>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body custom-box-body">
				@if(count($IrSposts) == 0)
				<h3 class="text-center">There are no posts yet :)</h3>
				@else
				<ul class="products-list product-list-in-box testing-custom-list">
					@foreach($IrSposts as $IrSpost)
					<li class="item">
						<div class="product-img">
							<img src="{{ $IrSpost->user->image}}" alt="" class="img-circle">
						</div>
						<div class="product-info">
							<a href="javascript:void(0)" class="product-title">Title: {{ $IrSpost->proposal }}</a>
							<span class="product-description">
								<b>Abstract:</b> {{ $IrSpost->abstract }}
							</span>
							<span class="product-description">
								<b>Author:</b> {{ $IrSpost->author }}
							</span>
							<span class="product-description">
								<b>Posted by: </b><span style="white-space: normal">{{ $IrSpost->user->name }}</span>
							</span>
							<span class="product-description">
								<b>Posted: </b> {{ $IrSpost->created_at->diffForHumans() }}
							</span>
						</div>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
			<div class="box-footer text-center">
				<a href="{{ url('Admin/Institutional-Research/Staff') }}">View all posts</a>
			</div>
		</div>				
	</div>
</div>