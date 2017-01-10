@extends('layouts.app')

@section('title', 'Karusel')

@section('sidebar')
	@parent
@show

@section('content')

@foreach($carousel as $image)
<div class="col-md-3 col-sm-3" id="{{ $image->id }}">
    <div class="shopdiv">
        <h4>Karusel{{ $image->title }}</h4>
        {!! Html::image('assets/images/carousel/karusel'.$image->title.'.jpg') !!}
		</div>			
		
		<div>	
{!! Form::open(['files' => true, 'route' => ['carousel.store']]) !!}
    		{{ Form::label('img', 'Izaberi sliku:', ['class' => 'control-label col-sm-2']) }}
				{{ Form::file('img') }}
				{{ Form::hidden('title', $image->title)}}
		{{ Form::submit('Unesi', ['class' => 'btn btn-info']) }}
{!! Form::close() !!}
		</div>
</div>
@endforeach

@endsection