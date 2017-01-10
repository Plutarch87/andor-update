<div class="carousel-wrapper hidden-xs">
	<div id="theCarousel" class="carousel slide" data-ride="carousel">
		<ul class="carousel-indicators">
			<li data-target="#theCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#theCarousel" data-slide-to="1"></li>
			<li data-target="#theCarousel" data-slide-to="2"></li>
		</ul>


		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="{{ url(asset("assets/images/carousel/karusel1.jpg")) }}" alt="a">
			</div>

			<div class="item">
				<img src="{{ url(asset("assets/images/carousel/karusel2.jpg")) }}" alt="a">
			</div>

			<div class="item">
				<img src="{{ url(asset("assets/images/carousel/karusel3.jpg")) }}" alt="a">
			</div>

		</div>

		<a class="left carousel-control" href="#theCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#theCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
@if(Auth::check())
	<button>Promeni slike</button>
@endif
</div>

	</header>
</section>