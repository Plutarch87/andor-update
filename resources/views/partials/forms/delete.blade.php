<span >
	{!! Form::open(['method' => 'DELETE', 'route' => [$route, $id]]) !!}
		{!! Form::submit('&times;', ['onclick' => 'return confirm("Siguran?")', 'class' => 'btn-xs btn-danger']) !!}
	{!! Form::close() !!}
</span>
