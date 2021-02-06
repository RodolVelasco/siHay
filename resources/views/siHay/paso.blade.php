@extends('layout.layout')

@section('content')
    <h1>Paso 4</h1>
    <hr>
    <form action="{{ url('paso4') }}" method="post">
        {{ csrf_field() }}
		<div class="form-group">
			<label for="edad">Edad</label>
			<input name="edad" type="text" class="form-control" id="edad" required>
		</div>
		<div class="form-group">
			<label for="Estatura">Estatura</label>
			<input name="estatura" type="text" class="form-control" id="estatura" required>
			<small id="estaturaHelpBlock" class="form-text text-muted">
  				Estatura en centímetros.
			</small>
		</div>
		<div class="form-group">
			<label for="peso">Peso</label>
			<input name="peso" type="text" class="form-control" id="peso" required>
			<small id="estaturaHelpBlock" class="form-text text-muted">
  				Peso en kilogramos.
			</small>
		</div>
		{{-- <div class="form-group">
            <label for="description">Medidas</label>
            <select class="form-control" name="medida">
                <option {{{ (isset($siHay->medida) && $siHay->medida == 'metrico') ? "selected=\"selected\"" : "" }}}>Métrico</option>
                <option {{{ (isset($siHay->medida) && $siHay->medida == 'imperial') ? "selected=\"selected\"" : "" }}}>Imperial</option>
            </select>
        </div> --}}
		@if(config('app.debug') == true)
		<p>
			@if(Session::has('siHay'))
				{{ Session::get('siHay')['sexo'] }}
				{{ Session::get('siHay')['actividadFisica'] }}
				{{ Session::get('siHay')['objetivo'] }}
			@endif
		</p>
		@endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
		<button type="submit" class="btn btn-primary">Siguiente</button>
    </form>
	
@endsection