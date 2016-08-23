
<div class="row">
<div class="col-md-10 col-md-offset-1">
    <div id="carousel-main" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carousel-main" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-main" data-slide-to="1"></li>
        <li data-target="#carousel-main" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="img-responsive center-block" src= {{ asset ('img/carousel_img_1.jpg') }} alt="First slide">
          <div class="carousel-caption">
            <h3> {{ $carousels[0]->header }} </h3>
            <p> {{ $carousels[0]->caption }} </p>
          </div>
        </div>
        <div class="item">
          <img class="img-responsive center-block" src="{{ asset('img/carousel_img_2.jpg') }}" alt="Second slide">
          <div class="carousel-caption">
            <h3> {{ $carousels[1]->header }} </h3>
            <p> {{ $carousels[1]->caption }} </p>
          </div>
        </div>
        <div class="item">
          <img class="img-responsive center-block" src="{{ asset('img/carousel_img_3.jpg') }}" alt="Third slide">
          <div class="carousel-caption">
            <h3> {{ $carousels[2]->header }} </h3>
            <p> {{ $carousels[2]->caption }} </p>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#carousel-main" role="button" data-slide="prev">
        <span class="icon-prev" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-main" role="button" data-slide="next">
        <span class="icon-next" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>
<div class="spacer-md"></div>