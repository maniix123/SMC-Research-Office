@extends('admin')
@section('title', "Edit $post->proposal")
@section('content')
<div class="content-wrapper">
	<section class="content">
		<ol class="breadcrumb">
			<li><a href="{{ url('Admin/Dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
		</ol>
		<div class="row">
			<div class="col-lg-6">
				<div class="well">
					<h1 class="text-center">Edit <i>{{ $post->proposal }}</i></h1>
					{{ Form::model($post, ['url' => 'Admin/UpdatePost/' . $post->id, 'role' => 'form', 'method' => 'PUT']) }}
					<div class="form-group {{ $errors->has('author') ? ' has-error has-feedback' : '' }}">
						{{ Form::label('label', 'Author:', ['class' => 'control-label']) }}
						<div class="input-group"><span class="input-group-addon">
							<i class="fa fa-user"></i></span>
							{{ Form::text('author', null,array('class' => 'form-control', 'placeholder' => 'Enter author name', 'autofocus' => 'autofocus', 'required')) }}
						</div>					
						@if ($errors->has('author'))
						<span class="help-block">
							<i>{{ $errors->first('author') }}</i>
						</span>
						@endif				
					</div>
					<div class="form-group {{ $errors->has('proposal') ? ' has-error has-feedback' : '' }}">
						{{ Form::label('label', 'Proposal:', ['class' => 'control-label']) }}
						<div class="input-group"><span class="input-group-addon">
							<i class="fa fa-book"></i></span>
							{{ Form::text('proposal', null,array('class' => 'form-control', 'placeholder' => 'Enter proposal', 'required')) }}
						</div>					
						@if ($errors->has('proposal'))
						<span class="help-block">
							<i>{{ $errors->first('proposal') }}</i>
						</span>
						@endif			
					</div>
					<div class="form-group {{ $errors->has('abstract') ? ' has-error has-feedback' : '' }}">
						{{ Form::label('label', 'Abstract:', ['class' => 'control-label']) }}					
						{{ Form::textarea('abstract', null,array('class' => 'form-control', 'placeholder' => 'Enter abstract here', 'style' => 'resize: none', 'rows' => '25', 'cols' => '30', 'required')) }}	
						@if ($errors->has('abstract'))
						<span class="help-block">
							<i>{{ $errors->first('abstract') }}</i>
						</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('schoolyear') ? ' has-error has-feedback' : '' }}">
						{{ Form::label('label', 'School Year:', ['class' => 'control-label']) }}
						<select class="form-control" required="required" name='schoolyear'>
							<option value="">Select school year</option>
							<option value="{{ $post->schoolyear }}" selected="selected">{{ $post->schoolyear }}</option>
							@for($i = date('Y'); $i <= (date('Y') +10); $i++)
							<option value="{{ $i }} - {{ $i+1 }}">{{ $i }} - {{ $i+1 }}</option>
							@endfor
						</select>				
						@if ($errors->has('schoolyear'))
						<span class="help-block">
							<i>{{ $errors->first('schoolyear') }}</i>
						</span>
						@endif
					</div>			
					{{ Form::hidden('tab', 'Research Journal') }}	
					<div class="form-group">				
						<button class="btn btn-info" type="submit"><i class="fa fa-pencil"></i> Update Journal</button>
					</div>
					{{ Form::close() }}					
				</div>
			</div>
			<div class="col-lg-6">
				<div class="well">
					<h4 class="text-center">Previous Remarks:</h4>
					<ul class="list-group">
						@foreach($post->postRemarks as $postRemark)
							<li class="list-group-item text-red">{{ $postRemark->remark_name }}</li>
						@endforeach
					</ul>
				</div>
				<div class="well">
					<h1 class="text-center">Or just delete the journal/research</h1>
					<h5 class="text-center text-danger">(Warning: This can't be undone.)</h5>
					{{ Form::open(['url' => 'Admin/DeletePost/' . $post->id, 'method' => 'DELETE', 'role' => 'form', 'class' => 'form-horizontal']) }}
					<button class="btn btn-danger btn-block" type="submit"><i class="fa fa-trash"></i> Delete journal</button>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</section>
</div>
@endsection