@extends('layout.layout')

@push('styles')
<style>
	input[type="checkbox"]:checked ~ .icon:before {
		content: '';
		position: absolute;
		top: 4px; left: 4px; right: 4px; bottom: 0;
		z-index: -1;
		border-radius: 50%;
		background: linear-gradient(90deg, #EA7C68 0%, #7B5191 40.21%, #7B5191 61.86%, #58B2D0 100%);
	}
	
	button {
		color: white;
		border-radius: 0.75rem;
		background: linear-gradient(90deg, #E287AE 0%, #B08FB9 100%);
	}
	
	button:disabled {
		opacity: 0.5;
		cursor: not-allowed;
	}
</style>

@endpush

@section('content')
	@if(config('app.debug') == true)
	<div class="absolute top-0 left-0 bg-gray-100 border">
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
    <form id="info-form" action="{{ url('informacion') }}" method="post" class="flex flex-col items-center w-full">
        {{ csrf_field() }}
		<div class="mb-8 w-full">
			<h1 class="text-3xl text-center mb-10">¿Qué tipo de información te gustaría recibir?</h1>
			<div class="flex flex-col justify-around">
				{{-- First Row of options --}}
				<div class="flex justify-around mb-6">
					<div>
						<label for="promociones" class="flex items-center flex-col cursor-pointer text-center leading-tight">
							<input
								   class="hidden"
								   type="checkbox"
								   name="informacion[]"
								   id="promociones"
								   value="promociones" 
								   @if(isset($siHay->informacion) && in_array('promociones', $siHay->informacion))
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/promociones.svg') }}" alt="Icono de promociones" />
							</div>
							Promociones
						</label>
					</div>
					<div>
						<label for="recetas" class="flex items-center flex-col cursor-pointer text-center leading-tight">
							<input
								   class="hidden"
								   type="checkbox"
								   name="informacion[]"
								   id="recetas"
								   value="recetas" 
								   @if(isset($siHay->informacion) && in_array('recetas', $siHay->informacion))
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/recetas.svg') }}" alt="Icono de recetas" />
							</div>
							Recetas
						</label>
					</div>
				</div>
				
				{{-- Second Row of options --}}
				<div class="flex justify-around mb-6">
					<div>
						<label for="recomendaciones" class="flex items-center flex-col cursor-pointer text-center leading-tight">
							<input
								   class="hidden"
								   type="checkbox"
								   name="informacion[]"
								   id="recomendaciones"
								   value="recomendaciones" 
								   @if(isset($siHay->informacion) && in_array('recomendaciones', $siHay->informacion))
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/recomendaciones.svg') }}" alt="Icono de recomendaciones" />
							</div>
							Recomendaciones
						</label>
					</div>
					<div>
						<label for="tipsDeFitness" class="flex items-center flex-col cursor-pointer text-center leading-tight">
							<input
								   class="hidden"
								   type="checkbox"
								   name="informacion[]"
								   id="tipsDeFitness"
								   value="tipsDeFitness" 
								   @if(isset($siHay->informacion) && in_array('tipsDeFitness', $siHay->informacion))
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/tips-de-fitness.svg') }}" alt="Icono tips de fitness" />
							</div>
							Tips de fitness
						</label>
					</div>
				</div>
				
				{{-- Third Row of options --}}
				<div class="flex justify-around mb-6">
					<div>
						<label for="planAlimenticioPersonalizado" class="flex items-center flex-col cursor-pointer text-center leading-tight">
							<input
								   class="hidden"
								   type="checkbox"
								   name="informacion[]"
								   id="planAlimenticioPersonalizado"
								   value="planAlimenticioPersonalizado" 
								   @if(isset($siHay->informacion) && in_array('planAlimenticioPersonalizado', $siHay->informacion))
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/plan-alimenticio-personalizado.svg') }}" alt="Icono de plan alimenticio" />
							</div>
							Plan alimenticio personalizado
						</label>
					</div>
					<div>
						<label for="productosDeSupermercado" class="flex items-center flex-col cursor-pointer text-center leading-tight">
							<input
								   class="hidden"
								   type="checkbox"
								   name="informacion[]"
								   id="productosDeSupermercado"
								   value="productosDeSupermercado" 
								   @if(isset($siHay->informacion) && in_array('productosDeSupermercado', $siHay->informacion))
									   selected 
								   @endif
							/>
							<div class='icon relative mb-4'>
								<img src="{{ asset('/svg/productos-supermercado.svg') }}" alt="Icono productos supermercado" />
							</div>
							Productos supermercado
						</label>
					</div>
				</div>
			</div>
		</div>
		
		<button type="submit" class="py-1 px-8 focus:outline-none focus:shadow-outline" disabled>Enviar</button>
    </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
	
@endsection

@push('scripts')
<script>
	$(function() {
		function validateInfoForm() {
			if ($('input[name="informacion[]"]').is(':checked')) {
				$('button[type="submit"]').attr('disabled', false)
			} else {
				$('button[type="submit"]').attr('disabled', true)
			}
		}

		validateInfoForm()

		$('#info-form').on('change', function() {
			validateInfoForm()
		})
	})
</script>
@endpush