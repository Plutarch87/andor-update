@extends('layouts.app')

@section('title', 'Dobro dosli u Hexor')

@section('sidebar')
    @parent
@show

@section('content')

<h5>{{ $items->links() }}</h5>

@foreach($items as $item)
    <div class="col-md-3 col-sm-3">
        <div class="shopdiv">
        <div class="shophead">
            <h4 id="{{ $item->name }}">{{ $item->name }}</h4>
        </div>
        <div class="shopbody">       
            @include('partials.ponuda')
            <a data-toggle="modal" href="#item-modal{{ $item->id }}">{!! Html::image('storage/andor/'.$item->img, $item->name) !!}</a>
                @include('partials.modals.item')            
            <div class="price-tag">
                <span>
                    <h4>{{ $item->price }}</h4>
                </span>
            </div>
        </div>
        <div class="shopfooter">
            <button type="button" class="btn btn-default"><span class="btnSifra">{{ $item->sifra }}</span></button>
            @if(Auth::check())                
                @include('partials.forms.delete', ['route' => 'items.destroy', 'id' => $item->id])
            @else
                <a href="{{ route('item.addToCart', $item) }}#{{ $item->name }}" class="btn btn-success myShoppingCart"></a>
            @endif
        </div>        
        </div>
    </div>    
    
@endforeach

{{ $items->links() }}

@endsection