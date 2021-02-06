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
	input[type="text"] {
		border: 3px solid #F79838;
	}
	.gradient-1 {
		background: linear-gradient(90deg, #F1B1AC 0%, #B7A5C7 52.6%, #ABC0DB 100%);	
	}
	
	.gradient-2 {
		background: linear-gradient(270deg, #F1B1AC 0%, #B7A5C7 52.6%, #ABC0DB 100%);
	}
	
	.metric-indicator {
		color: #F06597;
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
    <form id="measurements-form" action="{{ url('paso5') }}" method="post"  class="flex flex-col items-center w-full">
        {{ csrf_field() }}
		<div class="mb-8 w-full">
			<h1 class="text-2xl text-center mb-10">Medidas</h1>
			<div>
				<div class="w-full mb-4 px-5">
					<input class="w-full rounded-lg uppercase focus:outline-none focus:shadow-outline text-white placeholder-white text-center font-bold py-1 px-2 gradient-1" type="number" name="edad" id="edad" required placeholder="EDAD" />
				</div>

				<div class="relative w-full mb-4 px-5">
					<input class="w-full rounded-lg uppercase focus:outline-none focus:shadow-outline text-white placeholder-white text-center font-bold py-1 px-2 gradient-2" type="number" name="estatura" id="estatura" required placeholder="ESTATURA" />
					<small class="absolute top-0 bottom-0 right-0 pr-8 flex items-center font-bold metric-indicator tracking-wider">cms</small>
				</div>

				<div class="relative w-full mb-4 px-5">
					<input class="w-full rounded-lg uppercase focus:outline-none focus:shadow-outline text-white placeholder-white text-center font-bold py-1 px-2 gradient-1" type="number" name="peso" id="peso" required placeholder="PESO" />
					<small class="absolute top-0 bottom-0 right-0 pr-8 flex items-center font-bold metric-indicator tracking-wider">kg</small>
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
		function validateMeasurementsForm() {
			var edad = $('input[name="edad"]').val()
			var estatura = $('input[name="estatura"]').val()
			var peso = $('input[name="peso"]').val()
			
			if (edad && estatura && peso) {
				$('button[type="submit"]').attr('disabled', false)
			} else {
				$('button[type="submit"]').attr('disabled', true)
			}
		}

		validateMeasurementsForm()

		$('input[type="number"]').on('change paste keyup', function() {
			validateMeasurementsForm()
		})
	})
</script>
@endpush