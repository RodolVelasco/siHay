@extends('layout.layout')

@push('styles')
<style>
	button {
		color: white;
		border-radius: 0.75rem;
		background: linear-gradient(90deg, #E287AE 0%, #B08FB9 100%);
	}
	
	button:disabled {
		opacity: 0.5;
		cursor: not-allowed;
	}
	input[type="text"],
	input[type="email"]{
		border: 3px solid #F79838;
	}
	.imc-header {
		color: {{ Session::get('siHay')['imcColor'] }};
	}
	.gradient-1 {
		background: linear-gradient(90deg, #F19965 0%, #735496 52.6%, #54B9D4 100%);
	}
	.gradient-2 {
		background: linear-gradient(90deg, #57BAD4 0%, #795294 52.6%, #EA7C6A 100%);
	}
	.macro-gradient-1 {
		background: linear-gradient(90deg, #DF3F68 0%, #C94071 100%);
	}
	.dot-decorators {
		position: relative;
		display: inline-block;
		padding-left: 10px;
		padding-right: 10px;
	}
	.dot-decorators:before,
	.dot-decorators:after {
		content: '';
		position: absolute;
		width: 5px;
		height: 5px;
		background-color: #6382BB;
		top: 50%;
		margin-top: -2.5px;
		border-radius: 50%;
	}
	.dot-decorators:before {
		left: 0;
	}
	.dot-decorators:after {
		right: 0;
	}
	input[type="text"],
	input[type="email"]{
		border: 1px solid #B28CBA;
	}
	#terms {
		text-decoration: underline;
		text-decoration-color: #B68CB9;
	}
</style>
@endpush

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

	@if(config('app.debug') == true)
	<div class="absolute top-0 left-0 bg-gray-100 border hidden">
		<h1 class="border-b pb-2 text-center font-bold p-3 mb-3">
			Debugging Information
		</h1>
		@if(Session::has('siHay'))
			<ul class="p-3">
				@foreach(Session::get('siHay') as $key => $item)
					@if (is_string($key) && is_string($item))
						<li>{{ $key }}: {{ $item }}</li>
					@endif
				@endforeach
			</ul>
		@endif
	</div>
	@endif

	<div class="flex flex-col items-center w-full">
		<div class="mb-10">
			<h1 class="text-6xl imc-header font-bold text-center leading-tight">
				{{ Session::get('siHay')['imc'] }}
			</h1>
			<p class="uppercase text-center text-lg leading-tight">
				{{ Session::get('siHay')['imcClasificacion'] }}
				<small class="block text-xs leading-none">IMC</small>
			</p>
		</div>
		
		<div class="text-center w-full mb-5">
			<p class="uppercase font-bold mb-2">
				Peso ideal
			</p>
			<div class="gradient-1 py-6 px-4">
				<p class="text-4xl font-bold text-white">
					{{ Session::get('siHay')['pesoIdeal'] }} kg
				</p>
			</div>
		</div>
		
		<div class="text-center w-full mb-5">
			<p class="uppercase font-bold mb-2">
				{{ Session::get('siHay')['textoCalorias'] }}
			</p>
			<div class="gradient-2 py-6 px-4">
				<p class="text-4xl font-bold text-white leading-none">
					{{ Session::get('siHay')['calorias'] }} kcal
					<small class="block text-xs leading-none">Al día</small>
				</p>
			</div>
		</div>
		
		<div class="text-center w-full mb-5">
			<p class="uppercase font-bold mb-4 dot-decorators">
				Macronutrientes
			</p>
			<div class="flex justify-around mb-4">
				<span>
					<p class="text-3xl text-white macro-gradient-1 w-24 h-24 flex flex-col justify-center rounded-full font-bold leading-none mb-2">
						{{ Session::get('siHay')['macronutrientes']['proteina'] }}
						<small class="block text-sm font-normal">%</small>
					</p>
					<p class="uppercase text-center">
						Proteinas
					</p>
				</span>
				
				<span>
					<p class="text-3xl text-white macro-gradient-1 w-24 h-24 flex flex-col justify-center rounded-full font-bold leading-none mb-2 mx-auto">
						{{ Session::get('siHay')['macronutrientes']['carbohidratos'] }}
						<small class="block text-sm font-normal">%</small>
					</p>
					<p class="uppercase text-center">
						Carbohidratos
					</p>
				</span>
				
				<span>
					<p class="text-3xl text-white macro-gradient-1 w-24 h-24 flex flex-col justify-center rounded-full font-bold leading-none mb-2">
						{{ Session::get('siHay')['macronutrientes']['grasas'] }}
						<small class="block text-sm font-normal">%</small>
					</p>
					<p class="uppercase text-center">
						Grasas
					</p>
				</span>
			</div>
			<p class="text-gray-700 w-4/5 mx-auto text-sm leading-tight">
				Hay 4 calorías por cada gramo de proteína y de carbohidratos. Y 9 calorías por cada gramo de grasa.
			</p>
		</div>
		
		{{--@if(config('app.debug') == true)
		<p><strong>BMR: </strong>{{ Session::get('siHay')['bmr'] }}</p>
		<p><strong>Nivel Actividad: </strong>{{ Session::get('siHay')['actividadFisica'] }} - {{ Session::get('siHay')['razonNivelActividad'] }}</p>
		@endif
		<p><strong>Macronutrientes: </strong>
			@if(Session::has('siHay')['macronutrientes'])
				@foreach(Session::get('siHay')['macronutrientes'] as $mc)
					<span>{{ $mc }} </span>
				@endforeach
			@endif
		</p>--}}
		
		<form id="newsletter-form" action="{{ url('newsletter') }}" method="post">
			{{ csrf_field() }}
			<h1 class="uppercase font-bold text-center tracking-wider mb-4">
				Subscribete a nuestro newsletter
			</h1>
			
			<input name="nombreCompleto" type="text" id="nombreCompleto" required placeholder="Nombre completo" class="py-1 block w-full mb-2 px-2 rounded-lg focus:outline-none focus:shadow-outline text-center">
			
			<input name="email" type="email" id="email" required placeholder="Correo electrónico" class="py-1 px-2 mb-5 block w-full rounded-lg focus:outline-none focus:shadow-outline text-center">
			
			<label class="text-sm w-full block text-center mb-8">
				<input type="checkbox" class="form-check-input" id="terminosCondiciones" name="terminosCondiciones"/>
				He leído y acepto los <a href="#" id="terms" class="font-bold">términos y condiciones</a>
			</label>
			
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<button type="submit" class="py-1 px-8 mx-auto block focus:outline-none focus:shadow-outline" disabled>Enviar</button>
		</form>
	</div>	
@endsection

@push('scripts')
<script>
	$(function() {
		function validateNewsletterForm() {
			var nombre = $('input[name="nombreCompleto"]').val()
			var email = $('input[name="email"]').val()
			var terms = $('input[name="terminosCondiciones"]').is(':checked')
			
			if (nombre && email && terms) {
				$('button[type="submit"]').attr('disabled', false)
			} else {
				$('button[type="submit"]').attr('disabled', true)
			}
		}

		validateNewsletterForm()

		$('#newsletter-form').on('change', function() {
			validateNewsletterForm()
		})
	})
</script>
@endpush