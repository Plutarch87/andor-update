<div class="form-group">
	{{ Form::label('name', 'Naziv:', ['class' => 'control-label col-sm-2']) }}	
	<div class="col-lg-10">
	{{ Form::text('name', old('name'), ['class' => 'form-control']) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('sifra', 'Sifra:', ['class' => 'control-label col-sm-2'])}}
	<div class="col-lg-10">
	{{ Form::text('sifra', old('sifra'), ['class' => 'form-control']) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('price', 'Cena:', ['class' => 'control-label col-sm-2'])}}
	<div class="col-lg-10">
	{{ Form::text('price', old('price'), ['class' => 'form-control']) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('description', 'Opis:', ['class' => 'control-label col-sm-2']) }}
	<div class="col-lg-10">
	{{ Form::textarea('description', old('description'), ['cols' => 20, 'rows' => 4, 'class' => 'form-control']) }}
	</div>
</div>
<div class="form-group">	
	<div class="col-sm-offset-2 col-sm-3">
		{{ Form::label('akcija', 'Akcija') }}
		{{ Form::checkbox('akcija') }}
		<br>
		{{ Form::label('popularno', 'Hot') }}
		{{ Form::checkbox('popularno') }}
		<br>
		{{ Form::label('novo', 'Novo') }}
		{{ Form::checkbox('novo') }}
	</div>
</div>
<hr>
{{ Form::hidden('category_id', $category->id) }}
@if(isset($subcat->id))
	{{ Form::hidden('subcat_id', $subcat->id) }}
@endif
<div class="form-group">
	{{ Form::label('img', 'Izaberi sliku:', ['class' => 'control-label col-sm-2']) }}
	{{ Form::file('img') }}
</div>
	
<hr>
<div class="col-sm-offset-2 col-sm-3">	
	{{ Form::submit($submitButton, ['class' => 'btn btn-info']) }}
</div>
