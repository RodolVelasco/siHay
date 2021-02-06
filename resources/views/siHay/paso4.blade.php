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
	
	.gradient-1 {
		background: linear-gradient(90deg, #EE8966 0%, #DD6F69 52.6%, #7D5392 100%);
	}
	
	.gradient-2 {
		background: linear-gradient(90deg, #715799 0%, #6571AB 52.6%, #58A9CD 100%);
	}
	
	.gradient-3 {
		background: linear-gradient(90deg, #58A9CD 0%, #6571AB 52.6%, #715799 100%);
	}
	
	.gradient-4 {
		background: linear-gradient(90deg, #E86D66 0%, #D75766 52.6%, #83518D 100%);
	}
	
	.selection-box {
		height: 100px;
	}
	
	.selection-box,
	.selection-box label {
		border-radius: 1rem;
	}
	
	.selection-box label {
		border: 4px solid transparent;
	}
	
	.selection-box input[type="radio"]:checked + label {
		border-color: #FFDD4A;
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
    <form id="physical-activity" action="{{ url('paso4') }}" method="post" class="flex flex-col items-center w-full">
        {{ csrf_field() }}
		<div class="mb-8 w-full">
			<h1 class="text-2xl text-center mb-10">Actividad Física</h1>
			<div class="grid gap-5 grid-cols-2 mx-6">
				{{-- First Box --}}
				<div class="selection-box gradient-1 text-center flex justify-center">
					<input
						   class="hidden"
						   type="radio"
						   name="actividadFisica"
						   id="sedentario"
						   value="sedentario" 
						   @if(isset($siHay->actividadFisica) && $sihay->actividadFisica == 'sedentario')
							   selected 
						   @endif
					/>
					<label for="sedentario" class="font-bold p-2 block cursor-pointer text-white flex flex-col justify-center w-full leading-tight uppercase tracking-wider">
						Sedentario
						<small class="block font-normal mt-1 normal-case tracking-normal">(Trabajo de oficina)</small>
					</label>
				</div>
				
				{{-- Second Box --}}
				<div class="selection-box gradient-2 text-center flex justify-center">
					<input
						   class="hidden"
						   type="radio"
						   name="actividadFisica"
						   id="levementeActivo"
						   value="levementeActivo" 
						   @if(isset($siHay->actividadFisica) && $sihay->actividadFisica == 'levementeActivo')
							   selected 
						   @endif
					/>
					<label for="levementeActivo" class="font-bold p-2 block cursor-pointer text-white flex flex-col justify-center w-full leading-tight uppercase tracking-wider">
						Levemente Activo
						<small class="block mt-1 normal-case tracking-normal font-light leading-tighter">(1 a 2 días por semana)</small>
					</label>
				</div>
				
				{{-- Third Box --}}
				<div class="selection-box gradient-3 text-center flex justify-center">
					<input
						   class="hidden"
						   type="radio"
						   name="actividadFisica"
						   id="activo"
						   value="activo" 
						   @if(isset($siHay->actividadFisica) && $sihay->actividadFisica == 'activo')
							   selected 
						   @endif
					/>
					<label for="activo" class="font-bold p-2 block cursor-pointer text-white flex flex-col justify-center w-full leading-tight uppercase tracking-wider">
						Activo
						<small class="block mt-1 normal-case tracking-normal font-light leading-tighter">(3 a 5 días por semana)</small>
					</label>
				</div>
				
				{{-- Fourth Box --}}
				<div class="selection-box gradient-4 text-center flex justify-center">
					<input
						   class="hidden"
						   type="radio"
						   name="actividadFisica"
						   id="altamenteActivo"
						   value="altamenteActivo" 
						   @if(isset($siHay->actividadFisica) && $sihay->actividadFisica == 'altamenteActivo')
							   selected 
						   @endif
					/>
					<label for="altamenteActivo" class="font-bold p-2 block cursor-pointer text-white flex flex-col justify-center w-full leading-tight uppercase tracking-wider">
						Altamente Activo
						<small class="block mt-1 normal-case tracking-normal font-light leading-tighter">(2 veces al día)</small>
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
		function checkPhysicalActivity() {
			if ($('input[name="actividadFisica"]').is(':checked')) {
				$('button[type="submit"]').attr('disabled', false)
			} else {
				$('button[type="submit"]').attr('disabled', true)
			}
		}

		checkPhysicalActivity()

		$('#physical-activity').on('change', function() {
			checkPhysicalActivity()
		})
	})
</script>
@endpush