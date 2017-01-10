@extends('layouts.app')

@section('title', 'Naruci')

@section('sidebar')
@stop

@section('content')
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">			
			<h1>Naruci</h1>
			<hr>
			<h4>Ukupno: {{ $total }} din</h4>
			<hr>			
			{{ Form::open(['action' => ['CartController@postCheckout'], 'role' => 'form', 'id' => 'checkout-form']) }}
				@include('partials.forms.order')
			{{ Form::close() }}
		</div>
	</div>
@endsection