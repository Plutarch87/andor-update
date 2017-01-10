@extends('layouts.app')

@section('title', 'AKCIJA')

@section('content')
	@foreach($items as $item)
    <div class="col-md-3 col-sm-3">
        <div class="shopdiv">
            <div class="shophead">
                <h4 id="{{ $item->name }}">{{ $item->name }}</h4>
            </div>
            <div class="shopbody">                
                <div class="price-tag">
                    <span>
                        <h4>{{ $item->price }}</h4>
                    </span>
                </div>
                <div class="akcijatag">
                    <span>Akcija</span>
                </div>
            <a data-toggle="modal" href="#item-modal{{ $item->id }}">{!! Html::image('storage/andor/'.$item->img, $item->name) !!}</a>
                @include('partials.modals.item')            
            </div>
            <div class="shopfooter">                
                @if(Auth::check())                
                    @include('partials.forms.delete', ['route' => 'items.destroy', 'id' => $item->id])
                @else
                    <button class="btn btn-success myShoppingCart"></button>
                @endif            
                    <button type="button" class="btn btn-danger">{{ $item->sifra }}</button>
            </div>
        </div>
    </div>    
@endforeach
@endsection