@extends('layouts.app')

@section('title', $subcat->name)

@section('sidebar')
	@parent
@show

@section('content')
	<h4>
		<a href="{!! route('kategorije.show', $category->slug) !!}">{{ strtoupper($category->name) }}</a>
		&gt;
		<a href="{!! route('kategorije.potkategorije.show', [$category->slug, $subcat->slug]) !!}">{{ strtoupper($subcat->name) }}</a>
	</h4>

	@if(Auth::check())
	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#createItem">
	    Napravi Predmet Za Ovu Potkategoriju
	</button>
	@endif

	<h5>{{ $items->links() }}</h5>

	<div id="createItem" class="modal">
	<div class="modal-content">
		<div class="modal-header">
        	<h4>Napravi Predmet</h4>
	        <button class="close" data-dismiss="modal">&times;</button>
	    </div>
    	<div class="modal-body">            
        	{!! Form::open(['files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'route' => ['items.store']]) !!}
            	@include('partials.forms.createUpdate', ['submitButton' => 'Napravi'])
	        {!! Form::close() !!}
	    </div>
	</div>
	</div>

@foreach($items as $item)
	<div class="col-md-3 col-sm-3" id="{{ $item->name }}">
	    <div class="shopdiv">
	        <h4>{{ $item->name }}</h4>
	        <a data-toggle="modal" data-target="#item-modal{{ $item->id }}">	        	
	        	{!! Html::image('storage/andor/'.$item->img, $item->name) !!}
	        </a>
	            <div class="price-tag">
	                <span>
	                    <h4 id="{{ $item->name }}">{{ $item->price }}</h4>
	                </span>
</div>
	            @include('partials.modals.item')
	        @if(Auth::check())	                       
	            <a class="btn-sm btn-default" data-toggle="modal" href="#updateItem{{ $item->id }}">Izmeni</a>
	            {{--MODAL--}}
	            <div id="updateItem{{ $item->id }}" class="modal">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h4>Izmeni Predmet</h4>
	                    <button class="close" data-dismiss="modal">&times;</button>
	                </div>
	                <div class="modal-body">            
	                    {!! Form::model( $item, ['files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'route' => ['items.update', $item->id]]) !!}
	                        	@include('partials.forms.createUpdate', ['submitButton' => 'Unesi izmene'])
	                    {!! Form::close() !!}
	                </div>
	            </div>
	            </div>
	            @include('partials.forms.delete', ['route' => 'items.destroy', 'id' => $item->id])
	        @else
                <a href="{{ route('item.addToCart', $item) }}#{{ $item->name }}" class="btn btn-success myShoppingCart"></a>
	        @endif
		        <button type="button" class="btn btn-danger">{{ $item->sifra }}</button>
	    </div>
	</div>
@endforeach
@endsection
