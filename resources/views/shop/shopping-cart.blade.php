@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('sidebar')
@stop

@section('content')
	@if(Session::has('cart'))
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
				<ul class="list-group">
					@foreach($items as $item)
						<li class="list-group-item">
							<span class="badge">{{ $item['qty'] }}</span>
							<strong>{{ $item['item']['name'] }}</strong>
							<span class="label label-success">{{ $item['price'] }}</span>
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">Action<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li><a class="minusOne" href="{{ route('item.reduceByOne', ['id' => $item['item']['id']]) }}">Reduce by 1</a></li>
									<li><a class="minusAll" href="{{ route('item.removeItem', ['id' => $item['item']['id']]) }}">Reduce All</a></li>
								</ul>
							</div>
						</li>
					@endforeach
				</ul>		
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
				<strong>Total: {{ $totalPrice }} din</strong>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
				<a href="{{ route('shop.checkout') }}" type="button" class="btn btn-success">Naruci</a>
				@include('partials.forms.contact')
			</div>
		</div>
	@else
		<div class="row">
			<div class="col-xs-12" style="text-align:center; text-transform:uppercase; position:relative; left:17%; margin-top:8%;">
				<h2>Nemate predmeta u korpi</h2>
			</div>
		</div>
		<div class="cockdiv">
			
		</div>

	@endif
@endsection