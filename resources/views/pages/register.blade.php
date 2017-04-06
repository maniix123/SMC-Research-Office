@extends('main')
@section('title')
Register page
@stop
@section('content')
<div class="container-fluid body">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				<h4>Register form</h4>
			</div>
			<div class="panel-body">
				@if (Session::has('success'))
				<div class="alert alert-info">
					<p class="text-center">{{ Session::get('success') }}</p>
				</div>
				@elseif(Session::has('error'))
				<div class="alert alert-danger">
					<p class="text-center">{{ Session::get('error') }}</p>
				</div>
				@endif
				{{ Form::open(['url' => 'register', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal', 'files' => 'true']) }}
				<div class="row">
					<div class="col-lg-6">
						<h4 class="text-center">Basic Information</h4>
						<hr>
						<div class="form-group {{ $errors->has('name') ? ' has-error has-feedback' : '' }}">
							{{ Form::label('name', 'Name', ['class' => 'control-label col-lg-3']) }}
							<div class="col-lg-9">
								<div class="input-group"><span class="input-group-addon">
									<i class="fa fa-user"></i></span>
									{{ Form::text('name', '', ['class' => "form-control ", 'placeholder' => 'Enter name here', 'required', 'autofocus', 'value' => old("name")]) }}	
								</div>
								@if ($errors->has('name'))
								<span class="help-block">
									<i>{{ $errors->first('name') }}</i>
								</span>
								@endif	
							</div>					
						</div>
						<div class="form-group {{ $errors->has('email') ? ' has-error has-feedback' : '' }}">
							{{ Form::label('Email', 'Email', ['class' => 'control-label col-lg-3']) }}
							<div class="col-lg-9">
								<div class="input-group"><span class="input-group-addon">
									<i class="fa fa-envelope-o"></i></span>
									{{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Enter email here', 'required', 'value' => old("email")]) }}
								</div>
								@if ($errors->has('email'))
								<span class="help-block">
									<i>{{ $errors->first('email') }}</i>
								</span>
								@endif	
							</div>					
						</div>
						<div class="form-group {{ $errors->has('contactNumber') ? ' has-error has-feedback' : '' }}">
							{{ Form::label('contactNumber', 'Contact number', ['class' => 'control-label col-lg-3']) }}
							<div class="col-lg-9">
								<div class="input-group"><span class="input-group-addon">
									<i class="fa fa-phone"></i></span>
									{{ Form::text('contactNumber', null, ['class' => 'form-control', 'placeholder' => 'Enter contact number here', 'required', 'value' => old("contactNumber")]) }}
								</div>
								@if ($errors->has('contactNumber'))
								<span class="help-block">
									<i>{{ $errors->first('contactNumber') }}</i>
								</span>
								@endif								
							</div>
						</div>
						<div class="form-group {{ $errors->has('address') ? ' has-error has-feedback' : '' }}">
							{{ Form::label('address', 'Address', ['class' => 'control-label col-lg-3']) }}
							<div class="col-lg-9">
								{{ Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Enter your address here', 'required', 'value' => old("address"), 'style' => 'resize: none', 'rows' => '5']) }}
								@if ($errors->has('address'))
								<span class="help-block">
									<i>{{ $errors->first('address') }}</i>
								</span>
								@endif								
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<h4 class="text-center">Login Information</h4>
						<hr>
						<div class="form-group {{ $errors->has('username') ? ' has-error has-feedback' : '' }}">
							{{ Form::label('username', 'Username', ['class' => 'control-label col-lg-3']) }}
							<div class="col-lg-9">
								<div class="input-group"><span class="input-group-addon">
									<i class="fa fa-pencil"></i></span>
									{{ Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Enter username here', 'required', 'value' => old("username")]) }}
								</div>
								@if ($errors->has('username'))
								<span class="help-block">
									<i>{{ $errors->first('username') }}</i>
								</span>
								@endif				
							</div>					
						</div>
						<div class="form-group {{ $errors->has('password') ? ' has-error has-feedback' : '' }}">
							{{ Form::label('password', 'Password', ['class' => 'control-label col-lg-3']) }}
							<div class="col-lg-9">
								<div class="input-group"><span class="input-group-addon">
									<i class="fa fa-key"></i></span>
									{{ Form::password('password',['class' => 'form-control', 'placeholder' => 'Enter password here', 'required', 'value' => old("password")]) }}
								</div>
								@if ($errors->has('password'))
								<span class="help-block">
									<i>{{ $errors->first('password') }}</i>
								</span>
								@endif								
							</div>
						</div>
						<div class="form-group {{ $errors->has('image') ? ' has-error ' : '' }}">
							{{ Form::label('image', 'Profile image', ['class' => 'control-label col-lg-3']) }}
							<div class="col-lg-9">
								{{ Form::file('image', ['class' => 'control-label', 'required']) }}	
								@if ($errors->has('image'))
								<span class="help-block">
									<i>{{ $errors->first('image') }}</i>
								</span>
								@endif	
							</div>
						</div>
						<div class="form-group">
							<div class="btn-group btn-group-justified col-lg-5">
								<a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="displayStudentInputFields()"><i class="fa fa-graduation-cap"></i> I'm a student</a>
								<a href="javascript:void(0)" class="btn btn-info btn-sm" onclick="displayFacultyInputFields()"><i class="fa fa-users"></i> I'm a faculty member</a>
								<a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="displayStaffInputFields()"><i class="fa fa-user"></i> I'm a staff member</a>
							</div>
						</div>
						<div class="form-group" id="formFields"></div>
					</div>
				</div>
				<div class="text-center">
					<button class="btn btn-primary"><i class="fa fa-check"></i> Register</button>
				</div>
				{{ Form::close() }}						
			</div>
		</div>			
	</div>
</div>
<script>
	function displayStudentInputFields()
	{
		$('#formFields').empty();
		var courses = [
		{val : '', text: 'Select your course'},
		{val : 'BS-INFORMATION SYSTEM', text: 'BS-INFORMATION SYSTEM'},
		{val : 'BS-INFORMATION TECHNOLOGY', text: 'BS-INFORMATION TECHNOLOGY'},		
		{val : 'BS-COMPUTER SCIENCE', text: 'BS-COMPUTER SCIENCE'},
		{val : 'BS-COMPUTER ENGINEERING', text: 'BS-COMPUTER ENGINEERING'},
		{val : 'BS-CIVIL ENGINEERING', text: 'BS-CIVIL ENGINEERING'},
		{val : 'BS-ELECTRONICS ENGINEERING', text: 'BS-ELECTRONICS ENGINEERING'},
		{val : 'BS-HOTEL & RESTAURANT MANAGEMENT', text: 'BS-HOTEL & RESTAURANT MANAGEMENT'},
		{val : 'BS-CRIMINOLOGY', text: 'BS-CRIMINOLOGY'},
		{val : 'BS-NURSING', text: 'BS-NURSING'},	
		{val : 'BS-BIOLOGY', text: 'BS-BIOLOGY'},	
		{val : 'AB-PHILOSOPHY', text: 'AB-PHILOSOPHY'},	
		{val : 'AB-COMMUNICATION', text: 'AB-COMMUNICATION'},	
		{val : 'AB-ENGLISH LANGUAGE', text: 'AB-LANGUAGE'},	
		{val : 'BS-PSYCHOLOGY', text: 'BS-PSYCHOLOGY'},	
		{val : 'AB-FILIPINO LANGUAGE', text: 'AB-FILIPINO LANGUAGE'},	
		{val : 'BEED-ENGLISH', text: 'BEED-ENGLISH'},	
		{val : 'BEED-GENERAL EDUCATION', text: 'BEED-GENERAL EDUCATION'},	
		{val : 'BEED-EARLY CHILDHOOD EDUCATION', text: 'BEED-EARLY CHILDHOOD EDUCATION'},	
		{val : 'BEED-SPECIAL EDUCATION', text: 'BEED-SPECIAL EDUCATION'},	
		{val : 'BSED-ENGLISH', text: 'BSED-ENGLISH'},	
		{val : 'BSED-MATH', text: 'BSED-MATH'},	
		{val : 'BSBA-FINANCIAL MANAGEMENT', text: 'BSBA-FINANCIAL MANAGEMENT'},	
		{val : 'BSBA-HUMAN RESOURCE DEVELOPMENT MGT.', text: 'BSBA-HUMAN RESOURCE DEVELOPMENT MGT.'},	
		{val : 'BSBA-MARKETING MANAGEMENT', text: 'BSBA-MARKETING MANAGEMENT'},	
		{val : 'BSBA-OPERATION MANAGEMENT', text: 'BSBA-OPERATION MANAGEMENT'},	
		{val : 'BS-ACCOUNTANCY', text: 'BS-ACCOUNTANCY'},	
		{val : 'BS-ACCOUNTANCY TECHNOLOGY', text: 'BS-ACCOUNTANCY TECHNOLOGY'},	
		{val : 'MAEd-EDUCATIONAL MANAGEMENT', text: 'MAEd-EDUCATIONAL MANAGEMENT'},	
		{val : 'MAEd-FILIPINO', text: 'MAEd-FILIPINO'},	
		{val : 'MAEd-ENGLISH LANGUAGE TEACHING', text: 'MAEd-ENGLISH LANGUAGE TEACHING'},	
		{val : 'MAEd-GUIDANCE COUNSELING', text: 'MAEd-GUIDANCE COUNSELING'},	
		];
		var sel = $('<label for="collegeSelect" class="control-label col-lg-3">Select course</label>'+
			'<div class="col-lg-9">'+
			'<div class="input-group"><span class="input-group-addon">'+
			'<i class="fa fa-graduation-cap"></i></span>'+
			'<select class="form-control" id="collegeSelect" name="studentCourse" class="control-label" onchange="displayDepartment(this.value)" required>'+
			'</div>').appendTo('#formFields');
		$(courses).each(function() {
			$('select#collegeSelect').append($("<option>").attr('value',this.val).text(this.text));
		});
	}
	function displayDepartment(college)
	{
		$('.collegeLabel').remove();
		$('.collegeRow').remove();
		var collegeSelect = $('select#collegeSelect');
		var cecs = ['BS-INFORMATION SYSTEM', 'BS-INFORMATION TECHNOLOGY', 'BS-COMPUTER SCIENCE','BS-COMPUTER ENGINEERING', 'BS-CIVIL ENGINEERING', 'BS-ELECTRONICS ENGINEERING'];
		var chrm = ['BS-HOTEL & RESTAURANT MANAGEMENT'];
		var coc = ['BS-CRIMINOLOGY'];
		var con = ['BS-NURSING'];
		var cas = ['BS-BIOLOGY', 'AB-PHILOSOPHY', 'AB-COMMUNICATION', 'AB-ENGLISH LANGUAGE', 'BS-PSYCHOLOGY', 'AB-FILIPINO LANGUAGE'];
		var ced = ['BEED-ENGLISH', 'BEED-GENERAL EDUCATION', 'BEED-EARLY CHILDHOOD EDUCATION', 'BEED-SPECIAL EDUCATION', 'BSED-ENGLISH', 'BSED-MATH'];
		var cba = ['BSBA-FINANCIAL MANAGEMENT', 'BSBA-HUMAN RESOURCE DEVELOPMENT MGT.', 'BSBA-MARKETING MANAGEMENT', 'BSBA-OPERATION MANAGEMENT'];
		var coa = ['BS-ACCOUNTANCY', 'BS-ACCOUNTANCY TECHNOLOGY'];
		var gs = ['MAEd-EDUCATIONAL MANAGEMENT', 'MAEd-FILIPINO', 'MAEd-ENGLISH LANGUAGE TEACHING', 'MAEd-GUIDANCE COUNSELING'];
		if(jQuery.inArray(college, cecs) !== -1)
		{
			$('<label for="collegeSelect" class="control-label col-lg-3 collegeLabel" style="margin-top: 20px;">College</label>'+
				'<div class="col-lg-9 collegeRow" style="margin-top: 20px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="fa fa-book"></i></span>'+
				'<input class="form-control" name="college" readonly value = "COLLEGE OF ENGINEERING AND COMPUTER STUDIES">'+
				'</div>').appendTo('#formFields');
		}
		else if(jQuery.inArray(college, chrm) !== -1)
		{
			$('<label for="collegeSelect" class="control-label col-lg-3 collegeLabel" style="margin-top: 20px;">College</label>'+
				'<div class="col-lg-9 collegeRow" style="margin-top: 20px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="fa fa-book"></i></span>'+
				'<input id="" class="form-control" name="college" readonly value = "COLLEGE OF HOTEL AND RESTAURANT MANAGEMENT">'+
				'</div>').appendTo('#formFields');
		}
		else if(jQuery.inArray(college, coc) !== -1)
		{
			$('<label for="collegeSelect" class="control-label col-lg-3 collegeLabel" style="margin-top: 20px;">College</label>'+
				'<div class="col-lg-9 collegeRow" style="margin-top: 20px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="fa fa-book"></i></span>'+
				'<input id="" class="form-control" name="college"  readonly value = "COLLEGE OF CRIMINOLOGY">'+
				'</div>').appendTo('#formFields');
		}
		else if(jQuery.inArray(college, cas) !== -1)
		{
			$('<label for="collegeSelect" class="control-label col-lg-3 collegeLabel" style="margin-top: 20px;">College</label>'+
				'<div class="col-lg-9 collegeRow" style="margin-top: 20px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="fa fa-book"></i></span>'+
				'<input id="" class="form-control" name="college"  readonly value = "COLLEGE OF ARTS AND SCIENCES">'+
				'</div>').appendTo('#formFields');
		}
		else if(jQuery.inArray(college, con) !== -1)
		{
			$('<label for="collegeSelect" class="control-label col-lg-3 collegeLabel" style="margin-top: 20px;">College</label>'+
				'<div class="col-lg-9 collegeRow" style="margin-top: 20px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="fa fa-book"></i></span>'+
				'<input id="" class="form-control" name="college"  readonly value = "COLLEGE OF NURSING">'+
				'</div>').appendTo('#formFields');
		}
		else if(jQuery.inArray(college, ced) !== -1)
		{
			$('<label for="collegeSelect" class="control-label col-lg-3 collegeLabel" style="margin-top: 20px;">College</label>'+
				'<div class="col-lg-9 collegeRow" style="margin-top: 20px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="fa fa-book"></i></span>'+
				'<input id="" class="form-control" name="college"  readonly value = "COLLEGE OF EDUCATION">'+
				'</div>').appendTo('#formFields');
		}
		else if(jQuery.inArray(college, cba) !== -1)
		{
			$('<label for="collegeSelect" class="control-label col-lg-3 collegeLabel" style="margin-top: 20px;">College</label>'+
				'<div class="col-lg-9 collegeRow" style="margin-top: 20px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="fa fa-book"></i></span>'+
				'<input id="" class="form-control" name="college"  readonly value = "COLLEGE OF BUSINESS ADMINISTRATION">'+
				'</div>').appendTo('#formFields');
		}
		else if(jQuery.inArray(college, coa) !== -1)
		{
			$('<label for="collegeSelect" class="control-label col-lg-3 collegeLabel" style="margin-top: 20px;">College</label>'+
				'<div class="col-lg-9 collegeRow" style="margin-top: 20px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="fa fa-book"></i></span>'+
				'<input id="" class="form-control" name="college"  readonly value = "COLLEGE OF ACCOUNTANCY">'+
				'</div>').appendTo('#formFields');
		}
		else if(jQuery.inArray(college, gs) !== -1)
		{
			$('<label for="collegeSelect" class="control-label col-lg-3 collegeLabel" style="margin-top: 20px;">College</label>'+
				'<div class="col-lg-9 collegeRow" style="margin-top: 20px;">'+
				'<div class="input-group"><span class="input-group-addon">'+
				'<i class="fa fa-book"></i></span>'+
				'<input id="" class="form-control" name="college"  readonly value = "GRADUATE SCHOOL">'+
				'</div>').appendTo('#formFields');
		}
	}
	function displayFacultyInputFields()
	{
		$('#formFields').empty();
		var courses = [
		{val : '', text: 'Select Department'},
		{val : 'COLLEGE OF ENGINEERING AND COMPUTER STUDIES', text: 'COLLEGE OF ENGINEERING AND COMPUTER STUDIES'},
		{val : 'COLLEGE OF CRIMINOLOGY', text: 'COLLEGE OF CRIMINOLOGY'},		
		{val : 'COLLEGE OF NURSING', text: 'COLLEGE OF NURSING'},
		{val : 'COLLEGE OF EDUCATION', text: 'COLLEGE OF EDUCATION'},
		{val : 'COLLEGE OF BUSINESS ADMINISTRATION', text: 'COLLEGE OF BUSINESS ADMINISTRATION'},
		{val : 'COLLEGE OF ACCOUNTANCY', text: 'COLLEGE OF ACCOUNTANCY'},
		{val : 'COLLEGE OF HOTEL AND RESTAURANT MANAGEMENT', text: 'COLLEGE OF HOTEL AND RESTAURANT MANAGEMENT'},
		{val : 'COLLEGE OF ARTS AND SCIENCES', text: 'COLLEGE OF ARTS AND SCIENCES'},
		];
		var sel = $('<label for="collegeSelect" class="control-label col-lg-3">Select College</label>'+
			'<div class="col-lg-9">'+
			'<div class="input-group"><span class="input-group-addon">'+
			'<i class="fa fa-graduation-cap"></i></span>'+
			'<select class="form-control" id="collegeSelect" name="department" class="control-label" required>'+
			'</div>').appendTo('#formFields');
		$(courses).each(function() {
			$('select#collegeSelect').append($("<option>").attr('value',this.val).text(this.text));
		});
	}
	function displayStaffInputFields()
	{
		$('#formFields').empty();
		var offices = [
		{val : '', text: 'Select Office'},
		{val : 'INSTRUCTIONAL MEDIA CENTER', text: 'INSTRUCTIONAL MEDIA CENTER'},
		{val : 'INFORMATION TECHNOLOGY CENTER', text: 'INFORMATION TECHNOLOGY CENTER'},		
		{val : 'FINANCE OFFICE', text: 'FINANCE OFFICE'},
		{val : 'REGISTRAR OFFICE', text: 'REGISTRAR OFFICE'},
		{val : 'RESEARCH OFFICE', text: 'RESEARCH OFFICE'},
		{val : 'MICSR', text: 'MICSR'},
		];
		var sel = $('<label for="collegeSelect" class="control-label col-lg-3">Select Office</label>'+
			'<div class="col-lg-9">'+
			'<div class="input-group"><span class="input-group-addon">'+
			'<i class="fa fa-graduation-cap"></i></span>'+
			'<select class="form-control" id="collegeSelect" name="office" class="control-label" required>'+
			'</div>').appendTo('#formFields');
		$(offices).each(function() {
			$('select#collegeSelect').append($("<option>").attr('value',this.val).text(this.text));
		});
	}
</script>
@endsection