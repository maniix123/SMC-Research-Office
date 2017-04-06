<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
<div class="carousel-inner" role="listbox">
 <div class="item active">
      <img src="{{ asset('image/Carousel images/image4.jpg') }}" alt="Chania" style="width: 100%">
    </div>

    <div class="item">
      <img src="{{ asset('image/Carousel images/image5.jpg') }}" alt="Chania" style="width: 100%">
    </div>

    <div class="item">
      <img src="{{ asset('image/Carousel images/image6.png') }}" alt="Flower" style="width: 100%">
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
</div>