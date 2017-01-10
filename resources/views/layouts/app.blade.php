<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">
<!-- MAPA -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhu-orOCU7_qwFx5zr-M4nnGbWrue0PJI" type="text/javascript"></script> -->
<!-- Styles -->
{!! Html::style('assets/bootstrap.css') !!}
{!! Html::style('https://fonts.googleapis.com/css?family=Lobster') !!}
{!! Html::style('assets/index.css') !!}
{!! Html::style('assets/css_flyoutverticalmenu.css') !!}
@stack('styles')
<!-- SCRIPTS -->
{!! Html::script('assets/jquery-1.12.0.min.js') !!}
{!! Html::script('assets/bootstrap.js') !!}
{!! Html::script('assets/cart.js') !!}
@stack('scripts')
	<title>Hexor - @yield('title')</title>
</head>
<body>
<div class="main">        
<section>       
	<header>    
<!-- NAVBAR -->
        <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
    		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    			<ul class="nav navbar-nav">                    
    				<li>
                        <a data-toggle="modal" href="#kontaktModal" id="kontaktM">Kontakt</a>
                    </li>
                    {!! Form::open(['class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                        <div class="form-group">
                            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Search', ['class' => 'btn btn-default form-control']) !!}
                        </div>
                    {!! Form::close() !!}
    			</ul>						
    		</div>
	    </div>
        </nav>            
		<div class="ncontent">
			<h1 id="wlch1">Welcome to <span id="hexor">Hexor</span></h1>
			<a class="logo-wrapper" href="{{ url(asset('/')) }}">
                {!! Html::image('assets/images/hd.png', null, ['id' => 'logo']) !!}
            </a>
			<ul class="nlistwrapper hidden-xs">
				<a class="nlinew"href="{!! url('ponude/novo') !!}"><li>Novo</li></a>
				<a class="nlibestseller"href="{!! url('ponude/popular') !!}"><li>Hot</li></a>    
				<a class="nlisale"href="{!! url('ponude/akcija') !!}"><li>Akcija</li></a>
				@if(Auth::check())
				<a class= "nlibestseller" href="{{ route('inactive') }}"><li>Neaktivne</li></a>
				@endif
			</ul>
			<div class="shopingwrapper">
				
				<a href="{{ route('item.showCart') }}"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><span id="shopcircle" class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : null }}</span></a>
                <div>
			</div>
		</div>
</div>

<div class="modal" id="cart">    
    <div class="modal-content">        
        <div class="list-group" id="cartModal">
            
        </div>    
    </div>
</div>
<div class="modal" id="checkout">    
    <div class="modal-content">        
        <div class="list-group" id="chck">
            <div class="modal-header">
                <h1>Vasi Podaci<span class="pull-right close">&times;</span></h1>
            </div>
            {{ Form::open(['action' => ['CartController@postCheckout'], 'role' => 'form', 'id' => 'checkout-form']) }}
                @include('partials.forms.order')
            {{ Form::close() }}
        </div>    
    </div>
</div>
<!-- NAVBAR -->
    <nav class="navbar navbar-default hidden-lg hidden-md hidden-sm">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#meniMob" aria-expanded="false">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="meniMob">
        <ul class="nav navbar-nav">
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('kategorije.show', $category->id) }}">{{ $category->name }}</a>
                </li>
                <hr>
            @endforeach
        </ul>
        </div>
    </div>
    </nav>

@show   
    
{{-- CAROUSEL --}}
@include('partials.carousel')
{{-- END --}}
@section('sidebar')
<section style="background-color: #EDD9F6;" id="section2">
    <div class="row">
        <div class="col-sm-3 col-xs-5 hidden-xs" id="menuwrapper">
            <ul>
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('kategorije.show', $category->slug) }}">{{ $category->name }}</a>
                        <ul>
                            @if(Auth::check())
                                <li>
                                    {!! Form::open(['route' => ['categories.subcats.store', $category->id]]) !!}
                                    {!! Form::text('name', null, ['style' => 'width:100%']) !!}
                                </li>
                                <li>
                                    {!! Form::submit('Dodaj Potkategoriju', ['class' => 'btn-xs btn-danger']) !!}
                                    {!! Form::close() !!}
                                </li>
                            @endif                      
                         
                            @foreach($category->subcats as $subcat)
                                <li> 
                                    <a href="{{ route('kategorije.potkategorije.show', [$category->slug, $subcat->slug]) }}">{{ $subcat->name }}</a>
                                {{-- DELETE SUBCATEGORY --}}
                                    @if(Auth::check())
                                        <span >
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['subcats.destroy', $subcat->id]]) !!}
                                                {!! Form::submit('&times;', ['onclick' => 'return confirm("Siguran?")', 'class' => 'btn-xs btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    {{-- DELETE CATEGORY --}}
                        @if(Auth::check())
                            @include('partials.forms.delete', ['route' => 'categories.destroy', 'id' => $category->id])                                  
                        @endif
                    </li>
                @endforeach
            
            @if(Auth::check())
                <li>
                    {!! Form::open(['route' => ['categories.store', $category->id]]) !!}
                    {!! Form::text('name') !!}
                </li>
                <li>
                    {!! Form::submit('Dodaj Kategoriju', ['class' => 'btn-xs btn-danger']) !!}
                    {!! Form::close() !!}
                </li>                
            @endif
            </ul>
        </div>

@show
            @if(Session::has('success'))
                <div class="alert alert-success col-lg-8 col-md-6 fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{ Session::get('success') }}</strong>
                </div>
            @endif
            
        <div class="col-sm-9 col-xs-7">
            <div class="main-content">
            <div class="container-fluid">
                
            @yield('content')           
           
           </div>
           </div>
       </div>

    </div>
</section>
@include('partials.modals.contact')
</body>

</html>