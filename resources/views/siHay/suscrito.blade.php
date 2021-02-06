@extends('layout.layout')

@push('styles')
<style>
	#header-logo {
		display: none;
	}
	body {
		display: flex;
		align-items: center;
	}
</style>
@endpush

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

	<div class="text-center mx-auto">
		<img src="{{ asset('images/si-hay-logo-icon.png') }}" alt="Si Hay logo simplificado" class="mb-10 w-2/3 mx-auto" />
		<h1 class="text-2xl uppercase font-bold">¡Ya estás suscrito!</h1>	
	</div>

	{{--@if(config('app.debug') == true)
	<p>
		@if(Session::has('siHay'))
			{{ Session::get('siHay')['sexo'] }}
			{{ Session::get('siHay')['objetivo'] }}
			{{ Session::get('siHay')['preferenciaNutricional'] }}
			{{ Session::get('siHay')['actividadFisica'] }}
			{{ Session::get('siHay')['edad'] }}
			{{ Session::get('siHay')['estatura'] }}
			{{ Session::get('siHay')['peso'] }}
			<br>
			IMC: {{ Session::get('siHay')['imc'] }}
			<br>
			IMC Clasificaciรณn: {{ Session::get('siHay')['imcClasificacion'] }}
			<br>
			Peso Ideal: {{ Session::get('siHay')['pesoIdeal'] }}
			<br>
			Calorias: {{ Session::get('siHay')['calorias'] }}
			<br>
			Texto calorias: {{ Session::get('siHay')['textoCalorias'] }}
			<br>
			Macronutrientes:
			@foreach(Session::get('siHay')['macronutrientes'] as $mac)
					<span>{{ $mac }} </span>
				@endforeach 
			<br>
			@foreach(Session::get('siHay')['informacion'] as $inf)
				<span>{{ $inf }} </span>
			@endforeach 
		@endif
	</p>
	@endif--}}
@endsection