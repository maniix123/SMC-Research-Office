@extends('main')
@section('title')
    Saint Michael's College Research
@stop
@section('content')
@include('partials.carousel')
<div class="container-fluid">
	<div class="well">
	<h1 class="text-center">What we have</h1>
	<hr>
		<div class="row">
			<div class="col-lg-6 columns">
				<h2 class="text-center">Research Journals</h2>
				<p>On this website we have Research Journals made by Saint Michael's faculty and by undergraduates.</p>
			</div>	
			<div class="col-lg-6 columns">
				<h2 class="text-center">Institutional Research</h2>
				<p>We also have Institutional Researches by Saint Michael's faculty and staff.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 columns">
				<h1 class="text-center">Mission</h1>
				<hr>
				<p>Guided by the Marian-Ignacian Formation, the Higher Education Research Office commits to:</p>
					<ul class="mission">
						<li>Cultivate excellence thru making research a self-reflective and collaborative practice of the academic community to enrich the system of administration;</li>
						<li>Nurture human potentials and capabilities to contribute a comprehensive range of information and analysis to advance student-teacher learning process and impact to the community; and</li>
						<li>Advovate the science and art of research for planning, decision-making and orgainzing towards achieving total human development.</li>
					</ul>
			</div>
			<div class="col-lg-6 columns">
				<h1 class="text-center">Vision</h1>
				<hr>
				<p>The Reserch Office is committed to <b>A</b>chieve <b>Q</b>uality <b>R</b>esearch for <b>A</b>cademic <b>E</b>xcellence and <b>S</b>ocial <b>T</b>ransformation</p>
			</div>
		</div>
	</div>
</div>	
@endsection