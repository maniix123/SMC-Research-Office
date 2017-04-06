<div class="row"><!-- User posts display here here -->
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li class="active"><a href="#"><i class="fa fa-home"></i> Home</a></li>
		</ol>
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title text-center">Your posts <label class="label label-info">{{ $userPosts->count() }}</label></h3> 
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body custom-box-body">
				@if(count($userPosts) == 0)
				<h3 class="text-center">You have not posted anything yet!</h3>
				@else
				<ul class="products-list product-list-in-box testing-custom-list">
					@foreach($userPosts as $userPost)
					<li class="item {{ count($userPost->postRemarks) > 0 ? 'withRemarks' : ' '  }}">
						<div class="product-img">
							<img src="{{ $userPost->user->image}}" alt="" class="img-circle">
						</div>
						<div class="product-info">
							<span class="product-description {{ (count($userPost->postRemarks) > 0) ? '' : 'hide' }}">
								<a href="{{ url('Admin/EditPost/' . $userPost->id) }}" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> Edit</a>
							</span>
							<a href="javascript:void(0)" class="product-title">Title: {{ $userPost->proposal }}</a>
							<span class="product-description">
								<b class="text-custom">Abstract:</b> {{ $userPost->abstract }}
							</span>
							<span class="product-description">
								<b class="text-custom">Author:</b> {{ $userPost->author }}
							</span>
							<span class="product-description">
								<b class="text-custom">Course: </b> {{ ucwords(strtolower($userPost->course)) }}
							</span>
							<span class="product-description">
								<b class="text-custom">College: </b> {{ ucwords(strtolower($userPost->college)) }}
							</span>
							<span class="product-description">
								<b class="text-custom">Posted: </b> {{ $userPost->created_at->diffForHumans() }}
							</span>
							<span class="product-description">
								<b class="text-custom">Status: </b> {{ $userPost->status }}
							</span>
							<span class="product-description {{ ($userPost->status == 'accepted') ? 'hide' : '' }} ">
								<b class="text-custom">Remarks: </b>{{ (count($userPost->postRemarks) > 0) ? count($userPost->postRemarks) . ' remark(s)' : 'No remarks.'}}
								<ol>
									@foreach($userPost->postRemarks as $remarks)
									<li class="text-red" style="white-space: normal">{{ $remarks->remark_name }}</li>
									@endforeach
								</ol>
							</span>
						</div>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>
	</div>
</div><!-- End of user post display-->