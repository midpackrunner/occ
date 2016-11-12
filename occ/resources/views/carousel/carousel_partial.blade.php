
<div class="row">
<div class="col-md-10 col-md-offset-1">
    <div id="carousel-main" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @for ($i = 0; $i < count($carousels); $i++)
          @if ($i == 0)
            <li data-target="#carousel-main" data-slide-to="{{ $i }}" class="active"></li>
          @else
            <li data-target="#carousel-main" data-slide-to="{{ $i }}"></li>
          @endif
        @endfor
      </ol>
      <div class="carousel-inner" role="listbox">
        @for ($i = 1; $i <= count($carousels); $i++)
            @if($i == 1)
            <div class="item active">
            @else
            <div class="item">
            @endif
              <img class="img-responsive center-block" src= {{ asset('img/carousel/carousel_img_'.$i.'.jpg') }} alt="slide">
              <div class="carousel-caption">
                <h3> {{ $carousels[$i - 1]->header }} </h3>
                <p> {{ $carousels[$i - 1]->caption }} </p>
              </div>
            </div>
        @endfor
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
</div>
<div class="spacer-md"></div>