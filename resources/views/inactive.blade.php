@extends('layouts.app')

@section('title', 'Neaktivi')

@section('content')

<div class="container-fluid">
{{ $items->links() }}
	<div class="row">
@if(count($items)>0)
@foreach($items->sortByDesc('deleted_at') as $item)
	<div class="col-md-3 col-xs-6">
		<div class="shopdiv">
			{!! $item->name !!}
			<div>
 				{!! Html::image('storage/andor/'.$item->img, $item->name) !!}
			</div>
			{{ Form::open(['method' => 'GET', 'route' => ['inactive.item', $item]]) }}
				{{ Form::submit('Aktiviraj', ['onclick' => 'return confirm("Potvrdite aktivaciju predmeta.")', 'class' => 'btn btn-info pull-left']) }}
			{{ Form::close() }}
			{{ Form::open(['method' => 'DELETE', 'route' => ['inactive.delete', $item]]) }}
				{{ Form::submit('Obrisi Zauvek', ['onclick' => 'return confirm("SIGURAN? Predmet ce biti ZAUVEK obrisan?")', 'class' => 'btn btn-danger pull-right']) }}
			{{ Form::close() }}
		</div>
	</div>
@endforeach
@endif
	</div>
</div>
{{ $items->links() }}

@endsection
