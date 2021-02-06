@extends('layout.layout')

@push('styles')
<style>
	input[type="radio"]:checked ~ .icon:before {
		content: '';
		position: absolute;
		top: 5px; left: 5px; right: 5px; bottom: 0;
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
    <form id="objective-form" action="{{ url('paso2') }}" method="post" class="flex flex-col items-center w-full">
        {{ csrf_field() }}
		<div class="mb-8 w-full">
			<h1 class="text-2xl text-center mb-10">Objetivo</h1>
			<div class="flex flex-col justify-around">
				<div class="mb-6">
					<label for="mantenimiento" class="flex items-center flex-col cursor-pointer">
						<input
							   class="hidden"
							   type="radio"
							   name="objetivo"
							   id="mantenimiento"
							   value="mantenimiento" 
							   @if(isset($siHay->objetivo) && $sihay->objetivo == 'mantenimiento')
								   selected 
							   @endif
						/>
						<div class='icon relative mb-4'>
							<img src="{{ asset('/svg/mantenimiento.svg') }}" alt="Icono de bascula" />
						</div>
						Mantenimiento
					</label>
				</div>
				<div class="mb-6">
					<label for="perdidaDePesoLeve" class="flex items-center flex-col cursor-pointer">
						<input
							   class="hidden"
							   type="radio"
							   name="objetivo"
							   id="perdidaDePesoLeve"
							   value="perdidaDePesoLeve" 
							   @if(isset($siHay->objetivo) && $sihay->objetivo == 'perdidaDePesoLeve')
								   selected 
							   @endif
						/>
						<div class='icon relative mb-4'>
							<img src="{{ asset('/svg/masa-muscular.svg') }}" alt="Icono de musculatura" />
						</div>
						Pérdida de Peso Leve
					</label>
				</div>
				<div>
					<label for="perdidaDePesoAlta" class="flex items-center flex-col cursor-pointer">
						<input
							   class="hidden"
							   type="radio"
							   name="objetivo"
							   id="perdidaDePesoAlta"
							   value="perdidaDePesoAlta" 
							   @if(isset($siHay->objetivo) && $sihay->objetivo == 'perdidaDePesoAlta')
								   selected 
							   @endif
						/>
						<div class='icon relative mb-4'>
							<img src="{{ asset('/svg/perder-peso.svg') }}" alt="Icono de cintura humana" />
						</div>
						Pérdida de Peso Alta
					</label>
				</div>
			</div>
		</div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
		<button type="submit" class="py-1 px-8 focus:outline-none focus:shadow-outline" disabled>Siguiente</button>
    </form>
@endsection

@push('scripts')
<script>
	$(function() {
		function checkObjectivePicker() {
			if ($('input[name="objetivo"]').is(':checked')) {
				$('button[type="submit"]').attr('disabled', false)
			} else {
				$('button[type="submit"]').attr('disabled', true)
			}
		}

		checkObjectivePicker()

		$('#objective-form').on('change', function() {
			checkObjectivePicker()
		})
	})
</script>
@endpush