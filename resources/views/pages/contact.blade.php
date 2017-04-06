@extends('main')
@section('title')
    Contact page
@stop
@section('content')
<div class="container">
	<div class="well">
	  <h2 class="text-center">CONTACT</h2>
	  <div class="row">
	    <div class="col-sm-5">
	      <p>Contact us and we'll get back to you within 24 hours.</p>
	      <p><span class="glyphicon glyphicon-map-marker"></span> Iligan City, Philippines</p>
	      <p><span class="glyphicon glyphicon-phone"></span> 09277986249</p>
	      <p><span class="glyphicon glyphicon-envelope"></span> maniix123@gmail.com</p> 
	    </div>
	    <div class="col-sm-7">
	      <div class="row">
	        <div class="col-sm-6 form-group">
	          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
	        </div>
	        <div class="col-sm-6 form-group">
	          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
	        </div>
	      </div>
	      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
	      <div class="row">
	        <div class="col-sm-12 form-group">
	          <button class="btn btn-default pull-right" type="submit">Send</button>
	        </div>
	      </div> 
	      <br>
	    </div>
	  </div>
		<div id="googleMap" style="height:400px;width:100%;"></div>

		<!-- Add Google Maps -->
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<script>
		var myCenter = new google.maps.LatLng(8.228692, 124.239636);

		function initialize() {
		var mapProp = {
		  center:myCenter,
		  zoom:12,
		  scrollwheel:false,
		  draggable:false,
		  mapTypeId:google.maps.MapTypeId.ROADMAP
		  };

		var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

		var marker = new google.maps.Marker({
		  position:myCenter,
		  });

		marker.setMap(map);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
		</script>
	</div>
</div>
@endsection